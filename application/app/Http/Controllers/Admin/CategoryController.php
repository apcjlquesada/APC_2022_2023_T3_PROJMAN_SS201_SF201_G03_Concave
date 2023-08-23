<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function CategoryAll()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function CategoryAdd()
    {
        return view('backend.category.category_add');
    }

    public function CategoryStore(Request $request)
    {
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(300, 300)->save('upload/categories/' . $name_gen);
        $save_url = 'upload/categories/' . $name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_image' => $save_url,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Created',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::find($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request)
    {
        $category_id = $request->id;

        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(300, 300)->save('upload/categories/' . $name_gen);
            $save_url = 'upload/categories/' . $name_gen;

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_image' => $save_url,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Category Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('category')->with($notification);
        } else {
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Category Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('category')->with($notification);
        }
    }

    public function CategoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted',
            'alert-type' => 'info'
        );

        return redirect()->route('category')->with($notification);
    }
}
