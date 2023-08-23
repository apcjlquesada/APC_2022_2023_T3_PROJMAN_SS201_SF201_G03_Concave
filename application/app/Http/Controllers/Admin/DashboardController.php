<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Mail\NotificationMinimumMailable;
use App\Mail\NotificationNoStockMailable;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // $sendmailrestock = $this->NotificationMinimumMail();
        $revenue = 0;
        $orders = Order::where('return_order', 0)->orderBy('created_at', 'desc')->limit(5)->get();
        $orderComplete = Order::where('status_message', 'completed')->where('return_order', 0)->get();
        $monthorder = Order::where('status_message', 'completed')->get();
        $orderCompleteCount = Order::where('status_message', 'completed')->count();
        $orderCount = Order::count();
        $sales = DB::table('order_items')
            ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.id, sum(order_items.quantity) total')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();



        $customer = Order::with('user')->addSelect(DB::raw('count(id) as purchase_total, user_id'))->where('status_message', 'completed')
        ->where('return_order', 0)
            ->groupBy('user_id')->take(5)
            ->orderBy('purchase_total', 'desc')->get();

        $sale = OrderItem::selectRaw('MONTH(created_at) as month, SUM(total_price) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);

        $daily = OrderItem::select(DB::raw("(SUM(total_price)) as count"), DB::raw("DAYNAME(created_at) as dayname"))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->groupBy('dayname')
            ->get();
        $dailySales = "";
        foreach ($daily as $item) {
            $dailySales .= "['" . $item->dayname . "',     " . $item->count . "],";
        }
        $chartDaily = $dailySales;



        $monthlylabels = [];
        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#FF5722', '#009688', '#795548', '#9C27B0', '#2196F3', '#FF9800', '#CDDC39', '607D8B'];

        for ($i = 1; $i < 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;

            foreach ($sale as $item) {
                if ($item->month == $i) {
                    $count = $item->count;
                    break;
                }
            }

            array_push($monthlylabels, $month);
            array_push($data, $count);
        }

        $monthlydatasets = [
            [
                'label' => 'Monthly Sales (in Philippine Peso)',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];

        return view('admin.dashboard', compact('orders','orderComplete', 'orderCompleteCount', 'orderCount', 'sales', 'customer', 'monthlydatasets', 'monthlylabels', 'chartDaily'));
    }



    // public function NotificationMinimumMail()
    // {
    //     try {
    //         $allData = Product::latest()->get();
    //         foreach ($allData as $item) {
    //             if ($item->to_reorder > $item->quantity && $item->quantity != 0) {
    //                 Mail::to("torrecampsm@gmail.com")->send(new NotificationMinimumMailable($allData));
    //             }
    //             if ($item->quantity == 0) {
    //                 Mail::to("torrecampsm@gmail.com")->send(new NotificationNoStockMailable($allData));
    //             }
    //         }
    //     } catch (\Exception $e) {
    //     }
    // }
}
