<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;
    
    public function redirectTo()
    {
        return route('user.top');
    }
    
    public function showLoginForm()
    {
        return view('user.login');
    }
    
    protected function validateLogin(Request $request)
    {
        $messages = [
            $this->username().'.required' => 'メールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください。',
        ];
        
        $this->validate($request, [
            $this->username() => 'required | string',
            'password' => 'required | string',
        ], $messages);
        
    }
    
    public function logout(Request $request)
    {
        
        $partialLogin = auth('user')->guest() || auth('admin')->guest();
        
        $this->guard()->logout();
        
        if ($partialLogin) {
            $request->session()->invalidate();
        }
        
        return redirect()->route('user.login');
        
    }
    
    protected function guard()
    {
        return auth('user');
    }
    
}
