<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // -----------------------------
    // PUBLIC SIDE
    // -----------------------------

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        return view('bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'        => 'required|exists:services,id',
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'required|string|max:20',
            'device_brand'      => 'required|string|max:255',
            'device_model'      => 'required|string|max:255',
            'issue_description' => 'nullable|string',
            'booking_date'      => 'required|date|after_or_equal:today',
            'booking_time'      => 'required|string|max:20',
        ]);

        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Your booking has been successfully submitted!');
    }

    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.success', compact('booking'));
    }

    // -----------------------------
    // ADMIN SIDE
    // -----------------------------

    public function adminIndex()
    {
        $bookings = Booking::with('service')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function createAdmin()
    {
        $services = Service::where('is_active', true)->get();
        return view('admin.bookings.create', compact('services'));
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'service_id'        => 'required|exists:services,id',
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'required|string|max:20',
            'device_brand'      => 'required|string|max:255',
            'device_model'      => 'required|string|max:255',
            'issue_description' => 'nullable|string',
            'booking_date'      => 'required|date',
            'booking_time'      => 'required|string|max:20',
            'status'            => 'required|string|in:pending,confirmed,completed,cancelled',
            'notes'             => 'nullable|string',
        ]);

        Booking::create($validated);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully!');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $services = Service::where('is_active', true)->get();
        return view('admin.bookings.edit', compact('booking', 'services'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'service_id'        => 'required|exists:services,id',
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'required|string|max:20',
            'device_brand'      => 'required|string|max:255',
            'device_model'      => 'required|string|max:255',
            'issue_description' => 'nullable|string',
            'booking_date'      => 'required|date',
            'booking_time'      => 'required|string|max:20',
            'status'            => 'required|string|in:pending,confirmed,completed,cancelled',
            'notes'             => 'nullable|string',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }
}
