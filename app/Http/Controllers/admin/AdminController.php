<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        // dd(Auth::user()->role);
        return redirect()->route('admin#dashboard');
    }

    // view admin profile page
    public function profile($id) {
        return view('admin.layouts.profile.profile');
    }

    // update admin profile
    public function update(Request $request) {
        $this->accountValidationCheck($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        // for image
        if($request->hasFile('image')) {
            $dbImage = User::where('id', Auth::user()->id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);
            if($dbImage != null) {
                Storage::delete('public/users/' . $dbImage);
            }

            $image = uniqid() . $request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('public/users', $image);
            $data['image'] = $image;
        }

        User::where('id', $request->id)->update($data);
        return back()->with(['updateSuccess' => 'Successfully updated ...']);
    }

    // account validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required'
        ])->validate();
    }
}
