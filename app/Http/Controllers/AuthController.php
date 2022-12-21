<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

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
            return redirect()->back();
        }

        $this->validate($request, [
            "name" => "required",
            "email" => "required|email:filter",
            "password" => "required|min:6",
            "phone" => "required|min:9",
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
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('client.user.login', [
            "title" => "Đăng nhập"
        ]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email:filter",
            "password" => "required|min:6",
            'g-recaptcha-response' => 'required|captcha',
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
        return redirect('/login');
    }
    // google login
    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function getGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Lỗi xác thực. Xin vui lòng thử lại!');
        }
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // Nếu người dùng đã tồn tại thì đăng nhập
            Auth::login($existingUser, true);
            return redirect('/');
        } else {
            // Nếu chưa tồn tại người dùng thì thêm mới
            $newUser = User::create([
                'name' => $user->name,
                // 'username' => Str::before($user->email, '@'),
                'email' => $user->email,
                'password' => Hash::make('larashop@2020'), // Gán mật khẩu tự do
            ]);
            // Sau đó đăng nhập
            Auth::login($newUser, true);
            return redirect()->back();
        }
    }
}
