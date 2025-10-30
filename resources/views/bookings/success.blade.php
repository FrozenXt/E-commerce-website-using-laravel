@extends('layouts.app')

@section('title', 'Booking Confirmed - Smart Techno Hub')

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
    --success: #10b981;
    --white: #ffffff;
    --radius: 12px;
    --shadow: 0 1px 3px 0 rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 25px -5px rgba(0,0,0,0.1);
    --transition: all 0.3s ease;
}

.success-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 100px 20px;
    text-align: center;
    background: var(--light);
    min-height: 80vh;
}

.success-section h1 {
    font-size: 2.8rem;
    font-weight: 700;
    color: var(--primary-dark);
    margin-bottom: 20px;
    animation: fadeInUp 0.8s ease forwards;
}

.success-section p {
    color: var(--gray);
    font-size: 1.2rem;
    margin-bottom: 30px;
    max-width: 600px;
    line-height: 1.6;
}

.success-section .booking-details {
    background: var(--white);
    padding: 30px 25px;
    border-radius: var(--radius);
    box-shadow: var(--shadow-lg);
    max-width: 600px;
    width: 100%;
    margin-bottom: 30px;
    text-align: left;
}

.success-section .booking-details h4 {
    font-size: 1.2rem;
    color: var(--primary-dark);
    margin-bottom: 15px;
}

.success-section .booking-details p {
    color: var(--dark);
    font-size: 1rem;
    margin-bottom: 8px;
}

.btn-home {
    background: var(--primary-dark);
    color: var(--white);
    padding: 12px 25px;
    border-radius: var(--radius);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.btn-home:hover {
    background: var(--primary);
    transform: translateY(-3px);
    box-shadow: var(--shadow);
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px);}
    to { opacity: 1; transform: translateY(0);}
}

</style>
@endpush

@section('content')

<section class="success-section">
    <h1>Booking Confirmed!</h1>
    <p>Thank you for choosing Smart Techno Hub. Your booking has been successfully registered. We will contact you shortly to confirm your appointment.</p>

    <div class="booking-details">
        <h4>Booking Details:</h4>
        <p><strong>Service:</strong> {{ $booking->service->name }}</p>
        <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
        <p><strong>Email:</strong> {{ $booking->customer_email }}</p>
        <p><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
        <p><strong>Device:</strong> {{ $booking->device_brand }} {{ $booking->device_model }}</p>
        <p><strong>Issue:</strong> {{ $booking->issue_description }}</p>
        <p><strong>Booking Date:</strong> {{ $booking->booking_date }} at {{ $booking->booking_time }}</p>
    </div>

    <a href="{{ route('home') }}" class="btn-home">Go to Home</a>
</section>

@endsection
