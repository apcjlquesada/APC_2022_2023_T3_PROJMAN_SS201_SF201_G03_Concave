<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function BrandAll()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    public function BrandAdd()
    {
        $categories = Category::all();
        return view('backend.brand.brand_add', compact('categories'));
    }

    public function BrandStore(Request $request)
    {
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(300, 300)->save('upload/brands/' . $name_gen);
        $save_url = 'upload/brands/' . $name_gen;

        Brand::insert([
            'category_id' => $request->category_id,
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Brand Created',
            'alert-type' => 'success'
        );

        return redirect()->route('brand')->with($notification);
    }

    public function BrandEdit($id)
    {
        $category = Category::all();
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand', 'category'));
    }

    public function BrandUpdate(Request $request)
    {
        $brand_id = $request->id;

        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    
            Image::make($image)->resize(300, 300)->save('upload/brands/' . $name_gen);
            $save_url = 'upload/brands/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'category_id' => $request->category_id,
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
    
            ]);
    
            $notification = array(
                'message' => 'Brand Updated',
                'alert-type' => 'info'
            );
    
            return redirect()->route('brand')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'category_id' => $request->category_id,
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
    
            ]);
    
            $notification = array(
                'message' => 'Brand Updated',
                'alert-type' => 'info'
            );
    
            return redirect()->route('brand')->with($notification);
        }
    }

    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted',
            'alert-type' => 'info'
        );

        return redirect()->route('brand')->with($notification);
    }
}
