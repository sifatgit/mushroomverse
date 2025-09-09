<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminNotificationsController extends Controller
{
    public function notice($id){

            $notifications = Notification::where('id','>',$id)->where('seen',0)->get();

            if($notifications){

                // Apply `diffForHumans()` to each `created_at`
                $formattedNotifications = $notifications->map(function ($notification) {
                    $notification->created_at = $notification->created_at->diffForHumans();
                    return $notification;
                });

            return response()->json(['notifications' => $formattedNotifications]); 

            }
            else{

                $notifications = 0;

                return response()->json(['notifications' => $notifications]);
            }

                

    }

    public function delete($id){

        $notification = Notification::find($id);

        $notification->delete();

        return back();


    }

    public function seen($id){

        $notification = Notification::find($id);

        $notification->seen = 1;

        $notification->save();

        return back();


    }

    public function alert(){

        $notifications = Notification::where('seen', 0)->get();

        return response()->json(['notifications' => $notifications]);
    }

}
