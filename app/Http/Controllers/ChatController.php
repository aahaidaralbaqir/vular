<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use App\Events\ChatCreated;

class ChatController extends Controller
{   
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('chat.index');
    }
    public function getMessages(){
        return Message::with('user')->orderBy('id','desc')->take(10)->get();
    }
    public function postMessage(Request $request){

        $messages = Message::create([
            'subject' => $request->subject,
            'user_id' => 0
        ]);

        broadcast(new ChatCreated($messages))->toOthers();

        // return $message;
    }
}
