<?php

namespace App\Http\Controllers\user;

use App\Models\books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        return view('user.home');
    }

    public function dashboard()
    {
        return view('user.home');
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
        return view('user.layouts.books', compact('books'));
    }

    // filter by category
    public function filter($id) {
        $books = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
                ->where('books.category_id', $id)
                ->leftJoin('categories', 'books.category_id', 'categories.id')
                ->leftJoin('authors', 'books.author_id', 'authors.id')
                ->orderBy('books.created_at','desc')
                ->paginate(8);
        $books->appends(request()->all());
        return view('user.layouts.filter');
    }
}
