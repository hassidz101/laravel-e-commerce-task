<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginProcess()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $existingAdmin = User::where('email', $request['email'])->first();
        if($existingAdmin == null) {
            return redirect()->back()->withErrors(['errors'=>'User Not Exists'])->withInput();
        }
        $admin = auth()->attempt(['email' => $request['email'], 'password' => $request['password']]);
        if($admin) {
            return redirect()->route('admin.product.list');
        } else {
            return redirect()->back()->withErrors(['errors'=>'Invalid Credentials'])->withInput();
        }
    }
    public function logoutProcess()
    {
        auth()->logout();
        return redirect()->route('admin.view.login');
    }
}
