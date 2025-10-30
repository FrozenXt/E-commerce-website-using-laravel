<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function shop()
    {
        return view('shop');
    }

    public function repair()
    {
        return view('repair');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        // Handle contact form submission logic here

        return redirect()->route('contact')->with('success', 'Your message has been sent!');
    }
}
