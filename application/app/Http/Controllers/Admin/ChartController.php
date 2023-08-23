<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function ChartsAll()
    {
        // $TotalSold = DB::select(DB::raw("select products.product_name as prod , SUM(order_items.quantity) AS qty FROM order_items LEFT JOIN products ON products.id = order_items.product_id GROUP BY products.product_name"));
        // $ProdData = "";
        // foreach ($TotalSold as $val) {
        //     $ProdData .= "['" . $val->prod . "',     " . $val->qty . "],";
        // }
        // $chartTotalSold = $ProdData;

        // $ProductAmount = DB::select(DB::raw("select products.product_name as prod , SUM(order_items.total_price) AS total FROM order_items LEFT JOIN products ON products.id = order_items.product_id GROUP BY products.product_name"));
        // $AmountData = "";
        // foreach ($ProductAmount as $val) {
        //     $AmountData .= "['" . $val->prod . "',     " . $val->total . "],";
        // }

        // $chartAmountSold = $AmountData;

        $sale = OrderItem::selectRaw('MONTH(created_at) as month, SUM(total_price) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);

        $daily = OrderItem::select(DB::raw("(SUM(total_price)) as count"),DB::raw("DAYNAME(created_at) as dayname"))
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

        return view('backend.charts.charts_all', compact('monthlydatasets', 'monthlylabels', 'chartDaily'));
    }
}
