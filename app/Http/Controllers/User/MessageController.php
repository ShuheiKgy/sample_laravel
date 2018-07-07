<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class MessageController extends Controller
{
    
    public function index(Request $requist)
    {
        $messages = auth()->user()->messages()->latest()->get();
        
        return view('user.message.index')->with(['messages' => $messages]);
        
    }
    
    public function show(Message $message)
    {
        return view('user.message.show')->with(['message' => $message]);
    }
    
}
