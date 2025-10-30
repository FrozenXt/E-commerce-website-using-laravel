@extends('admin.layouts.app')

@section('title', 'Booking Details')

@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-calendar-check me-2"></i> Booking Details
        </h2>
        <div>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>

```
<!-- Booking Overview Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark">Booking #{{ $booking->id }}</h5>
            <span class="badge 
                @if($booking->status == 'pending') bg-warning text-dark
                @elseif($booking->status == 'confirmed') bg-info
                @elseif($booking->status == 'completed') bg-success
                @elseif($booking->status == 'cancelled') bg-danger
                @else bg-secondary @endif
            ">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
        <p class="text-muted mb-0 mt-1">Booked on {{ $booking->created_at->format('d M Y, h:i A') }}</p>
    </div>
</div>

<div class="row g-4">
    <!-- Customer Details -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="fas fa-user me-2"></i> Customer Information
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $booking->customer_email }}" class="text-decoration-none">{{ $booking->customer_email }}</a></p>
                <p><strong>Phone:</strong> <a href="tel:{{ $booking->customer_phone }}" class="text-decoration-none">{{ $booking->customer_phone }}</a></p>
            </div>
        </div>
    </div>

    <!-- Device Details -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-success text-white fw-semibold">
                <i class="fas fa-mobile-alt me-2"></i> Device Details
            </div>
            <div class="card-body">
                <p><strong>Brand:</strong> {{ $booking->device_brand }}</p>
                <p><strong>Model:</strong> {{ $booking->device_model }}</p>
                <p><strong>Issue:</strong> {{ $booking->issue_description }}</p>
            </div>
        </div>
    </div>

    <!-- Service & Schedule -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-info text-white fw-semibold">
                <i class="fas fa-tools me-2"></i> Service & Schedule
            </div>
            <div class="card-body">
                <p><strong>Service:</strong> {{ $booking->service->name ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $booking->booking_date->format('d M Y') }}</p>
                <p><strong>Time:</strong> {{ $booking->booking_time }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Notes Section -->
@if($booking->notes)
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-secondary text-white fw-semibold">
        <i class="fas fa-sticky-note me-2"></i> Admin Notes
    </div>
    <div class="card-body">
        <p class="mb-0">{{ $booking->notes }}</p>
    </div>
</div>
@endif

<!-- Footer Actions -->
<div class="d-flex justify-content-end mt-4">
    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?')" class="me-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Delete
        </button>
    </form>
</div>
```

</div>
@endsection
