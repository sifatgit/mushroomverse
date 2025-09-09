<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class AdminMessagesController extends Controller
{
    public function delete($id){

        $message = Message::find($id);
        $message->delete();

        return back()->with('success','Message deleted successfully!');
    }

    public function check_new_message($id){

        $messages = Message::where('id','>',$id)->where('seen',0)->get();
        $last_message_id = Message::where('seen', 0)->where('id','>',$id)->orderBy('id', 'asc')->pluck('id')->first();
;

        return response()->json(['messages' => $messages, 'last_message_id' => $last_message_id]);
    }


    public function check_pending_message(){

        $messages = Message::where('seen', 0)->get();

        return response()->json(['messages' => $messages]);

    }

    public function seen($id){

        $message = Message::find($id);

        $message->seen = 1;
        $message->save();

        return response()->json(['message' => $message]);
    }
}
