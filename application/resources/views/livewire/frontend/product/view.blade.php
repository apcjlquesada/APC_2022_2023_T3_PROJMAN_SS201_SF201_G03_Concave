<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        @if ($product->product_image)
                            <img src="{{ asset($product->product_image) }}" class="w-100" alt="Img">
                        @else
                            <img src="{{ asset('upload/no_image.jpg') }}" class="w-100" alt="Img">
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->product_name }}
                            @if ($product->quantity > 0)
                                <label class="label-stock bg-success">In Stock : {{ $product->quantity }}</label>
                            @else
                                <label class="label-stock bg-danger">Out Of Stock</label>
                            @endif
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->category_name }} / {{ $product->product_name }}
                        </p>
                        <div>
                            <span class="selling-price"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($product->selling_price) }}</span> <br>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                    class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1"> <i
                                    class="fa fa-shopping-cart"></i> Add To Cart
                                </button>

                            <button type="button" wire:click="addToWishlist({{ $product->id }})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishlist">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishlist">Adding...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
