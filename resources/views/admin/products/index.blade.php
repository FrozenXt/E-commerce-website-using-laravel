@extends('admin.layouts.app')

@section('title', 'Products Management')
@section('page-title', 'Products Management')

@section('content')

<div class="products-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-box"></i> Products Management
            </h1>
            <p class="page-subtitle">Manage your product inventory and details</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary-custom">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Filters & Search Section -->
    <div class="filters-section">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search by product name, brand..." class="search-input">
        </div>
        <div class="filter-group">
            <select id="categoryFilter" class="filter-select">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <select id="statusFilter" class="filter-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <select id="stockFilter" class="filter-select">
                <option value="">All Stock</option>
                <option value="in-stock">In Stock</option>
                <option value="low-stock">Low Stock</option>
                <option value="out-stock">Out of Stock</option>
            </select>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Total Products</p>
                <h3 class="stat-value">{{ $products->total() ?? count($products) }}</h3>
            </div>
        </div>
        <div class="stat-card stat-active">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Active Products</p>
                <h3 class="stat-value">{{ $products->where('is_active', true)->count() ?? 0 }}</h3>
            </div>
        </div>
        <div class="stat-card stat-low">
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Low Stock</p>
                <h3 class="stat-value">{{ $products->where('stock', '<=', 10)->count() ?? 0 }}</h3>
            </div>
        </div>
        <div class="stat-card stat-featured">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Featured</p>
                <h3 class="stat-value">{{ $products->where('is_featured', true)->count() ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Products Grid / List -->
    <div class="products-content">
        @forelse($products as $product)
            <div class="product-card" data-category="{{ $product->category->name }}" 
                 data-status="{{ $product->is_active ? 'active' : 'inactive' }}"
                 data-stock="{{ $product->stock > 10 ? 'in-stock' : ($product->stock > 0 ? 'low-stock' : 'out-stock') }}">
                
                <!-- Product Image -->
                <div class="product-image">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-product">
                    @else
                        <div class="img-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="status-overlay">
                        @if($product->is_featured)
                            <span class="badge-featured">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>

                    <!-- Stock Badge -->
                    <div class="stock-badge">
                        @if($product->stock > 10)
                            <span class="badge-stock in-stock">
                                <i class="fas fa-check"></i> In Stock
                            </span>
                        @elseif($product->stock > 0)
                            <span class="badge-stock low-stock">
                                <i class="fas fa-exclamation"></i> Low Stock
                            </span>
                        @else
                            <span class="badge-stock out-stock">
                                <i class="fas fa-times"></i> Out
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    
                    <p class="product-brand">
                        <i class="fas fa-tag"></i> {{ $product->brand ?? 'No brand' }}
                    </p>

                    <p class="product-category">
                        <i class="fas fa-folder"></i> {{ $product->category->name }}
                    </p>

                    <!-- Price Section -->
                    <div class="price-section">
                        <div class="price-info">
                            <span class="price-current">${{ number_format($product->final_price, 2) }}</span>
                            @if($product->discount_price)
                                <span class="price-original">${{ number_format($product->price, 2) }}</span>
                                <span class="price-discount">
                                    {{ round((($product->price - $product->final_price) / $product->price) * 100) }}% OFF
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Stock Info -->
                    <div class="stock-info">
                        <span class="stock-label">Stock Quantity:</span>
                        <span class="stock-value">{{ $product->stock }} units</span>
                    </div>

                    <!-- Active Status -->
                    <div class="active-status">
                        @if($product->is_active)
                            <span class="status-badge active">
                                <i class="fas fa-check-circle"></i> Active
                            </span>
                        @else
                            <span class="status-badge inactive">
                                <i class="fas fa-times-circle"></i> Inactive
                            </span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="product-actions">
                        <a href="{{ route('admin.products.edit', $product) }}" class="action-btn btn-edit" title="Edit Product">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                         <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete
                         </button>
                        </form>

                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3 class="empty-title">No Products Found</h3>
                <p class="empty-text">Start by adding your first product to your inventory.</p>
                <a href="{{ route('admin.products.create') }}" class="btn-primary-custom">
                    <i class="fas fa-plus"></i> Add Your First Product
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    @endif
</div>

<style>
    :root {
        --primary: #3b82f6;
        --primary-light: #dbeafe;
        --success: #10b981;
        --success-light: #dcfce7;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --info: #06b6d4;
        --info-light: #cffafe;
        --dark: #1f2937;
        --gray: #6b7280;
        --gray-light: #f3f4f6;
        --gray-lighter: #f9fafb;
        --border: #e5e7eb;
    }

    .products-container {
        padding: 2rem;
        background: var(--gray-lighter);
        min-height: 100vh;
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--border);
    }

    .header-content h1 {
        margin: 0;
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--dark);
    }

    .page-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .page-title i {
        color: var(--primary);
    }

    .page-subtitle {
        margin: 0;
        font-size: 0.95rem;
        color: var(--gray);
    }

    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
        cursor: pointer;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px rgba(59, 130, 246, 0.4);
        color: white;
    }

    /* Filters Section */
    .filters-section {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        font-size: 0.95rem;
        background: white;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .filter-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .filter-select {
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        background: white;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background: white;
        border-radius: 0.75rem;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-total .stat-icon {
        background: var(--primary-light);
        color: var(--primary);
    }

    .stat-active .stat-icon {
        background: var(--success-light);
        color: var(--success);
    }

    .stat-low .stat-icon {
        background: var(--warning-light);
        color: var(--warning);
    }

    .stat-featured .stat-icon {
        background: #fef3c7;
        color: #f59e0b;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin: 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0.25rem 0 0 0;
    }

    /* Products Content */
    .products-content {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* Product Card */
    .product-card {
        background: white;
        border-radius: 0.75rem;
        border: 1px solid var(--border);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    /* Product Image */
    .product-image {
        position: relative;
        width: 100%;
        height: 200px;
        background: var(--gray-lighter);
        overflow: hidden;
    }

    .img-product {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .img-product {
        transform: scale(1.05);
    }

    .img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-lighter);
        color: var(--gray);
        font-size: 2rem;
    }

    .status-overlay {
        position: absolute;
        top: 1rem;
        left: 1rem;
    }

    .stock-badge {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
    }

    .badge-featured,
    .badge-stock {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-featured {
        background: #fef3c7;
        color: #f59e0b;
    }

    .badge-stock.in-stock {
        background: var(--success-light);
        color: var(--success);
    }

    .badge-stock.low-stock {
        background: var(--warning-light);
        color: var(--warning);
    }

    .badge-stock.out-stock {
        background: var(--danger-light);
        color: var(--danger);
    }

    /* Product Details */
    .product-details {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 0.75rem 0;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-brand,
    .product-category {
        font-size: 0.85rem;
        color: var(--gray);
        margin: 0.25rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .product-brand i,
    .product-category i {
        color: var(--primary);
        width: 0.75rem;
    }

    /* Price Section */
    .price-section {
        margin: 1rem 0;
        padding: 0.75rem;
        background: var(--gray-lighter);
        border-radius: 0.5rem;
    }

    .price-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .price-current {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .price-original {
        font-size: 0.9rem;
        text-decoration: line-through;
        color: var(--gray);
    }

    .price-discount {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        background: var(--danger-light);
        color: var(--danger);
        border-radius: 0.375rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Stock Info */
    .stock-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }

    .stock-label {
        color: var(--gray);
        font-weight: 500;
    }

    .stock-value {
        color: var(--dark);
        font-weight: 700;
    }

    /* Active Status */
    .active-status {
        margin-bottom: 1rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-badge.active {
        background: var(--success-light);
        color: var(--success);
    }

    .status-badge.inactive {
        background: var(--danger-light);
        color: var(--danger);
    }

    /* Actions */
    .product-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: auto;
    }

    .action-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.65rem 0.75rem;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background: var(--primary-light);
        color: var(--primary);
    }

    .btn-edit:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: var(--danger-light);
        color: var(--danger);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 0.75rem;
        border: 1px solid var(--border);
    }

    .empty-icon {
        font-size: 3rem;
        color: var(--gray-light);
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .empty-text {
        font-size: 0.95rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        padding: 2rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .products-content {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .products-container {
            padding: 1rem;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .filters-section {
            flex-direction: column;
        }

        .search-box {
            min-width: 100%;
        }

        .filter-group {
            width: 100%;
        }

        .filter-select {
            flex: 1;
            min-width: 100%;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-label {
            font-size: 0.75rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .products-content {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .product-card {
            padding: 0;
        }

        .product-image {
            height: 150px;
        }

        .product-details {
            padding: 1rem;
        }

        .product-name {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .products-content {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .action-btn span {
            display: none;
        }

        .action-btn {
            padding: 0.65rem;
        }
    }
</style>

<script>
    function confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Category filter
    document.getElementById('categoryFilter')?.addEventListener('change', function(e) {
        filterProducts();
    });

    // Status filter
    document.getElementById('statusFilter')?.addEventListener('change', function(e) {
        filterProducts();
    });

    // Stock filter
    document.getElementById('stockFilter')?.addEventListener('change', function(e) {
        filterProducts();
    });

    function filterProducts() {
        const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const stockFilter = document.getElementById('stockFilter').value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            let show = true;

            if (categoryFilter && !card.dataset.category.toLowerCase().includes(categoryFilter)) {
                show = false;
            }

            if (statusFilter && !card.dataset.status.toLowerCase().includes(statusFilter)) {
                show = false;
            }

            if (stockFilter && card.dataset.stock !== stockFilter) {
                show = false;
            }

            card.style.display = show ? '' : 'none';
        });
    }
</script>

@endsection