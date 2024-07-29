<?php

namespace App\Http\Controllers\admin;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // category list page
    public function list() {
        $items = categories::all();
        $count = 1;
        // $page = 'categoryList';
        // dd($items);
        return view('admin.layouts.category.list', compact('items', 'count'));
    }

    // add new category
    public function create(Request $request) {
        $data = [
            'name' => $request->name
        ];
        categories::create($data);
        return back()->with(['createSuccess' => 'Successfully created ...']);
    }

    // delete category
    public function delete($id) {
        categories::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Successfully deleted ...']);
    }

    // view edit page
    public function editPage($id) {
        $data = categories::where('id', $id)->first();
        // dd($data->name);
        return view('admin.layouts.category.edit', compact('data'));
    }

    // edit category
    public function edit(Request $request) {
        $data = [
            'name' => $request->name
        ];
        // dd($data);
        categories::where('id', $request->id)->update($data);
        return redirect()->route('category.list')->with(['updateSuccess' => 'Successfully updated ...']);
    }
}
