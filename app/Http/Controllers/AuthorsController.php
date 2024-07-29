<?php

namespace App\Http\Controllers;

use App\Models\authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    // view author list
    public function list() {
        $items = authors::all();
        $count = 1;
        // dd($items);
        return view('admin.layouts.author.list', compact('items', 'count'));
    }

    // create author
    public function create(Request $request) {
        $data = [
            'name' => $request->name
        ];
        authors::create($data);
        return back()->with(['createSuccess' => 'Successfully created ....']);
    }

    // delete author
    public function delete($id) {
        authors::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Successfully deleted ...']);
    }

    // view author edit page
    public function editPage($id) {
        $data = authors::where('id', $id)->first();
        // dd($data);
        return view('admin.layouts.author.edit', compact('data'));
    }

    // edit author
    public function edit(Request $request) {
        $data = [
            'name' => $request->name
        ];
        // dd($data);
        authors::where('id', $request->id)->update($data);
        return redirect()->route('author.list')->with(['updateSuccess' => 'Successfully updated ...']);
    }
}
