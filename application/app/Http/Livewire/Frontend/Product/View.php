<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class View extends Component
{

    public $category;
    public $product;
    public $quantityCount = 1;

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product
        ]);
    }

    public function addToWishlist($productId)
    {
        if (Auth::check()) {

            if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {

                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added in Wishlist',
                    'type' => 'info',
                    'status' => 300
                ]);

                return redirect()->back();
            } else {
                $wishlist = Wishlist::insert([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'created_at' => Carbon::now()
                ]);
                $this->emit('wishlistAddedUpdated');

                $this->dispatchBrowserEvent('message', [
                    'text' => 'Added in Wishlist',
                    'type' => 'success',
                    'status' => 500
                ]);

                return redirect()->back();
            }
        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to Continue',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {

        $this->quantityCount++;
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->exists()) {
                if (Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Already Added',
                        'type' => 'info',
                        'status' => 600
                    ]);
                } else {
                    if ($this->product->quantity > 0) {
                        if ($this->product->quantity >= $this->quantityCount) {
                            // Insert to Cart
                            Cart::insert([
                                'user_id' => Auth::user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount,
                                'created_at' => Carbon::now()
                            ]);

                            $this->emit('CartAddedUpdated');
                            
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Added to Cart',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only ' . $this->product->quantity . ' are Available',
                                'type' => 'info',
                                'status' => 404
                            ]);
                        }
                    } else {

                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out of Stock',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not Exist',
                    'type' => 'info',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to Continue',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
}
