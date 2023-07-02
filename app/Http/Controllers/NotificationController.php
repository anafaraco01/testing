<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Notifications\InvoiceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function InvoiceNotification()
    {
        $customers = Customer::all();
        $user = Auth::user();
        foreach ($customers as $customer) {
            if ($customer->week1 == 0 && $customer->week2 == 0 && $customer->week3 == 0) {
                Notification::send($user, new InvoiceNotification($customer));
            }
        }
    }

    public function ReadNotification($id, Request $request)
    {
        $user = Auth::user();
        foreach ($user->unreadNotifications as $notification) {
            if ($notification->id == $id) {
                $notification->markAsRead();
                break;
            }
        }

        return response()->json(['success' => true]);
    }
}
