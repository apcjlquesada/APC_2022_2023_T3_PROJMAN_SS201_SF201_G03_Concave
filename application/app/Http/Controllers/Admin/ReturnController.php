<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{

    public $orderItem;

    public function AdminReturnRequest()
    {
        $order = DB::table('orders')->where('return_order', 1)->get();
        return view('backend.return.request', compact('order'));
    }

    public function ApproveReturn($id)
    {
        $order = Order::where('id', $id)->first();
        $this->orderItem = OrderItem::where('order_id', $order->id)->get();

        if ($order) {
            $order->update([
                'return_order' => 2
            ]);

            if ($order->return_order == 2) {
                foreach ($this->orderItem as $item) {
                    $item->update([
                        'total_price' => 0
                    ]);
                }
            }
        }
        $notification = array(
            'message' => 'Return Request Success',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminAllReturn()
    {
        $order = DB::table('orders')->where('return_order', 2)->get();
        return view('backend.return.all', compact('order'));
    }
}
