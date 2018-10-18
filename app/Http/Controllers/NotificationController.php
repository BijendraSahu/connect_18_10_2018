<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

session_start();

class NotificationController extends Controller
{
    public function index()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.notification.view_noti')->with(['Notifications' => Notification::GetNotification(), 'user' => $user]);
    }

    public function create()
    {
        return view('admin.advertisement.create_advertise');
    }

    public function store(Request $request)
    {
        $ads = new Notification();
        $ads->notification = request('notification');
        $ads->save();
        return redirect('notificn')->with('message', 'Notification has been added...!');
    }


    public function edit($id)
    {
        $notification = Notification::find($id);
//        echo json_encode($ad);
        return view('admin.notification.edit_noti')->with(['notification' => $notification]);
    }

    public function update($id, Request $request)
    {
        $ads = Notification::find($id);
        $ads->notification = request('notification');
        $file = $request->file('image');
        if ($request->file('image') != null) {
            $destination_path = 'notification/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $ads->image = $destination_path . $filename;
        }
        $ads->save();
        return redirect('notificn')->with('message', 'Notification has been updated...!');
    }

    public
    function destroy($id)
    {
        $Units = Notification::find($id);
        $Units->is_active = 0;
        $Units->save();
        return redirect('notificn')->with('message', 'Notification has been Inactivated...!');

    }

    public
    function active($id)
    {
        $Units = Notification::find($id);
        $Units->is_active = 1;
        $Units->save();
        return redirect('notificn')->with('message', 'Notification has been Activated...!');

    }
}
