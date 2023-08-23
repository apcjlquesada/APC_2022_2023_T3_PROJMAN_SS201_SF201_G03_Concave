<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NotificationMinimumMailable;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function NotificationMinimum()
    {
        return view('backend.notification.notification_email');
    }

    public function NotificationNoStock()
    {
        return view('backend.notification.notification_email_nostock');
    }
}
