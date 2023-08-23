@extends('layouts.admin')
@section('admin')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome back, {{ Auth::user()->name }}</h2>
                    </div>
                    <div class="d-flex">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        {{-- <div class="col-md-6">
            <div id="totalSold" style="width: 900px; height: 500px;"></div>
        </div> --}}
        <div class="col-md-6">
            <h1 class="text-center"><strong>Daily Sales</strong></h1>
            <div id="ProductAmount" style="width: 800px; height: 500px;"></div>
        </div>
        <div class="col-md-6">
            <h1 class="text-center"><strong>Monthly Sales</strong></h1>
            <canvas id="monthly" width="800" height="500"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Overall Sales</small>
                                        @php
                                            $total_amount = 0;
                                            $overallrevenue = 0;
                                        @endphp
                                        @forelse ($orderComplete as $item)
                                            @php
                                                $orderItem = App\Models\OrderItem::where('order_id', $item->id)->sum('total_price');
                                                $purchase = App\Models\Purchase::where('status', '1')->sum('buying_price');
                                                $overallrevenue += $orderItem;
                                            @endphp
                                        @empty
                                        @endforelse
                                        <h5 class="me-2 mb-0">
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($overallrevenue) }}
                                        </h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Daily Sales</small>
                                        @php
                                            $total_amount = 0;
                                            $dailyrevenue = 0;
                                        @endphp
                                        @forelse ($orderComplete as $item)
                                            @php
                                                $orderItem = App\Models\OrderItem::where('order_id', $item->id)
                                                    ->whereDate('created_at', Carbon\Carbon::today())
                                                    ->sum('total_price');
                                                $purchase = App\Models\Purchase::where('status', '1')->sum('buying_price');
                                                $dailyrevenue += $orderItem;
                                            @endphp
                                        @empty
                                        @endforelse
                                        <h5 class="me-2 mb-0">
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($dailyrevenue) }}
                                        </h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Weekly Sales</small>
                                        @php
                                            $total_amount = 0;
                                            $weeklyrevenue = 0;
                                        @endphp
                                        @forelse ($orderComplete as $item)
                                            @php
                                                $orderItem = App\Models\OrderItem::where('order_id', $item->id)
                                                    ->whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])
                                                    ->sum('total_price');
                                                $purchase = App\Models\Purchase::where('status', '1')->sum('buying_price');
                                                $weeklyrevenue += $orderItem;
                                            @endphp
                                        @empty
                                        @endforelse
                                        <h5 class="me-2 mb-0">
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($weeklyrevenue) }}
                                        </h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Monthly Sales</small>
                                        @php
                                            $total_amount = 0;
                                            $monthlyrevenue = 0;
                                        @endphp
                                        @forelse ($orderComplete as $item)
                                            @php
                                                $orderItem = App\Models\OrderItem::where('order_id', $item->id)
                                                    ->whereMonth('created_at', Carbon\Carbon::now()->month)
                                                    ->sum('total_price');
                                                $purchase = App\Models\Purchase::where('status', '1')->sum('buying_price');
                                                $monthlyrevenue += $orderItem;
                                            @endphp
                                        @empty
                                        @endforelse
                                        <h5 class="me-2 mb-0">
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($monthlyrevenue) }}
                                        </h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Yearly Sales</small>
                                        @php
                                            $total_amount = 0;
                                            $yearlyrevenue = 0;
                                        @endphp
                                        @forelse ($orderComplete as $item)
                                            @php
                                                $orderItem = App\Models\OrderItem::where('order_id', $item->id)
                                                    ->whereYear('created_at', Carbon\Carbon::now()->year)
                                                    ->sum('total_price');
                                                $purchase = App\Models\Purchase::where('status', '1')->sum('buying_price');
                                                $yearlyrevenue += $orderItem;
                                            @endphp
                                        @empty
                                        @endforelse
                                        <h5 class="me-2 mb-0">
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ Str::currency($yearlyrevenue) }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Top 10 Most Sold Products</h4>
                    <br>
                    <table class="table table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No. </th>
                                <th>Product Name</th>
                                <th>Quantity Sold</th>

                        </thead>

                        <tbody>

                            @foreach ($sales as $key => $item)
                                @php
                                    $product = App\Models\Product::where('id', $item->id)->first();
                                    $total = App\Models\OrderItem::where('product_id', $product->id)->sum('quantity');
                                @endphp
                                <tr class="text-center">
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $product->product_name }} </td>
                                    <td> {{ $total }} </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Top 5 Most Orders</h4>
                    <br>
                    <table class="table table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>No. </th>
                                <th>Customer Name</th>
                                <th>Order Count</th>

                        </thead>

                        <tbody>



                            @foreach ($customer as $key => $item)
                                @php
                                    $users = App\Models\User::where('id', $item->user_id)->first();
                                    $count = App\Models\Order::where('user_id', $users->id)
                                        ->where('status_message', 'completed')
                                        ->where('return_order', 0)
                                        ->count();
                                @endphp
                                <tr class="text-center">
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item['user']['name'] }} </td>
                                    <td> {{ $count }} </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Recent Orders</h4>
                    <br>
                    <table class="table table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Tracking No.</th>
                                <th>Name</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Amount</th>
                                <th>Status Message</th>
                                <th width="20%">Action</th>

                        </thead>

                        <tbody>



                            @forelse ($orders as $item)
                                @php
                                    $orderItem = App\Models\OrderItem::where('order_id', $item->id)->sum('total_price');
                                @endphp
                                <tr class="text-center">
                                    <td> {{ $item->tracking_no }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->payment_mode }} </td>
                                    <td> {{ $item->created_at->format('m/d/Y') }} </td>
                                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                        {{ Str::currency($orderItem) }} </td>
                                    <td> {{ $item->status_message }} </td>
                                    <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                            class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No Orders Available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Day', 'Sale'],
                <?php echo $chartDaily; ?>
            ]);



            var options = {
                chart: {
                    title: 'Daily Sales',
                    subtitle: '7 Days (in Philippine Peso)',
                },
                bars: 'vertical' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('ProductAmount'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('monthly').getContext('2d');
        var monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlylabels) !!},
                datasets: {!! json_encode($monthlydatasets) !!}
            },
        });
    </script>
@endsection
