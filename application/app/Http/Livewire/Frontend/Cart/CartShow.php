<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartShow extends Component
{

    public $cart, $totalPrice = 0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', Auth::user()->id)->first();

        if ($cartData) {
            if ($cartData->quantity > 1) {
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'You decreased the quantity',
                    'type' => 'info',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', Auth::user()->id)->first();

        if ($cartData) {

            if ($cartData->product->quantity > $cartData->quantity) {
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'You increased the quantity',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Only ' . $cartData->product->quantity . ' are Available',
                    'type' => 'error',
                    'status' => 404
                ]);
            }
        }
    }

    public function removeCartItem(int $cartId)
    {
        Cart::where('user_id', Auth::user()->id)->where('id', $cartId)->delete();

        $this->emit('CartAddedUpdated');

        $this->dispatchBrowserEvent('message', [
            'text' => 'Item Removed',
            'type' => 'warning',
            'status' => 200
        ]);
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
