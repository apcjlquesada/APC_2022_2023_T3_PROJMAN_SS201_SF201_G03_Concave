<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function GetBrand(Request $request)
    {
        $category_id = $request->category_id;
        // dd($category_id);
        $allBrand = Brand::where('category_id',$category_id)->get();
        return response()->json($allBrand);
    }

    public function GetCategory(Request $request)
    {
        $supplier_id = $request->supplier_id;
        // dd($supplier_id);
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    }

    public function GetProduct(Request $request)
    {
        $brand_id = $request->brand_id;
        // dd($supplier_id);
        $allProduct = Product::where('brand_id',$brand_id)->get();
        return response()->json($allProduct);
    }

    public function GetProductCategory(Request $request)
    {
        $category_id = $request->category_id; 
        $allProduct = Product::where('category_id',$category_id)->get();
        return response()->json($allProduct);
    }
}
