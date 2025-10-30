@extends('layouts.app')

@section('title', 'Smart Techno Hub - Professional Mobile Repair & Sales Center')

@push('styles')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.9) 100%), 
                    url('https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        padding: 120px 0;
        color: var(--white);
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 700px;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero p {
        font-size: 1.25rem;
        margin-bottom: 40px;
        opacity: 0.95;
        line-height: 1.7;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 16px 35px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        display: inline-block;
        font-size: 1rem;
    }

    .btn-white {
        background: var(--white);
        color: var(--primary);
    }

    .btn-white:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-outline {
        background: transparent;
        color: var(--white);
        border: 2px solid var(--white);
    }

    .btn-outline:hover {
        background: var(--white);
        color: var(--primary);
    }

    /* Features */
    .features {
        background: var(--white);
        margin-top: -60px;
        position: relative;
        z-index: 2;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 0;
    }

    .feature-card {
        padding: 40px 30px;
        text-align: center;
        border-right: 1px solid var(--gray-light);
        transition: var(--transition);
    }

    .feature-card:last-child {
        border-right: none;
    }

    .feature-card:hover {
        background: var(--light);
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.8rem;
        color: var(--white);
    }

    .feature-card h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: var(--dark);
    }

    .feature-card p {
        color: var(--gray);
        font-size: 0.95rem;
    }

    /* Services */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .service-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 40px 30px;
        text-align: center;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2rem;
        color: var(--white);
    }

    .service-card h3 {
        font-size: 1.3rem;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .service-card p {
        color: var(--gray);
        margin-bottom: 20px;
        line-height: 1.7;
    }

    .service-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .btn-service {
        background: var(--primary);
        color: var(--white);
        padding: 12px 30px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-service:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Products */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .product-card {
        background: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .product-image {
        height: 250px;
        background: var(--light);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--danger);
        color: var(--white);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .product-info {
        padding: 25px;
    }

    .product-category {
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .product-info h3 {
        font-size: 1.2rem;
        margin-bottom: 12px;
        color: var(--dark);
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .price-current {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .price-old {
        font-size: 1.1rem;
        color: var(--gray);
        text-decoration: line-through;
    }

    .btn-view {
        width: 100%;
        background: var(--primary);
        color: var(--white);
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        display: block;
        text-align: center;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-view:hover {
        background: var(--primary-dark);
    }

    /* Testimonials */
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    .testimonial-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 35px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .testimonial-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.5rem;
        font-weight: 700;
    }

    .testimonial-info h4 {
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .testimonial-rating {
        color: var(--warning);
    }

    .testimonial-text {
        color: var(--gray);
        line-height: 1.7;
        font-style: italic;
    }

    /* CTA Section */
    .cta {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--white);
        text-align: center;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .cta::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    }

    .cta-content {
        position: relative;
        z-index: 1;
        max-width: 700px;
        margin: 0 auto;
    }

    .cta h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .cta p {
        font-size: 1.2rem;
        margin-bottom: 40px;
        opacity: 0.95;
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }

        .hero p {
            font-size: 1.1rem;
        }

        .hero-buttons {
            flex-direction: column;
        }

        .feature-card {
            border-right: none;
            border-bottom: 1px solid var(--gray-light);
        }

        .feature-card:last-child {
            border-bottom: none;
        }

        .cta h2 {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Professional Mobile Repair & Sales</h1>
            <p>Get your device fixed by certified technicians. Fast, reliable, and affordable repair services with a warranty. Shop the latest mobile accessories.</p>
            <div class="hero-buttons">
                <a href="{{ route('booking.create') }}" class="btn btn-white">Book Repair Now</a>
                <a href="{{ route('products.index') }}" class="btn btn-outline">Shop Products</a>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="container" style="margin-top: -30px;">
    <div class="features">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Expert Technicians</h3>
                <p>Certified professionals with years of experience</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Fast Service</h3>
                <p>Most repairs completed within 24 hours</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Warranty Included</h3>
                <p>90-day warranty on all repairs</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <h3>Best Prices</h3>
                <p>Competitive pricing with no hidden fees</p>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="section" style="background: var(--light);">
    <div class="container">
        <div class="section-title">
            <h2>Our Repair Services</h2>
            <p>We offer professional repair services for all major mobile brands</p>
        </div>
        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card">
                <div class="service-icon">
                    <i class="{{ $service->icon }}"></i>
                </div>
                <h3>{{ $service->name }}</h3>
                <p>{{ Str::limit($service->description, 100) }}</p>
                <div class="service-price">${{ number_format($service->price, 2) }}</div>
                <a href="{{ route('booking.create') }}?service={{ $service->id }}" class="btn-service">Book Now</a>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p>No services available at the moment.</p>
            </div>
            @endforelse
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('services.index') }}" class="btn-primary">View All Services</a>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
            <p>Check out our latest and most popular mobile accessories</p>
        </div>
        <div class="products-grid">
            @forelse($featuredProducts as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                    <i class="fas fa-mobile-alt" style="font-size: 4rem; color: var(--gray);"></i>
                    @endif
                    @if($product->discount_percentage > 0)
                    <span class="product-badge">-{{ $product->discount_percentage }}%</span>
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-category">{{ $product->category->name }}</div>
                    <h3>{{ $product->name }}</h3>
                    <div class="product-price">
                        <span class="price-current">${{ number_format($product->final_price, 2) }}</span>
                        @if($product->discount_price)
                        <span class="price-old">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="btn-view">View Details</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p>No products available at the moment.</p>
            </div>
            @endforelse
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('products.index') }}" class="btn-primary">View All Products</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section" style="background: var(--light);">
    <div class="container">
        <div class="section-title">
            <h2>What Our Customers Say</h2>
            <p>Real reviews from real customers</p>
        </div>
        <div class="testimonials-grid">
            @forelse($testimonials as $testimonial)
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        {{ substr($testimonial->customer_name, 0, 1) }}
                    </div>
                    <div class="testimonial-info">
                        <h4>{{ $testimonial->customer_name }}</h4>
                        <div class="testimonial-rating">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="testimonial-text">"{{ $testimonial->review }}"</p>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p>No testimonials available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="cta-content">
        <h2>Need a Repair Right Away?</h2>
        <p>Book an appointment now and get your device fixed by our expert technicians. Same-day service available!</p>
        <a href="{{ route('booking.create') }}" class="btn btn-white">Book Appointment Now</a>
    </div>
</section>
@endsection