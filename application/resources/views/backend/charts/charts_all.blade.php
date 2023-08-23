@extends('layouts.admin')
@section('admin')

@section('title', 'TM Charts')


<div class="row">
    {{-- <div class="col-md-6">
        <div id="totalSold" style="width: 900px; height: 500px;"></div>
    </div> --}}
    <div class="col-md-6">
        <div id="ProductAmount" style="width: 800px; height: 500px;"></div>
    </div>
    <div class="col-md-6">
        <canvas id="monthly" width="800" height="500"></canvas>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
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
    var monthlyChart = new Chart(ctx,{
        type:'line',
        data:{
            labels: {!! json_encode($monthlylabels) !!},
            datasets:{!! json_encode($monthlydatasets) !!}
        },
    });
    
    </script>

@endsection
