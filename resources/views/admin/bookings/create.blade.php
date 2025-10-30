@extends('admin.layouts.app')

@section('title', 'Add New Booking')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Add New Booking</h2>

    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Service</label>
                <select name="service_id" class="form-control" required>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Customer Name</label>
                <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                @error('customer_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}" required>
                @error('customer_email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                @error('customer_phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Device Brand</label>
                <input type="text" name="device_brand" class="form-control" value="{{ old('device_brand') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Device Model</label>
                <input type="text" name="device_model" class="form-control" value="{{ old('device_model') }}" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Issue Description</label>
                <textarea name="issue_description" class="form-control" rows="3">{{ old('issue_description') }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Booking Date</label>
                <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Booking Time</label>
                <input type="time" name="booking_time" class="form-control" value="{{ old('booking_time') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create Booking</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
