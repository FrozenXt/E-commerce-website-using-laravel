<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Contact;

class AdminController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('admin.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Dashboard
    public function dashboard()
    {
        $bookings   = Booking::with('service')->get();
        $contacts   = Contact::all();
        $services   = Service::all();
        $products   = Product::all();
        $categories = Category::all();

        $stats = [
            'total_products'     => $products->count(),
            'total_services'     => $services->count(),
            'total_bookings'     => $bookings->count(),
            'pending_bookings'   => $bookings->where('status', 'pending')->count(),
            'total_categories'   => $categories->count(),
            'total_contacts'     => $contacts->count(),
            'new_contacts'       => $contacts->where('created_at', '>=', now()->subWeek())->count(),
            'low_stock_products' => $products->where('stock', '<', 5)->count(),
        ];

        $recentBookings = Booking::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentContacts'));
    }

    // Logout
    public function logout()
    {
        session()->forget(['admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }
    public function index()
{
    $services = Service::latest()->get();
    return view('admin.services.index', compact('services'));
}

}
