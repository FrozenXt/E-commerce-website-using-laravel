@extends('layouts.app')

@section('title', 'Smart Techno Hub - Services')

@push('styles')
<style>
    /* ==============================
       SMART TECHNO HUB SERVICE PAGE
       ============================== */
    .services-page {
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

    .services-page {
        font-family: "Poppins", sans-serif;
        background-color: var(--light);
        color: var(--dark);
    }

    /* Title section */
    .services-hero {
        text-align: center;
        padding: 90px 20px 60px;
        background: linear-gradient(90deg, var(--primary-dark), var(--secondary));
        color: var(--white);
    }

    .services-hero h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .services-hero p {
        font-size: 1.1rem;
        color: #d1d5db;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Horizontal services container */
    .services-wrapper {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        scroll-behavior: smooth;
        gap: 30px;
        padding: 60px 40px;
        background: var(--light);
    }

    .services-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .services-wrapper::-webkit-scrollbar-thumb {
        background: var(--secondary);
        border-radius: 10px;
    }

    /* Service Card */
    .service-card {
        flex: 0 0 380px;
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 40px 25px;
        position: relative;
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 5px;
        width: 100%;
        background: var(--primary-dark);
        transform: scaleX(0);
        transition: var(--transition);
        transform-origin: left;
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--success);
        color: var(--white);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .service-icon {
        font-size: 2.8rem;
        background: var(--gray-light);
        color: var(--primary-dark);
        width: 90px;
        height: 90px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: var(--transition);
    }

    .service-card:hover .service-icon {
        background: var(--primary-dark);
        color: var(--white);
        transform: rotateY(180deg);
    }

    .service-card h4 {
        font-weight: 600;
        font-size: 1.4rem;
        color: var(--primary-dark);
        margin-bottom: 15px;
    }

    .service-card p {
        font-size: 1rem;
        color: var(--gray);
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .service-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 25px;
    }

    .feature-tag {
        background: var(--gray-light);
        color: var(--dark);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .btn-learn {
        align-self: flex-start;
        background: var(--primary-dark);
        color: var(--white);
        padding: 10px 20px;
        border-radius: var(--radius);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        border: 2px solid var(--primary-dark);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-learn:hover {
        background: transparent;
        color: var(--primary-dark);
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .services-wrapper {
            flex-wrap: wrap;
            justify-content: center;
            padding: 40px 20px;
        }

        .service-card {
            flex: 0 0 90%;
        }
    }
</style>
@endpush

@section('content')
<div class="services-page">
    <!-- Hero Section -->
    <section class="services-hero">
        <h1>Our Premium Tech Services</h1>
        <p>At Smart Techno Hub, we combine innovation and expertise to provide exceptional mobile, gadget, and IT solutions — fast, reliable, and affordable.</p>
    </section>

    <!-- Services Section -->
    <section class="services-wrapper">
        <!-- Service 1 -->
        <div class="service-card">
            <div class="service-badge">Most Popular</div>
            <div class="service-icon"><i class="fas fa-tools"></i></div>
            <h4>Mobile Repair & Maintenance</h4>
            <p>Comprehensive repair for all mobile brands — from cracked screens to water damage, handled by certified technicians.</p>
            <div class="service-features">
                <span class="feature-tag">Screen Repair</span>
                <span class="feature-tag">Battery Replacement</span>
                <span class="feature-tag">Motherboard Fix</span>
            </div>
            <a href="#" class="btn-learn">Learn More <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- Service 2 -->
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-mobile-alt"></i></div>
            <h4>Buy & Sell Smartphones</h4>
            <p>Purchase or exchange smartphones at the best prices — verified devices, transparent deals, and instant payouts.</p>
            <div class="service-features">
                <span class="feature-tag">Buyback Offers</span>
                <span class="feature-tag">Refurbished Phones</span>
                <span class="feature-tag">Instant Payments</span>
            </div>
            <a href="#" class="btn-learn">Explore Deals <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- Service 3 -->
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-shield-alt"></i></div>
            <h4>Device Protection Plans</h4>
            <p>Protect your gadgets with extended warranty and insurance plans covering accidental damage and breakdowns.</p>
            <div class="service-features">
                <span class="feature-tag">1-Year Coverage</span>
                <span class="feature-tag">Accidental Damage</span>
                <span class="feature-tag">Replacement Guarantee</span>
            </div>
            <a href="#" class="btn-learn">Get Covered <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- Service 4 -->
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-laptop-code"></i></div>
            <h4>Software & Data Recovery</h4>
            <p>Recover lost files, unlock devices, or reinstall OS — secure and professional service to restore your device’s performance.</p>
            <div class="service-features">
                <span class="feature-tag">Data Recovery</span>
                <span class="feature-tag">OS Installation</span>
                <span class="feature-tag">App Optimization</span>
            </div>
            <a href="#" class="btn-learn">View Services <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- Service 5 -->
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-network-wired"></i></div>
            <h4>Networking & Accessories</h4>
            <p>Get routers, chargers, cables, and other accessories — tested and recommended for durability and performance.</p>
            <div class="service-features">
                <span class="feature-tag">Wi-Fi Setup</span>
                <span class="feature-tag">Genuine Accessories</span>
                <span class="feature-tag">Fast Delivery</span>
            </div>
            <a href="#" class="btn-learn">Shop Now <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>
</div>
@endsection
