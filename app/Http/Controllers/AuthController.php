<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
     // direct login page
     public function loginPage()
     {
         return view('login');
     }

     // direct register page
     public function registerPage()
     {
         return view('register');
     }

     // direct dashboard
     public function dashboard()
     {
         if (Auth::user()->role == 'admin') {
            //  return redirect()->route('admin#dashboard');
            return view('admin.master');
         } else {
            return redirect()->route('user#home');
         }
    }

     public function homePage(){
        return view('user.home');
     }

    //  public function dashboardPage(){
    //     return view('admin.dashboard');
    //  }
}
