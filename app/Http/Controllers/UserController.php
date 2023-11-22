<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Teacher_Subject;

class UserController extends Controller
{
   // Main screen get
   function main()
   {
      if (Auth::check()) {
         $teachers = Teacher::all();
         $subjects = Subject::all();
         $teachers_subjects = Teacher_Subject::all();
         return view('main-screen', compact('teachers', 'subjects', 'teachers_subjects'));
      }
      return redirect(route('sign-in'));
   }

   // About us get
   function about_us()
   {
      if (Auth::check()) {
         return view('about-us');
      }
      return redirect(route('sign-in'));
   }

   // Sign-in get
   function sign_in()
   {
      return view('sign-in');
   }

   // Sign-up get
   function sign_up()
   {
      return view('sign-up');
   }

   // Forgot-psw get
   function forgot_psw()
   {
      return view('forgot-psw');
   }

   // Forgot-psw post
   function forgot_psw_post(Request $request)
   {
      // Mezők validálása
      $validator = Validator::make($request->all(), [
         'neptun' => 'required',          // |exists:users',
         'email' => 'required|email:rfc,dns',     // |exists:users',
      ], [
         'neptun.required' => 'A Neptun mező nem maradhat üresen.',
         // 'neptun.exists' => 'Nem létezik felhasználó ezzel a Neptun kóddal.',
         'email.required' => 'Az Email mező nem maradhat üresen.',
         'email.email' => 'A megadott Email cím érvénytelen.',
         // 'email.exists' => 'Nem létezik felhasználó ezzel az Email címmel.',
      ]);

      if ($validator->fails()) {
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      // Létezik-e a neptun - email pár
      $userExists = DB::table('users')->where([
         'neptun' => $request->neptun,
         'email' => $request->email
      ])->first();

      if (!$userExists) {
         return redirect(route('forgot-psw'))->with("error", "A Neptun kód vagy Email cím helytelen.");
      }

      $token = Str::random(64); //64 hosszú random token

      // Ha már az email kapott korábban tokent
      $existingRow = DB::table('password_reset_tokens')
         ->where('email', $request->email)
         ->first();

      // A létező sor törlése
      if ($existingRow) {
         DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();
      }

      DB::table('password_reset_tokens')->insert([
         'email' => $request->email,
         'token' => $token,
         'created_at' => Carbon::now()
      ]);

      Mail::send('emails.forgot-password', ['token' => $token], function ($message) use ($request) {
         $message->to($request->email);
         $message->subject("Reset Password");
      });

      return redirect()->to(route('forgot-psw'))->with("success", "E-mail elküldve a megadott címre a jelszó módosításához.");
   }

   // Reset-psw
   function reset_psw($token)
   {
      return view('new-password', compact('token'));
   }

   // Reset-psw post
   function reset_psw_post(Request $request)
   {
      // Mezők validálása
      $validator = Validator::make($request->all(), [
         'email' => 'required|email:rfc,dns',           // |exists:users',
         'password' => 'required|confirmed|string|min:6',
         'password_confirmation' => 'required'
      ], [
         'email.required' => 'Az Email mező nem maradhat üresen.',
         'email.email' => 'A megadott Email cím érvénytelen.',
         // 'email.exists' => 'Nem létezik felhasználó ezzel az Email címmel.',
         'password.required' => 'A Jelszó mező nem maradhat üresen.',
         'password.confirmed' => 'A két megadott jelszónak egyeznie kell.',
         'password.string' => 'A jelszónak szövegnek kell lennie.',
         'password.min' => 'A jelszónak legalább 6 karakterből kell állnia.',
         'password_confirmation.required' => 'A Jelszó megerősítése mező nem maradhat üresen.',
      ]);

      if ($validator->fails()) {
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      // Ha nem létezik a token = link lejárt
      $tokenExists = DB::table('password_reset_tokens')->where([
         'token' => $request->token
      ])->first();

      if (!$tokenExists) {
         return redirect()->to(route('reset-psw', ['token' => $request->token]))->with("error", "A link már lejárt.");
      }

      // Ha nem találja ezt az email - token párosítást
      $updatePassword = DB::table('password_reset_tokens')->where([
         'email' => $request->email,
         'token' => $request->token
      ])->first();

      if (!$updatePassword) {
         return redirect()->to(route('reset-psw', ['token' => $request->token]))->with("error", "Érvénytelen.");
      }

      User::where('email', $request->email)->update(["password" => Hash::make($request->password)]);

      DB::table('password_reset_tokens')->where(["email" => $request->email])->delete(); //Sor törlése a táblából

      return redirect()->to(route('sign-in'))->with("success", "A jelszó sikeresen megváltozott!");
   }

   // Sign-out get
   function sign_out()
   {
      Session::flush();
      Auth::logout();
      return redirect(route('sign-in'));
   }

   // Sign-in post
   function sign_in_post(Request $request)
   {
      // Mezők validálása
      $validator = Validator::make($request->all(), [
         'neptun' => 'required',
         'password' => 'required',
      ], [
         'neptun.required' => 'A Neptun mező nem maradhat üresen.',
         'password.required' => 'A Jelszó mező nem maradhat üresen.',
      ]);

      if ($validator->fails()) {
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      $credentials = $request->only('neptun', 'password');
      if (Auth::attempt($credentials)) {
         return redirect()->intended(route('main-screen'));
      }
      return redirect(route('sign-in'))->with("error", "Nem sikerült bejelentkezni.");
   }

   // Sign-up post
   function sign_up_post(Request $request)
   {
      // Mezők validálása
      $validator = Validator::make($request->all(), [
         'email' => 'required|email:rfc,dns|unique:users',
         'neptun' => 'required|unique:users',
         'password' => 'required|string|min:6',
      ], [
         'email.required' => 'Az Email mező nem maradhat üresen.',
         'email.email' => 'A megadott Email cím érvénytelen.',
         'email.unique' => 'Már létezik felhasználó ezzel az Email címmel.',
         'neptun.required' => 'A Neptun mező nem maradhat üresen.',
         'neptun.unique' => 'Már létezik felhasználó ezzel a Neptun kóddal.',
         'password.required' => 'A Jelszó mező nem maradhat üresen.',
         'password.string' => 'A jelszónak szövegnek kell lennie.',
         'password.min' => 'A jelszónak legalább 6 karakterből kell állnia.',
      ]);

      if ($validator->fails()) {
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      $data['neptun'] = $request->neptun;
      $data['email'] = $request->email;
      $data['password'] = Hash::make($request->password);

      $user = User::create($data);
      if (!$user) {
         return redirect((route('sign-up')))->with("error", "Sikertelen regisztráció.");
      }
      return redirect(route('sign-in'))->with("success", "Sikeres regisztráció!");
   }
}
