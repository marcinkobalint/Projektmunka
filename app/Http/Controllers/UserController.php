<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
