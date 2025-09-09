<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessagesController extends Controller
{
    public function store(Request $request){


        $message = new Message;

        $message->ip_address =  request()->ip();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;

        $message->save();

        return response()->json(['status' => 'success']);
    }
}
