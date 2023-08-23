<?php

namespace App\Http\Controllers\Admin;

use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function FooterSetting()
    {
        $footer = Footer::latest()->get();
        return view('backend.setting.footer_setting', compact('footer'));
    }

    public function FooterAdd($id)
    {
        $footers = Footer::findOrFail($id);
        return view('backend.setting.footer_edit', compact('footers'));
    }

    public function FooterStore(Request $request)
    {

        $footer_id = $request->id;

        Footer::findOrFail($footer_id)->update([
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_address' => $request->company_address,
            'company_phone' => $request->company_phone,
            'company_email' => $request->company_email,
            'company_facebook' => $request->company_facebook,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Footer Updated',  
            'alert-type' => 'success'
        );
        return redirect()->route('footer.setting')->with($notification);
    }

}
