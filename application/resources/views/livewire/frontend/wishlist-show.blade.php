<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h3>My Wishlist</h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block ">
                            <div class="row ">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($wishlist as $item)
                            @if ($item->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a
                                                href="{{ url('categories/' . $item->product->category->category_slug . '/' . $item->product->product_slug) }}">
                                                <label class="product-name">
                                                    <img src="{{ $item->product->product_image }}"
                                                        style="width: 50px; height: 50px" alt="">
                                                    {{ $item->product->product_name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($item->product->selling_price) }} </label>
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button"
                                                    wire:click="removeWishlistItem({{ $item->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove
                                                        wire:target="removeWishlistItem({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading
                                                        wire:target="removeWishlistItem({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Removing...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h4>No Wishlist Added by {{ Auth::user()->name }}</h4>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
