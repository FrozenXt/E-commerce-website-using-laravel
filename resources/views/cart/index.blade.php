@extends('layouts.app')

@section('title', 'Shopping Cart - Smart Techno Hub')

@push('styles')
<style>
    .cart-page {
        padding: 60px 0;
        background: var(--light);
        min-height: calc(100vh - 200px);
    }

    .cart-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .cart-items-section {
        background: var(--white);
        border-radius: var(--radius);
        padding: 30px;
        box-shadow: var(--shadow);
    }

    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--gray-light);
    }

    .cart-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark);
    }

    .cart-count {
        background: var(--primary);
        color: var(--white);
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 700;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 120px 1fr auto;
        gap: 20px;
        padding: 25px;
        border: 2px solid var(--gray-light);
        border-radius: 12px;
        margin-bottom: 20px;
        transition: var(--transition);
        position: relative;
    }

    .cart-item:hover {
        border-color: var(--primary);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .item-image {
        width: 120px;
        height: 120px;
        background: var(--light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .item-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .item-name a {
        color: var(--dark);
        text-decoration: none;
        transition: var(--transition);
    }

    .item-name a:hover {
        color: var(--primary);
    }

    .item-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .qty-btn {
        width: 35px;
        height: 35px;
        border: 2px solid var(--gray-light);
        background: var(--white);
        border-radius: 6px;
        cursor: pointer;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--light);
    }

    .qty-input {
        width: 60px;
        height: 35px;
        text-align: center;
        border: 2px solid var(--gray-light);
        border-radius: 6px;
        font-weight: 700;
        font-size: 1rem;
    }

    .item-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }

    .item-total {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--dark);
    }

    .btn-remove {
        background: transparent;
        border: none;
        color: var(--danger);
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
        padding: 8px 12px;
        border-radius: 6px;
    }

    .btn-remove:hover {
        background: var(--danger);
        color: var(--white);
    }

    .empty-cart {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-cart i {
        font-size: 5rem;
        color: var(--gray-light);
        margin-bottom: 20px;
    }

    .empty-cart h2 {
        font-size: 1.8rem;
        color: var(--dark);
        margin-bottom: 15px;
    }

    .empty-cart p {
        color: var(--gray);
        margin-bottom: 30px;
    }

    /* Cart Summary */
    .cart-summary {
        background: var(--white);
        border-radius: var(--radius);
        padding: 30px;
        box-shadow: var(--shadow);
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .summary-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--gray-light);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        font-size: 1rem;
        color: var(--gray);
    }

    .summary-row.total {
        border-top: 2px solid var(--gray-light);
        margin-top: 15px;
        padding-top: 20px;
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--dark);
    }

    .summary-value {
        font-weight: 700;
        color: var(--dark);
    }

    .shipping-info {
        background: var(--light);
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
        font-size: 0.9rem;
        color: var(--gray);
    }

    .shipping-info i {
        color: var(--success);
        margin-right: 8px;
    }

    .btn-checkout {
        width: 100%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--white);
        padding: 18px;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 20px;
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
    }

    .btn-continue {
        width: 100%;
        background: var(--white);
        color: var(--primary);
        padding: 15px;
        border: 2px solid var(--primary);
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 15px;
        transition: var(--transition);
    }

    .btn-continue:hover {
        background: var(--primary);
        color: var(--white);
    }

    .security-badges {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-light);
    }

    .security-badge {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.85rem;
        color: var(--gray);
    }

    .security-badge i {
        color: var(--success);
    }

    @media (max-width: 1024px) {
        .cart-container {
            grid-template-columns: 1fr;
        }

        .cart-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .cart-item {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .item-actions {
            align-items: center;
        }

        .cart-header h1 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="cart-page">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(empty($cartItems))
        <!-- Empty Cart -->
        <div class="cart-items-section">
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Your Cart is Empty</h2>
                <p>Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="btn-add-cart" style="display: inline-block; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        </div>
        @else
        <div class="cart-container">
            <!-- Cart Items -->
            <div class="cart-items-section">
                <div class="cart-header">
                    <h1>Shopping Cart</h1>
                    <span class="cart-count">{{ count($cartItems) }} Items</span>
                </div>

                @foreach($cartItems as $id => $item)
                <div class="cart-item" data-id="{{ $id }}">
                    <div class="item-image">
                        @if($item['product']->image)
                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}">
                        @else
                        <i class="fas fa-mobile-alt" style="font-size: 3rem; color: var(--gray);"></i>
                        @endif
                    </div>

                    <div class="item-details">
                        <div>
                            <h3 class="item-name">
                                <a href="{{ route('products.show', $item['product']->slug) }}">
                                    {{ $item['product']->name }}
                                </a>
                            </h3>
                            <div class="item-price">Rs {{ number_format($item['price'], 2) }}</div>
                        </div>

                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="updateQuantity({{ $id }}, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="qty-input" value="{{ $item['quantity'] }}" 
                                   min="1" max="{{ $item['product']->stock }}" readonly>
                            <button class="qty-btn" onclick="updateQuantity({{ $id }}, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="item-actions">
                        <div class="item-total" data-price="{{ $item['price'] }}">
                            Rs {{ number_format($item['total'], 2) }}
                        </div>
                        <button class="btn-remove" onclick="removeItem({{ $id }})">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="summary-value" id="subtotal">Rs {{ number_format($subtotal, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span class="summary-value">Rs {{ number_format($shipping, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Tax (GST 18%)</span>
                    <span class="summary-value" id="tax">Rs {{ number_format($tax, 2) }}</span>
                </div>

                @if($shipping == 0)
                <div class="shipping-info">
                    <i class="fas fa-shipping-fast"></i>
                    <strong>Free Shipping Applied!</strong>
                </div>
                @else
                <div class="shipping-info">
                    <i class="fas fa-info-circle"></i>
                    Add Rs {{ number_format(5000 - $subtotal, 2) }} more for free shipping
                </div>
                @endif

                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">Rs {{ number_format($total, 2) }}</span>
                </div>

                <button class="btn-checkout" onclick="alert('Checkout feature coming soon!')">
                    <i class="fas fa-lock me-2"></i> Proceed to Checkout
                </button>

                <a href="{{ route('products.index') }}" class="btn-continue">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>

                <div class="security-badges">
                    <div class="security-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure</span>
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-lock"></i>
                        <span>Encrypted</span>
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Verified</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateQuantity(productId, delta) {
        const cartItem = document.querySelector(`.cart-item[data-id="${productId}"]`);
        const qtyInput = cartItem.querySelector('.qty-input');
        const currentQty = parseInt(qtyInput.value);
        const newQty = Math.max(1, currentQty + delta);
        
        if (newQty > parseInt(qtyInput.max)) {
            alert('Maximum stock reached!');
            return;
        }
        
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ quantity: newQty })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                qtyInput.value = newQty;
                const itemTotal = cartItem.querySelector('.item-total');
                itemTotal.textContent = `Rs ${data.item_total.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
                updateCartSummary();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeItem(productId) {
        if (!confirm('Are you sure you want to remove this item?')) return;
        
        fetch(`/cart/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`.cart-item[data-id="${productId}"]`).remove();
                
                if (data.cart_count === 0) {
                    location.reload();
                } else {
                    updateCartSummary();
                    document.querySelector('.cart-count').textContent = `${data.cart_count} Items`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateCartSummary() {
        let subtotal = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.querySelector('.item-total').dataset.price);
            const qty = parseInt(item.querySelector('.qty-input').value);
            const total = parseFloat(item.querySelector('.item-total').textContent.replace('Rs ', '').replace(/,/g, ''));
            subtotal += total;
        });
        
        const shipping = subtotal > 5000 ? 0 : 150;
        const tax = subtotal * 0.18;
        const total = subtotal + shipping + tax;
        
        document.getElementById('subtotal').textContent = `Rs ${subtotal.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
        document.getElementById('tax').textContent = `Rs ${tax.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
        document.getElementById('total').textContent = `Rs ${total.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
    }
</script>
@endpush