<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    
    protected $sessionKey = 'SignupData';
    
    public function index(User $user)
    {
        if ($data = \Session::get($this->sessionKey)) {
            $user->fill($data);
        }
        
        return view('signup.index')->with(['user' => $user]);
    }
    
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | max:255',
            'email' => 'required | max:255 | email | unique:users,email',
            'password' => 'required | confirmed | password_between:4,30 | password_string',
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        \Session::put($this->sessionKey, $data);
        
        return redirect()->route('signup.confirm');
    }
    
    public function confirm()
    {
        if (!$data = \Session::get($this->sessionKey)) {
            return redirect()->route('signup.index');
        }
        
        return view('signup.confirm')->with(['data' => $data]);
    }
    
    public function postConfirm(User $user)
    {
        if(!$data = \Session::get($this->sessionKey)) {
            return redirect()->route('signup.index');
        }
        
        $data['password'] = bcrypt($data['password']);
        $user->fill($data)->save();
        auth('user')->login($user);
        \Session::forget($this->sessionKey);
        
        return redirect()->route('signup.thanks');
    }
    
    public function thanks()
    {
        return view('signup.thanks');
    }
    
}
