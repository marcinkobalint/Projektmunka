<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
         'password' => 'required',
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
