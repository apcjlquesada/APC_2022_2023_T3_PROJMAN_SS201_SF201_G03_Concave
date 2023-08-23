<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseId;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\InvoiceOrderMailable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function PurchaseAll()
    {
        $allData = PurchaseId::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.purchase.purchase_all', compact('allData'));
    }

    public function PurchaseAdd()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $brand = Brand::all();
        return view('backend.purchase.purchase_add', compact('supplier', 'category', 'unit', 'brand'));
    }

    public function PurchaseStore(Request $request)
    {
        if ($request->category_id == null) {

            $notification = array(
                'message' => 'Please Select Category',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $purchase = new PurchaseId();
            $purchase->purchase_no = $request->purchase_no;
            $purchase->date = date('Y-m-d', strtotime($request->date));
            $purchase->status = '0';
            $purchase->created_by = Auth::user()->id;
            $purchase->created_at = Carbon::now();

            DB::transaction(function () use ($request, $purchase) {

                if ($purchase->save()) {
                    $count_category = count($request->category_id);
                    for ($i = 0; $i < $count_category; $i++) {
                        $purchase_details = new Purchase();
                        $purchase_details->date = date('Y-m-d', strtotime($request->date));
                        $purchase_details->purchase_no = $purchase->id;
                        $purchase_details->supplier_id = $request->supplier_id[$i];
                        $purchase_details->category_id = $request->category_id[$i];
                        $purchase_details->brand_id = $request->brand_id[$i];
                        $purchase_details->product_id = $request->product_id[$i];
                        $purchase_details->buying_qty = $request->buying_qty[$i];
                        $purchase_details->unit_price = $request->unit_price[$i];
                        $purchase_details->buying_price = $request->buying_price[$i];
                        $purchase_details->status = '1';
                        $purchase_details->created_by = Auth::user()->id;
                        $purchase_details->created_at = Carbon::now();
                        $purchase_details->save();
                    }
                }
            });
        }

        $notification = array(
            'message' => 'Purchase Created',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.pending')->with($notification);
    }

    public function PurchaseDelete($id)
    {
        $purchase = PurchaseId::findOrFail($id);
        $purchase->delete();
        Purchase::where('purchase_no', $purchase->id)->delete();

        $notification = array(
            'message' => 'Purchase Deleted',
            'alert-type' => 'info'
        );

        return redirect()->route('purchase')->with($notification);
    }

    public function PurchasePending()
    {
        $allData = PurchaseId::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('backend.purchase.purchase_pending', compact('allData'));
    }

    public function PurchaseApproval($id)
    {
        $purchase = PurchaseId::with('purchase_details')->findOrFail($id);
        return view('backend.purchase.purchase_approval', compact('purchase'));
    }

    public function PurchaseApprove(Request $request, $id)
    {
        $purchase = PurchaseId::findOrFail($id);
        $purchase->updated_by = Auth::user()->id;
        $purchase->status = '1';

        DB::transaction(function () use ($request, $purchase, $id) {

            foreach ($request->buying_qty as $key => $val) {
                $purchase_details = Purchase::where('id', $key)->first();

                $purchase_details->status = '1';
                $purchase_details->updated_by = Auth::user()->id;
                $purchase_details->save();

                $product = Product::where('id', $purchase_details->product_id)->first();
                $product->quantity = ((float)$product->quantity) + ((float)$request->buying_qty[$key]);
                $product->save();
            }
            $purchase->save();
        });

        $notification = array(
            'message' => 'Purchase Approved',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase')->with($notification);
    }

    public function PurchaseView(Request $request)
    {
        $purchase_no = $request->purchase_no;

        $purchase = PurchaseId::where('purchase_no', $purchase_no)->first();

        $purchase_details = Purchase::where('purchase_no', $purchase->id)->get();


        return view('backend.purchase.purchase_view', compact('purchase', 'purchase_details'));
    }


    public function PurchaseReorder($id, Request $request)
    {
        $purchase = PurchaseId::findOrFail($id);
        $newPurchase = $purchase->replicate();

        $newPurchase->date = Carbon::now();
        $newPurchase->purchase_no = 'TM - ' . Str::random(10);
        $newPurchase->status = '0';
        $newPurchase->created_by = Auth::user()->id;
        $newPurchase->created_at = Carbon::now();

        if ($newPurchase->save()) {
            foreach ($purchase->purchase_details as $value) {
                $newPurchaseDetails = $value->replicate();
                $newPurchaseDetails->date = Carbon::now();
                $newPurchaseDetails->purchase_no = $newPurchase->id;
                $newPurchaseDetails->status = '1';
                $newPurchaseDetails->created_by = Auth::user()->id;
                $newPurchaseDetails->created_at = Carbon::now();
                $newPurchase->purchase_details()->save($newPurchaseDetails);
            }
        }

        $notification = array(
            'message' => 'Purchase Re Ordered',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase')->with($notification);
    }
}
