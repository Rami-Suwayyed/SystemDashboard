<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    public function index()
    {
       $data['count_social_media'] = SocialMedia::active()->count();
       $data['count_contact'] = ContactUs::count();
       $data['count_visitors'] = Setting::first()->count_visitors;
        return view('index',$data);
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function  root(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    /*Dark Mode -Light  Mode change*/
    public function mode($mode)
    {
        if ($mode) {
            Session::put('mode', $mode);
            Session::save();
            return redirect()->back()->with('mode', $mode);
        } else {
            return redirect()->back();
        }
    }


    public function FormSubmit(Request $request)
    {
        return view('form-repeater');
    }
}
