<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Models\books;
use App\Models\authors;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $categories = categories::all();
        return view('user.home', compact('categories'));
    }

    public function dashboard()
    {
        $categories = categories::all();
        return view('user.home', compact('categories'));
    }

    // show all books
    public function books() {
        $books = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
                ->when(request('key'), function($query) {
                    $query->where('books.title','like','%'.request('key').'%');
                })
                ->leftJoin('categories', 'books.category_id', 'categories.id')
                ->leftJoin('authors', 'books.author_id', 'authors.id')
                ->orderBy('books.created_at','desc')
                ->paginate(8);
        $books->appends(request()->all());
        $categories = categories::all();
        $authors = authors::all();
        return view('user.layouts.books', compact('books', 'categories', 'authors'));
    }

    // filter by category
    public function filterCategory($id) {
        $books = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
                ->where('books.category_id', $id)
                ->leftJoin('categories', 'books.category_id', 'categories.id')
                ->leftJoin('authors', 'books.author_id', 'authors.id')
                ->orderBy('books.created_at','desc')
                ->paginate(8);
        $books->appends(request()->all());
        $categories = categories::all();
        $authors = authors::all();
        return view('user.layouts.filter', compact('books','categories', 'authors'));
    }

    // filter by Author
    public function filterAuthor($id) {
        $books = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
                ->where('books.author_id', $id)
                ->leftJoin('categories', 'books.category_id', 'categories.id')
                ->leftJoin('authors', 'books.author_id', 'authors.id')
                ->orderBy('books.created_at','desc')
                ->paginate(8);
        $books->appends(request()->all());
        $categories = categories::all();
        $authors = authors::all();
        return view('user.layouts.filter', compact('books','categories', 'authors'));
    }

    // book detail page
    public function bookDetail($id){
        $book = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
                ->where('books.category_id', $id)
                ->leftJoin('categories', 'books.category_id', 'categories.id')
                ->leftJoin('authors', 'books.author_id', 'authors.id')
                ->orderBy('books.created_at','desc')
                ->first();
        $categories = categories::all();
        $authors = authors::all();
        return view('user.layouts.bookDetail', compact('categories', 'authors', 'book'));
    }

    // user profile page
    public function profilePage($id) {
        $categories = categories::all();
        $authors = authors::all();
        return view('user.layouts.profile', compact('categories', 'authors'));
    }

    // user profile update
    public function updateProfile(Request $request) {
        $data = [
            'name' => $request->name ,
            'email' => $request->email
        ];

        User::where('id', Auth::user()->id)->update($data);
        return back();
    }

    // change password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;
        // dd($dbHashValue);

        if(Hash::check($request->password, $dbHashValue)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return back()->with(['changeSuccess' => 'Password Changed!']);
        }
        return back()->with(['notMatch' => 'Incorrect current password. Try again!']);
    }

    // password validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(), [
            'password' => 'required|max:18',
            'newPassword' => 'required|min:6|max:18',
            'confirmPassword' => 'required|min:6|max:18|same:newPassword'
        ])->validate();
    }
}
