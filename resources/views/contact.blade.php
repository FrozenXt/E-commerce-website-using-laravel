@extends('layouts.app')

@section('title', 'Contact Us - Smart Techno Hub')

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
    --warning: #f59e0b;
    --success: #10b981;
    --white: #ffffff;
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    --radius: 16px;
    --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}

.contact-hero {
    position: relative;
    text-align: center;
    color: var(--white);
    padding: 100px 20px;
    background: linear-gradient(135deg, var(--primary-dark), var(--secondary)), 
                url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?fit=crop&w=1950&q=80');
    background-size: cover;
    background-position: center;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.4);
}

.contact-hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    animation: fadeInUp 1s ease forwards;
}

.contact-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.contact-hero p {
    font-size: 1.1rem;
    color: #d1d5db;
    line-height: 1.7;
}

/* Contact Info Cards */
.contact-info {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    margin: 80px 0;
}

.contact-card {
    flex: 1;
    min-width: 250px;
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 30px;
    text-align: center;
    transition: var(--transition);
    position: relative;
}

.contact-card i {
    font-size: 2rem;
    color: var(--primary-dark);
    margin-bottom: 15px;
    transition: var(--transition);
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.contact-card h4 {
    font-size: 1.25rem;
    margin-bottom: 10px;
    color: var(--primary-dark);
}

.contact-card p {
    color: var(--gray);
    font-size: 0.95rem;
    line-height: 1.6;
}

/* Contact Form */
.contact-form-section {
    max-width: 900px;
    margin: 0 auto 80px auto;
    padding: 0 20px;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    background: var(--white);
    padding: 40px;
    border-radius: var(--radius);
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
}

.contact-form input,
.contact-form textarea {
    border: 1px solid var(--gray-light);
    border-radius: var(--radius);
    padding: 12px 15px;
    font-size: 1rem;
    transition: var(--transition);
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: var(--primary-dark);
    outline: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.contact-form button {
    background: var(--primary-dark);
    color: var(--white);
    padding: 14px 25px;
    border: none;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.contact-form button:hover {
    background: var(--primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

/* Map Section */
.map-container {
    margin: 0 auto 100px auto;
    max-width: 1200px;
    height: 400px;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    animation: fadeInUp 1s ease forwards;
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

/* Alerts */
.alert {
    border-radius: var(--radius);
    padding: 15px 20px;
    margin-bottom: 25px;
    font-weight: 500;
}
#contact {
    margin-bottom: 20px;
    text-decoration: underline;
}

/* Animations */
@keyframes fadeInUp { from {opacity:0; transform: translateY(30px);} to {opacity:1; transform: translateY(0);} }

@media(max-width:768px){
    .contact-info { flex-direction: column; }
    .contact-form-section { padding: 0 10px; }
}
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="contact-hero">
    <div class="contact-hero-content">
        <h1>Contact Smart Techno Hub</h1>
        <p>We are here to help you! Reach out to us for tech solutions, support, or inquiries.</p>
    </div>
</section>

<!-- Contact Info Section -->
<section class="contact-info">
    <div class="contact-card">
        <i class="fas fa-map-marker-alt"></i>
        <h4>Location</h4>
        <p>Jorpati, Kathmandu, Nepal</p>
    </div>
    <div class="contact-card">
        <i class="fas fa-phone-alt"></i>
        <h4>Phone</h4>
        <p>+977 9869415250</p>
    </div>
    <div class="contact-card">
        <i class="fas fa-envelope"></i>
        <h4>Email</h4>
        <p>smarttechnohub@gmail.com</p>
    </div>
</section>

<!-- Success/Error Messages -->
<div class="container" style="max-width:900px; margin-bottom:40px;">
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
</div>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
        @csrf
        <h1 align="center" id="contact">Contact us</h1>
        <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
        <input type="text" name="phone" placeholder="Phone Number (optional)" value="{{ old('phone') }}">
        <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
        <textarea name="message" rows="6" placeholder="Your Message" required>{{ old('message') }}</textarea>
        <button type="submit">Send Message</button>
    </form>
</section>

<!-- Map Section -->
<section class="map-container">
     <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.00000!2d85.374816!3d27.7219349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1a6b3b41b3cf%3A0x8b1d063f3e2efb60!2sSmart%20Techno%20Hub!5e0!3m2!1sen!2snp!4v1698573300000!5m2!1sen!2snp"
    width="100%"
    height="400"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</section>

@endsection
