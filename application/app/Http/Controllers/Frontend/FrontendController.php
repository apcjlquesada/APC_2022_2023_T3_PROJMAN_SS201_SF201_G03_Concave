<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Index()
    {
        $sliders = Slider::where('status', '0')->get();
        return view('frontend.index', compact('sliders'));
    }

    public function Categories()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function Products($category_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();

        if ($category) {
            return view('frontend.collections.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function ProductView(string $category_slug, string $product_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();

        if ($category) {

            $product = $category->products()->where('product_slug', $product_slug)->first();

            if ($product) {
                return view('frontend.collections.products.view', compact('category', 'product'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function ThankYou()
    {
        return view('frontend.thank-you');
    }

    public function TermsService()
    {
        return view('auth.termsprivacy.terms');
    }
    
    public function PrivacyPolicy()
    {
        return view('auth.termsprivacy.privacy');
    }

}
