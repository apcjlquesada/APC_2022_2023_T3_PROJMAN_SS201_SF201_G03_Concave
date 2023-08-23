<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function Checkout()
    {
        $details = UserDetail::where('user_id', Auth::user()->id)->exists();

        if ($details == NULL) {
            return view('frontend.user.profile');
        }
        return view('frontend.checkout.index');
    }
}
