<?php

namespace App\Http\Controllers;

use App\Models\books;
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
        $latestBooks = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
        ->leftJoin('categories', 'books.category_id', 'categories.id')
        ->leftJoin('authors', 'books.author_id', 'authors.id')
        ->orderBy('books.created_at', 'desc')
        ->take(8)
        ->get();
        // $latestBooks = books::all();
        // dd($count);
        // dd($latestBooks);
        return view('user.layouts.home ', compact('latestBooks'));
     }

    //  public function dashboardPage(){
    //     return view('admin.dashboard');
    //  }
}
