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

        strong{
            color: yellow;
        }
    </style>

    <title>Needs Restock</title>
</head>

<body>
    <div>
        <img src="{{ $message->embed(public_path().'/upload/restock.png') }}" class="center" alt="">
    </div>
    <div>
        @foreach ($allData as $item)
            @if ($item->to_reorder > $item->quantity)
                <h1>{{ $item->product_name }} needs to <strong>Restock!</strong></h1>
            @endif
        @endforeach
    </div>
</body>

</html>
