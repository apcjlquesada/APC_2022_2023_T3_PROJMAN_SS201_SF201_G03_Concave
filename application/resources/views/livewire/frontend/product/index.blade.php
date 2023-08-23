<div>

    <div class="row">
        <div class="col-md-3">

            <div class="card">
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"> High to Low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"> Low to High
                    </label>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="row">
                @forelse ($products as $item)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($item->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif
                                <a
                                    href="{{ url('/categories/' . $item->category->category_slug . '/' . $item->product_slug) }}">
                                    <img src="{{ asset($item->product_image) }}" alt="Laptop">
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $item['brand']['brand_name'] }}</p>
                                <h5 class="product-name">
                                    {{ $item->product_name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($item->selling_price) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Products Available for {{ $category->category_name }}</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
