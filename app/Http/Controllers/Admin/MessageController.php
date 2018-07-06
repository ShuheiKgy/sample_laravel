<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\Http\Requests\SaveMessage;

class MessageController extends Controller
{
    
    public function index()
    {
        $messages = Message::latest()->with('user')->get();
        
        return view('admin.message.index')->with(['messages' => $messages]);
    }
    
    public function store(SaveMessage $request, Message $message)
    {
        $data = $request->getData();
        // $data = $request->only('user_id', 'title', 'content');
        
        $message->forceFill($data)->save();
        
        return redirect(route('admin.message.edit', $message))->with('_flash_msg', '登録が完了しました');
    }
    
    public function create(Message $message)
    {
        $userlist = User::getUserList();
        
        return view('admin.message.create')->with(['message' => $message, 'userlist' => $userlist]);
    }
    
    public function edit(Message $message)
    {
        $userlist = User::getUserList();
        
        return view('admin.message.create')->with(['message' => $message, 'userlist' => $userlist]);
    }
    
    public function update(SaveMessage $request, Message $message)
    {
        $data = $request->only('user_id', 'title', 'content');
        
        $message->forceFill($data)->save();
        
        return redirect(route('admin.message.edit', $message))->with('_flash_msg', '変更が完了しました');
    }
    
}
