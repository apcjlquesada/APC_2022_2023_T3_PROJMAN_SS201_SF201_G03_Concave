<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{

    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id', Auth::user()->id)->where('id', $wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Item Removed from Wishlsit',
            'type' => 'success',
            'status' => 500
        ]);
    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist,
        ]);
    }
}
