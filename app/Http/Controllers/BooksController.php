<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    // view book list
    public function list() {
        return view('admin.layouts.book.list');
    }

    // view add book page
    public function addBookPage() {
        return view('admin.layouts.book.addBook');
    }
}
