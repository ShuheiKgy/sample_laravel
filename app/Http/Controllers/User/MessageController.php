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
        
        $this->authorize('view', $message);
        // if (auth()->id() !== $message->user_id) {
        //     abort(403);
        // }
        
        return view('user.message.show')->with(['message' => $message]);
    }
    
}
