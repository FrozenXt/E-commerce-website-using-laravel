@extends('layouts.app')

@section('title', 'About Us - Smart Techno Hub')

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

    /* Hero Section */
    .about-hero {
        position: relative;
        text-align: center;
        color: var(--white);
        padding: 100px 20px;
        background: linear-gradient(135deg, var(--primary-dark), var(--secondary)), 
                    url('https://images.unsplash.com/photo-1521791136064-7986c2920216?fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top:0; left:0; right:0; bottom:0;
        background: rgba(0,0,0,0.4);
    }

    .about-hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        animation: fadeInUp 1s ease forwards;
    }

    .about-hero h1 {
        font-size: 3rem; /* Matches layout header font size */
        font-weight: 700;
        margin-bottom: 20px;
    }

    .about-hero p {
        font-size: 1.15rem; /* Matches layout body font */
        color: #d1d5db;
        line-height: 1.7;
    }

    /* About Section */
    .about-section {
        padding: 80px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title h2 {
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--primary-dark);
    }

    .section-title p {
        color: var(--gray);
        font-size: 1.05rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .about-content {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        align-items: center;
        justify-content: center;
    }

    .about-text {
        flex: 1;
        min-width: 300px;
        animation: fadeInLeft 1s ease forwards;
    }

    .about-text .about-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 25px;
    }

    .about-text .about-item i {
        font-size: 1.5rem;
        color: var(--primary-dark);
        margin-top: 5px;
        min-width: 30px;
    }

    .about-text h3 {
        font-size: 1.5rem;
        margin-bottom: 8px;
        color: var(--primary-dark);
    }

    .about-text p {
        font-size: 1rem;
        line-height: 1.7;
        color: var(--gray);
    }

    .about-image {
        flex: 1;
        min-width: 300px;
        position: relative;
        animation: fadeInRight 1s ease forwards;
    }

    .about-image img {
        width: 100%;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        object-fit: cover;
    }

    /* Features Section */
    .features-section {
        background: var(--white);
        padding: 80px 20px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .feature-card {
        background: var(--light);
        padding: 30px 25px;
        border-radius: var(--radius);
        text-align: center;
        transition: var(--transition);
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .feature-card i {
        font-size: 2.5rem;
        color: var(--primary-dark);
        margin-bottom: 20px;
        transition: var(--transition);
    }

    .feature-card h4 {
        font-size: 1.3rem;
        margin-bottom: 15px;
        color: var(--primary-dark);
    }

    .feature-card p {
        font-size: 0.95rem;
        color: var(--gray);
        line-height: 1.6;
    }

    /* Team Section */
    .team-section {
        padding: 80px 20px;
        background: var(--light);
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        justify-items: center;
    }

    .team-member {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        text-align: center;
        padding: 25px;
        transition: var(--transition);
    }

    .team-member img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        transition: var(--transition);
    }

    .team-member:hover img {
        transform: scale(1.1);
    }

    .team-member h5 {
        font-size: 1.2rem;
        color: var(--primary-dark);
        margin-bottom: 5px;
    }

    .team-member span {
        font-size: 0.9rem;
        color: var(--gray);
    }

    /* Animations */
    @keyframes fadeInUp { from {opacity:0; transform: translateY(30px);} to {opacity:1; transform: translateY(0);} }
    @keyframes fadeInLeft { from {opacity:0; transform: translateX(-50px);} to {opacity:1; transform: translateX(0);} }
    @keyframes fadeInRight { from {opacity:0; transform: translateX(50px);} to {opacity:1; transform: translateX(0);} }

    /* Responsive */
    @media(max-width: 768px){
        .about-content {
            flex-direction: column;
        }
    }

</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>About Smart Techno Hub</h1>
            <p>We are a professional mobile repair, sales, and tech solutions center dedicated to providing reliable services with cutting-edge technology and expert technicians.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="section-title">
            <h2>Who We Are</h2>
            <p>Smart Techno Hub is committed to delivering high-quality mobile, gadget, and IT services for individuals and businesses alike.</p>
        </div>
        <div class="about-content">
            <div class="about-text">
                <div class="about-item">
                    <i class="fas fa-bullseye"></i>
                    <div>
                        <h3>Our Mission</h3>
                        <p>To provide trustworthy and efficient tech solutions that keep our clients connected and productive at all times.</p>
                    </div>
                </div>
                <div class="about-item">
                    <i class="fas fa-eye"></i>
                    <div>
                        <h3>Our Vision</h3>
                        <p>To become the most reliable and innovative tech hub in Nepal, offering premium services and products.</p>
                    </div>
                </div>
                <div class="about-item">
                    <i class="fas fa-thumbs-up"></i>
                    <div>
                        <h3>Why Choose Us?</h3>
                        <p>Expert technicians, genuine parts, fast turnaround, and customer satisfaction guaranteed.</p>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1581091870629-1fc6cf2ed06c?fit=crop&w=800&q=80" alt="About Smart Techno Hub">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-title">
            <h2>Our Expertise</h2>
            <p>We specialize in a wide range of mobile, IT, and tech services to meet every requirement.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card"><i class="fas fa-tools"></i>
                <h4>Mobile Repairs</h4>
                <p>All kinds of smartphone repairs with warranty and genuine parts.</p>
            </div>
            <div class="feature-card"><i class="fas fa-mobile-alt"></i>
                <h4>Device Sales</h4>
                <p>Buy new, used, or certified refurbished phones at best prices.</p>
            </div>
            <div class="feature-card"><i class="fas fa-headphones"></i>
                <h4>Accessories & Gadgets</h4>
                <p>Premium quality accessories and smart devices to enhance your experience.</p>
            </div>
            <div class="feature-card"><i class="fas fa-sync-alt"></i>
                <h4>Software Updates</h4>
                <p>Professional OS updates, system optimization, and troubleshooting.</p>
            </div>
            <div class="feature-card"><i class="fas fa-shield-alt"></i>
                <h4>Data Recovery</h4>
                <p>Advanced security and data recovery solutions for your devices.</p>
            </div>
            <div class="feature-card"><i class="fas fa-user-cog"></i>
                <h4>Consultation</h4>
                <p>Technical advice and customized solutions for personal or business needs.</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="section-title">
            <h2>Meet Our Team</h2>
            <p>Our skilled professionals are passionate about technology and customer satisfaction.</p>
        </div>
        <div class="team-grid">
            <div class="team-member">
                <img src="https://images.unsplash.com/photo-1603415526960-f9e5f8c6b7e0?fit=crop&w=400&q=80" alt="Team Member">
                <h5>John Doe</h5>
                <span>Lead Technician</span>
            </div>
            <div class="team-member">
                <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?fit=crop&w=400&q=80" alt="Team Member">
                <h5>Jane Smith</h5>
                <span>Customer Support</span>
            </div>
            <div class="team-member">
                <img src="https://images.unsplash.com/photo-1595152772835-219674b2a8a3?fit=crop&w=400&q=80" alt="Team Member">
                <h5>Michael Brown</h5>
                <span>Software Specialist</span>
            </div>
        </div>
    </section>
@endsection
