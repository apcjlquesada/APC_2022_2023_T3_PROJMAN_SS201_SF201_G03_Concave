@php
    $allData = App\Models\Product::latest()->get();
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .center {
            margin-top: 3%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }

        h1 {
            text-align: center;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }

        strong {
            color: red;
        }
    </style>

    <title>No Stock</title>
</head>

<body>
    <div>
        <img src="{{ $message->embed(public_path() . '/upload/nostock.png') }}" class="center" alt="">
    </div>
    <div>
        @foreach ($allData as $item)
            @if ($item->quantity == '0')
                <h1>{{ $item->product_name }} has <strong>NO STOCK!</strong></h1>
            @endif
        @endforeach
    </div>
</body>

</html>
