<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
      $request->validate([
         'neptun' => 'required|exists:users',
         'email' => 'required|email|exists:users',
      ]);

      $token = Str::random(64); //64 hosszú random token

      DB::table('password_reset_tokens')->insert([
         'email' => $request->email,
         'token' => $token,
         'created_at' => Carbon::now()
      ]);

      Mail::send('emails.forgot-password', ['token' => $token], function($message) use ($request){
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
      $request->validate([
         'email' => 'required|email|exists:users',
         'password' =>'required|confirmed',
         'password_confirmation' =>'required'
      ]);

      $updatePassword = DB::table('password_reset_tokens')->where([
         'email' =>$request->email,
         'token' =>$request->token
      ])->first();

      if (!$updatePassword){
         return redirect()->to(route('reset-psw'))->with("error", "Érvénytelen.");
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
      $request->validate([
         'neptun' => 'required',
         'password' => 'required',
      ]);

      $credentials = $request->only('neptun', 'password');
      if (Auth::attempt($credentials)) {
         return redirect()->intended(route('main-screen'));
      }
      return redirect(route('sign-in'))->with("error", "Nem sikerült bejelentkezni.");
   }

   // Sign-up post
   function sign_up_post(Request $request)
   {
      $request->validate([
         'email' => 'required|unique:users',
         'neptun' => 'required|unique:users',
         'password' => 'required|string|min:6',
      ]);

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
