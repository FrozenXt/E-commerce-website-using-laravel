@extends('layouts.app')

@section('title', 'Shop - Smart Techno Hub')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.95) 100%);
        color: var(--white);
        padding: 60px 0;
        text-align: center;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        gap: 10px;
        list-style: none;
        font-size: 0.95rem;
    }

    .breadcrumb a {
        color: var(--white);
        text-decoration: none;
        opacity: 0.9;
    }

    .breadcrumb a:hover {
        opacity: 1;
    }

    .shop-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
        padding: 60px 0;
    }

    .sidebar {
        position: sticky;
        top: 180px;
        height: fit-content;
    }

    .filter-section {
        background: var(--white);
        border-radius: var(--radius);
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: var(--shadow);
    }

    .filter-section h3 {
        font-size: 1.1rem;
        margin-bottom: 20px;
        color: var(--dark);
        font-weight: 700;
    }

    .filter-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-option:hover {
        color: var(--primary);
    }

    .filter-option input[type="radio"] {
        accent-color: var(--primary);
    }

    .category-count {
        margin-left: auto;
        background: var(--light);
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.85rem;
        color: var(--gray);
    }

    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-box input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 2px solid var(--gray-light);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .search-box button {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary);
        color: var(--white);
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        cursor: pointer;
    }

    .shop-header {
        background: var(--white);
        padding: 20px 25px;
        border-radius: var(--radius);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: var(--shadow);
    }

    .results-count {
        font-weight: 600;
        color: var(--dark);
    }

    .sort-select {
        padding: 10px 15px;
        border: 2px solid var(--gray-light);
        border-radius: 8px;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .sort-select:focus {
        outline: none;
        border-color: var(--primary);
    }

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
        height: 280px;
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

    .stock-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--success);
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
        line-height: 1.4;
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

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 50px;
        list-style: none;
    }

    .pagination a,
    .pagination span {
        padding: 10px 16px;
        border: 2px solid var(--gray-light);
        border-radius: 8px;
        text-decoration: none;
        color: var(--dark);
        transition: var(--transition);
    }

    .pagination a:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .pagination .active span {
        background: var(--primary);
        color: var(--white);
        border-color: var(--primary);
    }

    .no-products {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        background: var(--white);
        border-radius: var(--radius);
    }

    .no-products i {
        font-size: 4rem;
        color: var(--gray-light);
        margin-bottom: 20px;
    }

    @media (max-width: 1024px) {
        .shop-container {
            grid-template-columns: 1fr;
        }

        .sidebar {
            position: static;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .shop-header {
            flex-direction: column;
            gap: 15px;
        }

        .sidebar {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>Our Shop</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>/</li>
            <li>Shop</li>
        </ul>
    </div>
</div>

<!-- Shop Container -->
<div class="container">
    <div class="shop-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Search -->
            <form action="{{ route('products.index') }}" method="GET">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>

                <!-- Categories Filter -->
                <div class="filter-section">
                    <h3>Categories</h3>
                    <label class="filter-option">
                        <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>All Products</span>
                        <span class="category-count">{{ $products->total() }}</span>
                    </label>
                    @foreach($categories as $category)
                    <label class="filter-option">
                        <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>{{ $category->name }}</span>
                        <span class="category-count">{{ $category->products_count }}</span>
                    </label>
                    @endforeach
                </div>
            </form>
        </aside>

        <!-- Main Content -->
        <div>
            <!-- Shop Header -->
            <div class="shop-header">
                <div class="results-count">
                    Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                </div>
                <form action="{{ route('products.index') }}" method="GET" id="sortForm">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="sort" class="sort-select" onchange="document.getElementById('sortForm').submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                    </select>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                @forelse($products as $product)
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
                        @if($product->stock > 0)
                        <span class="stock-badge">In Stock</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-category">{{ $product->category->name }}</div>
                        <h3>{{ $product->name }}</h3>
                        <div class="product-price">
                            <span class="price-current">Rs {{ number_format($product->final_price, 2) }}</span>
                            @if($product->discount_price)
                            <span class="price-old">Rs {{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="btn-view">View Details</a>
                    </div>
                </div>
                @empty
                <div class="no-products">
                    <i class="fas fa-box-open"></i>
                    <h3>No Products Found</h3>
                    <p>Try adjusting your search or filter criteria</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="pagination">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection