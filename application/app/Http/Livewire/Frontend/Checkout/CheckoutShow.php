<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\PlaceOrderMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMinimumMailable;
use App\Mail\NotificationNoStockMailable;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $name, $email, $phone, $address1, $address2, $city, $province, $zip_code, $payment_mode = NULL;

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'phone' => 'required|string|min:11|max:16',
            'address1' => 'required|string|min:3|max:255',
            'address2' => 'string|min:3|max:255',
            'city' => 'required|string|min:3|max:255',
            'province' => 'required|string|min:3|max:255',
            'zip_code' => 'required|string|min:3|max:5',
        ];
    }

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'tracking_no' => 'TM-' . Str::random(10),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'province' => $this->province,
            'zip_code' => $this->zip_code,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'created_at' => Carbon::now(),
        ]);

        foreach ($this->carts as $item) {

            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->selling_price,
                'total_price' => $item->product->selling_price * $item->quantity,
            ]);

            if ($item->product_id != NULL) {

                $item->product()->where('id', $item->product_id)->decrement('quantity', $item->quantity);
            }
        }
        return $order;
    }

    public function codOrder()
    {
        // $sendmailrestock = $this->NotificationMinimumMail();
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();

        if ($codOrder) {

            Cart::where('user_id', Auth::user()->id)->delete();

            try {
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                //Mail Sent
            } catch (\Exception $e) {
                // Something went wrong
            }
            try {
                $allData = Product::latest()->get();
                foreach ($allData as $item) {
                    if ($item->to_reorder > $item->quantity && $item->quantity != 0) {
                        Mail::to("torrecampsm@gmail.com")->send(new NotificationMinimumMailable($allData));
                    }
                    if ($item->quantity == 0) {
                        Mail::to("torrecampsm@gmail.com")->send(new NotificationNoStockMailable($allData));
                    }
                }
            } catch (\Exception $e) {
            }

            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed!',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($this->carts as $item) {
            $this->totalProductAmount += $item->product->selling_price * $item->quantity;
        }
        return $this->totalProductAmount;
    }

    public function render()
    {

        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->userDetail->phone;
        $this->address1 = Auth::user()->userDetail->address1;
        $this->address2 = Auth::user()->userDetail->address2;
        $this->city = Auth::user()->userDetail->city;
        $this->province = Auth::user()->userDetail->province;
        $this->zip_code = Auth::user()->userDetail->zip_code;

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
