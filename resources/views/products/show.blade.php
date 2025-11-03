@extends('layouts.app')

@section('title', $product->name . ' - Smart Techno Hub')

@push('styles')
<style>
    .product-detail {
        padding: 60px 0;
    }

    .product-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 80px;
    }

    .product-gallery {
        position: sticky;
        top: 180px;
        height: fit-content;
    }

    .main-image {
        background: var(--white);
        border-radius: var(--radius);
        padding: 40px;
        margin-bottom: 20px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
    }

    .main-image img {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
    }

    .product-details {
        background: var(--white);
        padding: 40px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .product-category-tag {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .stars {
        color: var(--warning);
        font-size: 1.1rem;
    }

    .rating-text {
        color: var(--gray);
        font-size: 0.95rem;
    }

    .product-price-section {
        background: var(--light);
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .price-display {
        display: flex;
        align-items: baseline;
        gap: 15px;
        margin-bottom: 10px;
    }

    .current-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
    }

    .old-price {
        font-size: 1.5rem;
        color: var(--gray);
        text-decoration: line-through;
    }

    .discount-badge {
        background: var(--danger);
        color: var(--white);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 700;
    }

    .stock-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: var(--success);
        color: var(--white);
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .stock-status.out-of-stock {
        background: var(--danger);
    }

    .product-description {
        margin-bottom: 30px;
    }

    .product-description h3 {
        font-size: 1.3rem;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .product-description p {
        color: var(--gray);
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .product-info-list {
        list-style: none;
        margin-bottom: 30px;
    }

    .product-info-list li {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid var(--gray-light);
    }

    .info-label {
        font-weight: 600;
        color: var(--dark);
        width: 150px;
    }

    .info-value {
        color: var(--gray);
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .btn-add-cart {
        flex: 1;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 18px 35px;
        border-radius: 8px;
        border: none;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-add-cart:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
    }

    .btn-contact {
        padding: 18px 35px;
        background: var(--white);
        border: 2px solid var(--primary);
        color: var(--primary);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-contact:hover {
        background: var(--primary);
        color: var(--white);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid var(--gray-light);
    }

    .feature-item {
        text-align: center;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        background: var(--light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 1.5rem;
        color: var(--primary);
    }

    .feature-item h4 {
        font-size: 0.95rem;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .feature-item p {
        font-size: 0.85rem;
        color: var(--gray);
    }

    /* Related Products */
    .related-section {
        padding: 60px 0;
        background: var(--light);
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .related-card {
        background: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }

    .related-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .related-image {
        height: 250px;
        background: var(--light);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-info {
        padding: 25px;
    }

    .related-info h3 {
        font-size: 1.1rem;
        margin-bottom: 12px;
        color: var(--dark);
    }

    .related-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 15px;
    }

    @media (max-width: 1024px) {
        .product-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .product-gallery {
            position: static;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .product-title {
            font-size: 2rem;
        }

        .current-price {
            font-size: 2rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="product-detail">
    <div class="container">
        <div class="product-container">
            <!-- Product Gallery -->
            <div class="product-gallery">
                <div class="main-image">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                    <i class="fas fa-mobile-alt" style="font-size: 8rem; color: var(--gray-light);"></i>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <span class="product-category-tag">{{ $product->category->name }}</span>
                
                <h1 class="product-title">{{ $product->name }}</h1>

                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="rating-text">(5.0 rating)</span>
                </div>

                <div class="product-price-section">
                    <div class="price-display">
                        <span class="current-price">Rs {{ number_format($product->final_price, 2) }}</span>
                        @if($product->discount_price)
                        <span class="old-price">Rs {{ number_format($product->price, 2) }}</span>
                        <span class="discount-badge">Save {{ $product->discount_percentage }}%</span>
                        @endif
                    </div>
                    @if($product->stock > 0)
                    <span class="stock-status">
                        <i class="fas fa-check-circle"></i> In Stock ({{ $product->stock }} available)
                    </span>
                    @else
                    <span class="stock-status out-of-stock">
                        <i class="fas fa-times-circle"></i> Out of Stock
                    </span>
                    @endif
                </div>

                <div class="product-description">
                    <h3>Product Description</h3>
                    <p>{{ $product->description }}</p>
                </div>

                <ul class="product-info-list">
                    <li>
                        <span class="info-label">Brand:</span>
                        <span class="info-value">{{ $product->brand ?? 'Generic' }}</span>
                    </li>
                    <li>
                        <span class="info-label">Category:</span>
                        <span class="info-value">{{ $product->category->name }}</span>
                    </li>
                    <li>
                        <span class="info-label">Availability:</span>
                        <span class="info-value">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                    </li>
                    <li>
                        <span class="info-label">SKU:</span>
                        <span class="info-value">#{{ strtoupper($product->slug) }}</span>
                    </li>
                </ul>

                <div class="action-buttons">
    <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">
        @csrf
        @if($product->stock > 0)
        <button type="submit" class="btn-add-cart">
            <i class="fas fa-shopping-cart"></i>
            Add to Cart
        </button>
        @else
        <button type="button" class="btn-add-cart" disabled style="opacity: 0.5; cursor: not-allowed;">
            <i class="fas fa-times-circle"></i>
            Out of Stock
        </button>
        @endif
    </form>
    <a href="{{ route('contact') }}" class="btn-contact">
        <i class="fas fa-envelope"></i>
        Inquire
    </a>
</div>

<script>
    document.getElementById('addToCartForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                alert('Product added to cart successfully!');
                // Redirect to cart
                window.location.href = '/cart';
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>



                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h4>Fast Delivery</h4>
                        <p>2-3 business days</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Warranty</h4>
                        <p>1 year warranty</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h4>Easy Returns</h4>
                        <p>30-day return</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="related-section">
    <div class="container">
        <div class="section-title">
            <h2>Related Products</h2>
            <p>You might also like these products</p>
        </div>
        <div class="related-grid">
            @foreach($relatedProducts as $related)
            <div class="related-card">
                <div class="related-image">
                    @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                    @else
                    <i class="fas fa-mobile-alt" style="font-size: 3rem; color: var(--gray);"></i>
                    @endif
                </div>
                <div class="related-info">
                    <h3>{{ $related->name }}</h3>
                    <div class="related-price">Rs {{ number_format($related->final_price, 2) }}</div>
                    <a href="{{ route('products.show', $related->slug) }}" class="btn-view">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection