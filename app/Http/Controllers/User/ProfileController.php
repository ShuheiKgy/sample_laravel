<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    
    public function edit()
    {
        $user = auth()->user();
        
        return view('user.profile.edit')->with(['user' => $user]);
    }
    
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | max:255',
            'email' => 'required | max:255 | email | unique:users,email,' . auth()->id(),
        ]);
        
        auth()->user()->update($data);
        
        return redirect(route('user.profile.edit'))->with('_flash_msg', '変更が完了しました');
    }
    
}
