<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $item)
                            @if ($item->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a
                                                href="{{ url('categories/' . $item->product->category->category_slug . '/' . $item->product->product_slug) }}">
                                                <label class="product-name">

                                                    @if ($item->product->product_image)
                                                        <img src="{{ $item->product->product_image }}"
                                                            style="width: 50px; height: 50px" alt="">
                                                    @else
                                                        <img src="{{ asset('upload/no_image.jpg') }}" class="w-100"
                                                            alt="Img">
                                                    @endif

                                                    {{ $item->product->product_name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($item->product->selling_price) }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled"
                                                        wire:click="decrementQuantity({{ $item->id }})"
                                                        class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{ $item->quantity }}"
                                                        class="input-quantity" />
                                                    <button type="button" wire:loading.attr="disabled"
                                                        wire:click="incrementQuantity({{ $item->id }})"
                                                        class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($item->product->selling_price * $item->quantity) }}
                                            </label>
                                            @php
                                                $totalPrice += $item->product->selling_price * $item->quantity
                                            @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="removeCartItem({{ $item->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove
                                                        wire:target="removeCartItem({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading
                                                        wire:target="removeCartItem({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Removing...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @empty
                            <div>No Cart Items Available</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>
                        <a href="{{ route('categories') }}">Shop Now</a>
                    </h4>
                </div>
                <div class="col-md-4">
                    <div class="shadow-sm bg-white p-3">
                        <h4>
                            Total: <span class="float-end"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($totalPrice) }}</span>
                        </h4>
                        <hr>
                        <a href="{{ route('checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
