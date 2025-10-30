@extends('admin.layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Booking</h2>

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Service</label>
                <select name="service_id" class="form-control" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Customer Name</label>
                <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="customer_email" class="form-control" value="{{ $booking->customer_email }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="text" name="customer_phone" class="form-control" value="{{ $booking->customer_phone }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Device Brand</label>
                <input type="text" name="device_brand" class="form-control" value="{{ $booking->device_brand }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Device Model</label>
                <input type="text" name="device_model" class="form-control" value="{{ $booking->device_model }}" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Issue Description</label>
                <textarea name="issue_description" class="form-control" rows="3">{{ $booking->issue_description }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Booking Date</label>
                <input type="date" name="booking_date" class="form-control" value="{{ $booking->booking_date->format('Y-m-d') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Booking Time</label>
                <input type="time" name="booking_time" class="form-control" value="{{ $booking->booking_time }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control" rows="2">{{ $booking->notes }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
