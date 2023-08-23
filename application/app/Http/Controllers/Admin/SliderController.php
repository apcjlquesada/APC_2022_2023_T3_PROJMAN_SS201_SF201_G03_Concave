<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function SliderAll()
    {
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_all', compact('sliders'));
    }

    public function SliderAdd()
    {
        return view('backend.slider.slider_add');
    }

    public function SliderStore(Request $request)
    {
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(1200, 400)->save('upload/sliders/' . $name_gen);
        $save_url = 'upload/sliders/' . $name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'slider_image' => $save_url,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
        ]);

        $notification = array(
            'message' => 'Slider Created',
            'alert-type' => 'success'
        );

        return redirect()->route('slider')->with($notification);
    }

    public function SliderEdit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function SliderUpdate(Request $request)
    {
        $slider_id = $request->id;

        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(1200, 400)->save('upload/sliders/' . $name_gen);
            $save_url = 'upload/sliders/' . $name_gen;

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'slider_description' => $request->slider_description,
                'slider_image' => $save_url,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
            ]);
            $notification = array(
                'message' => 'Slider Updated',
                'alert-type' => 'info'
            );
    
            return redirect()->route('slider')->with($notification);
        } else {

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'slider_description' => $request->slider_description,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
            ]);
            $notification = array(
                'message' => 'Slider Updated',
                'alert-type' => 'info'
            );
    
            return redirect()->route('slider')->with($notification);
        }
    }

    public function SliderDelete($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted',
            'alert-type' => 'info'
        );

        return redirect()->route('slider')->with($notification);
    }
}
