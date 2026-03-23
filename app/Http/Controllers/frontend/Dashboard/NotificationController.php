<?php

namespace App\Http\Controllers\frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        auth('web')->user()->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notification');
    }

    public function delete(Request $request)
    {
        $notification = auth('web')->user()->notifications()->where('id', $request->notification_id)->first();
        if($notification)
        {
            $notification->delete();
            Session::flash('success', 'Notification Deleted Successfully');
            return redirect()->back();
        }
        Session::flash('error', 'something happened');
        return redirect()->back();
        
    }

    public function deleteAll()
    {
        auth('web')->user()->notifications()->delete();
        Session::flash('success', 'Notifications Deleted Successfully');
        return redirect()->back();
    }
}
