<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\authors;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    // view book list
    public function list() {
        $books = books::select('books.*', 'categories.name as category_name', 'authors.name as author_name')
                ->leftJoin('categories', 'books.category_id', 'categories.id')
                ->leftJoin('authors', 'books.author_id', 'authors.id')
                ->orderBy('books.created_at', 'desc')
                ->get();
        return view('admin.layouts.book.list', compact('books'));
    }

    // view add book page
    public function addBookPage() {
        $categories = categories::all();
        $authors = authors::all();
        return view('admin.layouts.book.addBook', compact('categories', 'authors'));
    }

    // create book
    public function create(Request $request) {
        // $this->formValidationCheck($request);
        $data = $this->getBookInfo($request);
        $image = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/books', $image);
        $data['image'] = $image;

        books::create($data);
        return redirect()->route('book.list')->with(['createSuccess' => 'Successfully created ...']);
    }

    // delete book
    public function delete($id) {
        books::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Successfully deleted ...']);
    }

    // edit page
    public function edit($id) {
        $book = books::where('id', $id)->first();
        $categories = categories::all();
        $authors = authors::all();
        return view('admin.layouts.book.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request) {
        $data = $this->getBookInfo($request);
        if($request->hasFile('image')){
            $oldImageName = books::where('id',$request->id)->first();
            $oldImageName = $oldImageName->image;
            if($oldImageName != null){
                Storage::delete('public/books/' . $oldImageName);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/books',$fileName);
            $data['image'] = $fileName;
        }

        books::where('id', $request->id)->update($data);
        return redirect()->route('book.list')->with(['updateSuccess' => 'Successfully updated ...']);
    }

    // book validation check
    private function formValidationCheck($request) {
        Validator::make($request->all(), [
            'title' => 'required|unique:books' ,
            'author' => 'required',
            'category' => 'required',
            'productionYear' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file'
        ])->validate();
    }

    // get book info
    private function getBookInfo($request) {
        return [
            'title' => $request->title ,
            'author_id' => $request->author ,
            'category_id' => $request->category ,
            'production_year' => $request->productionYear ,
            'description' => $request->description ,
        ];
    }
}
