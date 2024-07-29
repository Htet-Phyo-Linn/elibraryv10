<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
