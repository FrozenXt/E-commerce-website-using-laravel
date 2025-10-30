@extends('layouts.app')

@section('title', 'Book a Repair - Smart Techno Hub')

@push('styles')
<style>
:root {
    --primary: #1a1a1a;
    --primary-dark: #000000;
    --secondary: #333333;
    --dark: #1e293b;
    --light: #f8fafc;
    --gray: #64748b;
    --gray-light: #e2e8f0;
    --danger: #ef4444;
    --success: #10b981;
    --white: #ffffff;
    --shadow: 0 1px 3px 0 rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 25px -5px rgba(0,0,0,0.1);
    --radius: 12px;
    --transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
}

.booking-hero {
    position: relative;
    text-align: center;
    color: var(--white);
    padding: 100px 20px;
    background: linear-gradient(135deg, var(--primary-dark), var(--secondary)),
                url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?fit=crop&w=1950&q=80');
    background-size: cover;
    background-position: center;
}

.booking-hero::before {
    content: '';
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.55);
}

.booking-hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    animation: fadeInUp 1s ease forwards;
}

.booking-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.booking-hero p {
    font-size: 1.2rem;
    color: #d1d5db;
    line-height: 1.7;
}

/* Booking Form */
.booking-form-section {
    max-width: 900px;
    margin: 80px auto;
    padding: 0 20px;
}

.booking-form {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow-lg);
    padding: 50px 40px;
    transition: var(--transition);
}

.booking-form .form-group {
    position: relative;
    margin-bottom: 25px;
}

.booking-form input,
.booking-form select,
.booking-form textarea {
    width: 100%;
    border: none;
    border-bottom: 2px solid var(--gray-light);
    padding: 12px 0;
    font-size: 1rem;
    background: transparent;
    transition: var(--transition);
    outline: none;
    color: var(--dark);
}

.booking-form input:focus,
.booking-form select:focus,
.booking-form textarea:focus {
    border-color: var(--primary-dark);
}

.booking-form label {
    position: absolute;
    top: 12px;
    left: 0;
    font-size: 1rem;
    color: var(--gray);
    pointer-events: none;
    transition: 0.3s ease all;
}

.booking-form input:focus + label,
.booking-form input:not(:placeholder-shown) + label,
.booking-form select:focus + label,
.booking-form select:not([value=""]) + label,
.booking-form textarea:focus + label,
.booking-form textarea:not(:placeholder-shown) + label {
    top: -18px;
    font-size: 0.85rem;
    color: var(--primary-dark);
}

.booking-form textarea {
    resize: vertical;
    min-height: 100px;
}

.booking-form button {
    background: var(--primary-dark);
    color: var(--white);
    padding: 14px 25px;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: var(--transition);
}

.booking-form button:hover {
    background: var(--primary);
    transform: translateY(-3px);
    box-shadow: var(--shadow);
}

/* Animation */
@keyframes fadeInUp { 
    from {opacity:0; transform: translateY(30px);} 
    to {opacity:1; transform: translateY(0);}
}

@media(max-width:768px){
    .booking-hero h1 { font-size:2.2rem; }
    .booking-hero p { font-size:1rem; }
}
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="booking-hero">
    <div class="booking-hero-content">
        <h1>Book Your Device Repair</h1>
        <p>Fast, reliable, and professional service at Smart Techno Hub. Fill the form and let us handle the rest.</p>
    </div>
</section>

<!-- Booking Form -->
<section class="booking-form-section">
    <div class="text-center mb-5">
        <h2>Secure Your Repair Slot</h2>
        <p style="color:var(--gray); max-width:700px; margin:0 auto;">Choose your service, enter your device details, and pick a convenient time. We'll take care of everything else.</p>
    </div>

    <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
        @csrf
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
         
            <select name="service_id" required>
                <option value="" disabled selected></option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            <label>Select Service</label>
        </div>

        <div class="form-group">
            <input type="text" name="customer_name" placeholder=" " value="{{ old('customer_name') }}" required>
            <label>Your Name</label>
        </div>

        <div class="form-group">
            <input type="email" name="customer_email" placeholder=" " value="{{ old('customer_email') }}" required>
            <label>Email Address</label>
        </div>

        <div class="form-group">
            <input type="text" name="customer_phone" placeholder=" " value="{{ old('customer_phone') }}" required>
            <label>Phone Number</label>
        </div>

        <div class="form-group">
            <input type="text" name="device_brand" placeholder=" " value="{{ old('device_brand') }}" required>
            <label>Device Brand</label>
        </div>

        <div class="form-group">
            <input type="text" name="device_model" placeholder=" " value="{{ old('device_model') }}" required>
            <label>Device Model</label>
        </div>

        <div class="form-group">
            <textarea name="issue_description" placeholder=" " required>{{ old('issue_description') }}</textarea>
            <label>Describe the Issue</label>
        </div>

        <div class="form-group" style="display:flex; gap:15px; flex-wrap:wrap;">
            <input type="date" name="booking_date" required style="flex:1;">
            <input type="time" name="booking_time" required style="flex:1;">
        </div>

        <button type="submit">Confirm Booking</button>
    </form>
</section>

@endsection
