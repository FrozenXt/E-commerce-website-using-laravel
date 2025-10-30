<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->take(6)
            ->get();

        $services = Service::where('is_active', true)->take(6)->get();
        
        $testimonials = Testimonial::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts', 'services', 'testimonials'));
    }
}
