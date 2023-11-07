<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class UserController extends Controller
{
   function welcome()
   {
      if (Auth::check()) {
         return view('welcome');
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
         'name' => 'required',
         'password' => 'required',
      ]);

      $credentials = $request->only('name', 'password');
      if (Auth::attempt($credentials)) {
         return redirect()->intended(route('welcome'));
      }
      return redirect(route('sign-in'))->with("error", "Nem sikerült bejelentkezni.");
   }

   // Sign-up post
   function sign_up_post(Request $request)
   {
      $request->validate([
         'username' => 'required|unique:users,name',
         'password' => 'required',
         'email' => 'required|unique:users',
         // 'neptun' => // HOZZÁADNI USERS-HEZ
      ]);
      $data['name'] = $request->username;
      $data['password'] = Hash::make($request->password);
      $data['email'] = $request->email;
      // $data['neptun'] = $request->name;

      $user = User::create($data);
      if (!$user) {
         return redirect((route('sign-up')))->with("error", "Sikertelen regisztráció.");
      }
      return redirect(route('sign-in'))->with("success", "Sikeres regisztráció!");
   }
}
