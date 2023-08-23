<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\OrderCancelMailable;
use App\Mail\InvoiceOrderMailable;
use App\Mail\OrderCompleteMailable;
use App\Http\Controllers\Controller;
use App\Mail\OrderDeliveryMailable;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public $orderItem;

    public function FilterOrder(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $orders = Order::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)->get();

        return view('backend.orders.orders_all', compact('orders'));
    }

    public function Orders()
    {
        $orders = Order::where('return_order',0)->orderBy('id', 'desc')->get();
        return view('backend.orders.orders_all', compact('orders'));
    }

    public function OrderShow(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();

        if ($order) {
            return view('backend.orders.orders_view', compact('order'));
        } else {
            $notification = array(
                'message' => 'Order not Found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function UpdateOrderStatus(int $orderId, Request $request)
    {

        $order = Order::where('id', $orderId)->first();
        $this->orderItem = OrderItem::where('order_id', $order->id)->get();

        if ($order) {
            $order->update([
                'del_fee' => $request->del_fee,
                'status_message' => $request->order_status,
                'updated_at' => Carbon::now(),
            ]);

            if ($order->status_message == 'cancelled') {
                foreach ($this->orderItem as $item) {
                    $item->product()->where('id', $item->product_id)->increment('quantity', $item->quantity);
                }
                try {
                    Mail::to("$order->email")->send(new OrderCancelMailable($order));
                } catch (\Exception $e) {
                }
            }

            if ($order->status_message == 'completed') {
                try {
                    Mail::to("$order->email")->send(new OrderCompleteMailable($order));
                } catch (\Exception $e) {
                }
            }

            if ($order->status_message == 'out for delivery') {
                try {
                    Mail::to("$order->email")->send(new OrderDeliveryMailable($order));
                } catch (\Exception $e) {
                }
            }

            $notification = array(
                'message' => 'Order Status Updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Order not Found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function ViewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('backend.invoice.generate-invoice', compact('order'));
    }

    public function GenerateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('backend.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('m-d-Y');
        return $pdf->download('TM-invoice-' . $order->name . '-' . $todayDate . '.pdf');
    }

    public function MailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        try {
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));

            $notification = array(
                'message' => 'Invoice sent to ' . $order->email,
                'alert-type' => 'success'
            );

            return redirect('/admin/orders/' . $orderId)->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );

            return redirect('/admin/orders/' . $orderId)->with($notification);
        }
    }

    public function PrintOrdersList()
    {
        $orders = Order::where('return_order', 0)->where('status_message', 'completed')->orderBy('id', 'desc')->get();
        foreach ($orders as $key) {
        }

        return view('backend.orders.print_orders_list', compact('orders'));
    }

    public function FilterOrderList(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $orders = Order::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)->get();

        return view('backend.orders.print_orders_list', compact('orders'));
    }

    public function OrdersReportPdf()
    {
        $orders = Order::where('return_order', 0)->where('status_message', 'completed')->get();
        return view('backend.orders.print_orders_pdf', compact('orders'));
    }

    public function OrdersReportDailyPdf()
    {
        $orders = Order::whereDate('created_at', Carbon::today())->where('return_order', 0)->where('status_message', 'completed')->get();
        return view('backend.orders.print_orders_daily_pdf', compact('orders'));
    }

    public function OrdersReportWeeklyPdf()
    {
        $orders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('return_order', 0)->where('status_message', 'completed')->get();
        return view('backend.orders.print_orders_weekly_pdf', compact('orders'));
    }

    public function OrdersReportMonthlyPdf()
    {
        $orders = Order::whereMonth('created_at', Carbon::now()->month)->where('return_order', 0)->where('status_message', 'completed')->get();
        return view('backend.orders.print_orders_monthly_pdf', compact('orders'));
    }

    public function OrdersReportYearlyPdf()
    {
        $orders = Order::whereYear('created_at', Carbon::now()->year)->where('return_order', 0)->where('status_message', 'completed')->get();
        return view('backend.orders.print_orders_yearly_pdf', compact('orders'));
    }
}
