<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showformregister()
    {
        if (Auth::check()) {
            return redirect()->route(('main-client'));
        }
        return view('client.user.register', [
            "title" => "Đăng ký"
        ]);
    }
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route(('main-client'));
        }

        $this->validate($request, [
            "name" => "required",
            "email" => "required|email:filter",
            "password" => "required|min:6",
            "phone" => "required",
            "address" => 'required'
        ]);

        $users = User::where('email', $request->email)->get();

        if (sizeof($users) > 0) {
            $msg = 'Email đã tồn tại';
            Session::flash('error', $msg);
            return redirect()->back();
        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;



        $user->save();
        Session::flash('success', "Đăng kí thành công");
        return redirect()->route('show-form-login');
    }
    public function showformlogin()
    {
        return view('client.user.login', [
            "title" => "Đăng nhập"
        ]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email:filter",
            "password" => "required|min:6"
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'))) {
            return redirect()->route('main-client');
        }
        Session::flash('error', 'Email hoặc password không chính xác');
        return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        Session::forget('carts');
        return redirect('/');
    }
}
