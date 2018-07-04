<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function redirectTo()
    {
        return route('admin.top');
    }
    
    public function showLoginForm()
    {
        return view('admin.login');
    }
    
    protected function validateLogin(Request $request)
    {
        $messages = [
            $this->username().'.required' => 'ログインIDを入力してください。',
            'password.required' => 'パスワードを入力してください。'
        ];
        
        $this->validate($request, [
            $this->username() => 'required | string',
            'password' => 'required | string',
        ], $messages);
    }
    
    public function username()
    {
        return 'username';
    }
    
    public function logout(Request $request)
    {
        $partialLogin = auth('user')->guest() || auth('admin')->guest();
        
        $this->guard()->logout();
        
        if ($partialLogin) {
            $request->session()->invalidate();
        }
        
        return redirect()->route('admin.login');
    }
    
    protected function guard()
    {
        return auth('admin');
    }
}
