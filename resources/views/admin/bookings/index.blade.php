@extends('admin.layouts.app')

@section('title', 'Admin - Bookings')

@section('content')

<div class="bookings-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-calendar-check"></i> Bookings Management
            </h1>
            <p class="page-subtitle">Manage and track all customer bookings</p>
        </div>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus"></i> New Booking
        </a>
    </div>

    <!-- Filters & Search Section -->
    <div class="filters-bar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search by customer name, email, or phone..." class="search-input">
        </div>
        <div class="filter-group">
            <select id="statusFilter" class="filter-select">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-item stat-total">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <p class="stat-label">Total Bookings</p>
                <h3 class="stat-value">{{ $bookings->count() }}</h3>
            </div>
        </div>
        <div class="stat-item stat-pending">
            <div class="stat-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-info">
                <p class="stat-label">Pending</p>
                <h3 class="stat-value">{{ $bookings->where('status', 'pending')->count() }}</h3>
            </div>
        </div>
        <div class="stat-item stat-completed">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <p class="stat-label">Completed</p>
                <h3 class="stat-value">{{ $bookings->where('status', 'completed')->count() }}</h3>
            </div>
        </div>
        <div class="stat-item stat-cancelled">
            <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-info">
                <p class="stat-label">Cancelled</p>
                <h3 class="stat-value">{{ $bookings->where('status', 'cancelled')->count() }}</h3>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card">
        @forelse($bookings as $index => $booking)
            <div class="booking-item">
                <!-- Left Section: Customer Info -->
                <div class="booking-left">
                    <div class="customer-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="customer-info">
                        <h4 class="customer-name">{{ $booking->customer_name ?? 'N/A' }}</h4>
                        <p class="customer-detail">
                            <i class="fas fa-envelope"></i> {{ $booking->customer_email ?? 'N/A' }}
                        </p>
                        <p class="customer-detail">
                            <i class="fas fa-phone"></i> {{ $booking->customer_phone ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Center Section: Booking Details -->
                <div class="booking-center">
                    <div class="detail-item">
                        <span class="detail-label">Service</span>
                        <span class="detail-value service-badge">
                            {{ $booking->service->name ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="status-badge status-{{ $booking->status }}">
                            @switch($booking->status)
                                @case('pending')
                                    <i class="fas fa-hourglass-half"></i> Pending
                                    @break
                                @case('confirmed')
                                    <i class="fas fa-check"></i> Confirmed
                                    @break
                                @case('in_progress')
                                    <i class="fas fa-spinner"></i> In Progress
                                    @break
                                @case('completed')
                                    <i class="fas fa-check-circle"></i> Completed
                                    @break
                                @case('cancelled')
                                    <i class="fas fa-times-circle"></i> Cancelled
                                    @break
                            @endswitch
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Booked On</span>
                        <span class="detail-value">{{ $booking->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <!-- Right Section: Actions -->
                <div class="booking-actions">
                    <a href="{{ route('admin.bookings.show', $booking->id) }}" 
                       class="action-btn btn-view" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                       class="action-btn btn-edit" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" 
                          method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete" 
                                title="Delete" onclick="return confirmDelete(event)">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="empty-title">No Bookings Found</h3>
                <p class="empty-text">Start by creating your first booking or check back later for new bookings.</p>
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus"></i> Create New Booking
                </a>
            </div>
        @endforelse
    </div>
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
        --border: #e5e7eb;
    }

    .bookings-container {
        padding: 2rem;
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Header Section */
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
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px rgba(59, 130, 246, 0.4);
        color: white;
    }

    /* Filters & Search */
    .filters-bar {
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
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .filter-group {
        display: flex;
        gap: 1rem;
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

    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background: white;
        border-radius: 0.75rem;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 2.5rem;
        height: 2.5rem;
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

    .stat-pending .stat-icon {
        background: var(--warning-light);
        color: var(--warning);
    }

    .stat-completed .stat-icon {
        background: var(--success-light);
        color: var(--success);
    }

    .stat-cancelled .stat-icon {
        background: var(--danger-light);
        color: var(--danger);
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

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 0.75rem;
        border: 1px solid var(--border);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Booking Item */
    .booking-item {
        display: grid;
        grid-template-columns: 1fr 2fr 0.5fr;
        align-items: center;
        gap: 2rem;
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-light);
        transition: all 0.3s ease;
    }

    .booking-item:hover {
        background: var(--gray-light);
    }

    .booking-item:last-child {
        border-bottom: none;
    }

    .booking-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .customer-avatar {
        width: 3rem;
        height: 3rem;
        border-radius: 0.5rem;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .customer-info h4 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .customer-detail {
        margin: 0.25rem 0 0 0;
        font-size: 0.85rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customer-detail i {
        width: 1rem;
        text-align: center;
        color: var(--primary);
    }

    .booking-center {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .detail-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--dark);
    }

    .service-badge {
        display: inline-block;
        padding: 0.5rem 0.75rem;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 0.375rem;
        font-weight: 600;
        width: fit-content;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-weight: 600;
        font-size: 0.9rem;
        width: fit-content;
    }

    .status-pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .status-confirmed {
        background: var(--info-light);
        color: var(--info);
    }

    .status-in_progress {
        background: var(--primary-light);
        color: var(--primary);
    }

    .status-completed {
        background: var(--success-light);
        color: var(--success);
    }

    .status-cancelled {
        background: var(--danger-light);
        color: var(--danger);
    }

    .booking-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .action-btn {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        border: 1px solid var(--border);
        background: white;
        color: var(--gray);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 1rem;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-view:hover {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-edit:hover {
        background: var(--warning-light);
        color: var(--warning);
        border-color: var(--warning);
    }

    .btn-delete:hover {
        background: var(--danger-light);
        color: var(--danger);
        border-color: var(--danger);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--gray);
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
        margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .booking-item {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .booking-center {
            grid-template-columns: repeat(2, 1fr);
        }

        .booking-actions {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {
        .bookings-container {
            padding: 1rem;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .filters-bar {
            flex-direction: column;
        }

        .search-box {
            min-width: 100%;
        }

        .filter-group {
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }

        .stats-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }

        .booking-item {
            padding: 1rem;
        }

        .booking-left {
            gap: 0.75rem;
        }

        .customer-avatar {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 1rem;
        }

        .booking-center {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .booking-actions {
            width: 100%;
        }
    }
</style>

<script>
    function confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this booking? This action cannot be undone.')) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.booking-item');
        
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Status filter functionality
    document.getElementById('statusFilter')?.addEventListener('change', function(e) {
        const statusFilter = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.booking-item');
        
        items.forEach(item => {
            if (!statusFilter) {
                item.style.display = '';
            } else {
                const statusText = item.querySelector('.status-badge')?.textContent.toLowerCase() || '';
                item.style.display = statusText.includes(statusFilter) ? '' : 'none';
            }
        });
    });
</script>

@endsection