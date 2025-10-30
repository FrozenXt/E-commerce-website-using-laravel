@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="dashboard-subtitle">Welcome back! Here's what's happening with your business today.</p>
        </div>
        <div class="header-actions">
            <div class="date-display">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <!-- Total Products -->
        <a href="{{ route('admin.products.index') }}" class="stat-card stat-card-primary">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Total Products</p>
                    <h3 class="stat-number">{{ $stats['total_products'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator positive">+5%</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- Total Services -->
        <a href="{{ route('admin.services.index') }}" class="stat-card stat-card-success">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Total Services</p>
                    <h3 class="stat-number">{{ $stats['total_services'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator positive">+12%</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- Total Bookings -->
        <a href="{{ route('admin.bookings.index') }}" class="stat-card stat-card-info">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Total Bookings</p>
                    <h3 class="stat-number">{{ $stats['total_bookings'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator positive">+8%</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- Pending Bookings -->
        <a href="{{ route('admin.bookings.index') }}" class="stat-card stat-card-warning">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Pending Bookings</p>
                    <h3 class="stat-number">{{ $stats['pending_bookings'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator negative">+3</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- Total Categories -->
        <a href="{{ route('admin.categories.index') }}" class="stat-card stat-card-secondary">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Categories</p>
                    <h3 class="stat-number">{{ $stats['total_categories'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator neutral">0%</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- Contact Messages -->
        <a href="{{ route('admin.contacts.index') }}" class="stat-card stat-card-purple">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Messages</p>
                    <h3 class="stat-number">{{ $stats['total_contacts'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator positive">+15%</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- New Contacts -->
        <a href="{{ route('admin.contacts.index') }}" class="stat-card stat-card-danger">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">New Messages</p>
                    <h3 class="stat-number">{{ $stats['new_contacts'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator positive">+2</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>

        <!-- Low Stock Products -->
        <a href="{{ route('admin.products.index') }}" class="stat-card stat-card-alert">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Low Stock</p>
                    <h3 class="stat-number">{{ $stats['low_stock_products'] }}</h3>
                </div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator negative">+3</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Recent Bookings Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-title-section">
                    <h2 class="card-title">Recent Bookings</h2>
                    <p class="card-subtitle">Latest service bookings</p>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="btn-link">
                    View All
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-content">
                <div class="table-wrapper">
                    @forelse($recentBookings as $booking)
                        <div class="table-row">
                            <div class="row-content">
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ substr($booking->customer_name, 0, 1) }}
                                    </div>
                                    <div class="customer-details">
                                        <strong>{{ $booking->customer_name }}</strong>
                                        <span class="customer-contact">{{ $booking->customer_phone }}</span>
                                    </div>
                                </div>
                                <div class="booking-details">
                                    <span class="service-name">{{ $booking->service->name }}</span>
                                    <span class="booking-date">{{ $booking->booking_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="row-status">
                                @if($booking->status == 'pending')
                                    <span class="status-badge status-pending">Pending</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="status-badge status-confirmed">Confirmed</span>
                                @elseif($booking->status == 'in_progress')
                                    <span class="status-badge status-progress">In Progress</span>
                                @elseif($booking->status == 'completed')
                                    <span class="status-badge status-completed">Completed</span>
                                @else
                                    <span class="status-badge status-cancelled">Cancelled</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h3>No bookings yet</h3>
                            <p>When customers book services, they'll appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Messages Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-title-section">
                    <h2 class="card-title">Recent Messages</h2>
                    <p class="card-subtitle">Contact form submissions</p>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="btn-link">
                    View All
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-content">
                <div class="table-wrapper">
                    @forelse($recentContacts as $contact)
                        <div class="table-row">
                            <div class="row-content">
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ substr($contact->name, 0, 1) }}
                                    </div>
                                    <div class="customer-details">
                                        <strong>{{ $contact->name }}</strong>
                                        <span class="customer-contact">{{ $contact->email }}</span>
                                    </div>
                                </div>
                                <div class="message-details">
                                    <span class="message-subject">{{ Str::limit($contact->subject, 40) }}</span>
                                    <span class="message-date">{{ $contact->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="row-status">
                                @if($contact->status == 'new')
                                    <span class="status-badge status-new">New</span>
                                @elseif($contact->status == 'read')
                                    <span class="status-badge status-read">Read</span>
                                @else
                                    <span class="status-badge status-replied">Replied</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h3>No messages yet</h3>
                            <p>When customers contact you, messages will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --primary: #4361ee;
        --primary-light: #eef2ff;
        --success: #10b981;
        --success-light: #ecfdf5;
        --warning: #f59e0b;
        --warning-light: #fffbeb;
        --danger: #ef4444;
        --danger-light: #fef2f2;
        --info: #06b6d4;
        --info-light: #f0f9ff;
        --secondary: #8b5cf6;
        --secondary-light: #f5f3ff;
        --purple: #8b5cf6;
        --purple-light: #f5f3ff;
        --dark: #1e293b;
        --dark-light: #334155;
        --gray: #64748b;
        --gray-light: #f1f5f9;
        --gray-lighter: #f8fafc;
        --white: #ffffff;
        --border: #e2e8f0;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --radius: 8px;
        --radius-lg: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Global Styles */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: var(--gray-lighter);
        color: var(--dark);
        line-height: 1.5;
    }

    .dashboard-wrapper {
        padding: 24px;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 32px;
        animation: fadeIn 0.5s ease-out;
    }

    .header-content {
        flex: 1;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 8px 0;
        line-height: 1.2;
    }

    .dashboard-subtitle {
        font-size: 16px;
        color: var(--gray);
        margin: 0;
        max-width: 500px;
    }

    .date-display {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        background: var(--white);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        font-size: 14px;
        font-weight: 500;
        color: var(--dark);
        box-shadow: var(--shadow);
    }

    .date-display i {
        color: var(--primary);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
        animation: slideUp 0.5s ease-out;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        transition: var(--transition);
    }

    .stat-card-primary::before { background: var(--primary); }
    .stat-card-success::before { background: var(--success); }
    .stat-card-info::before { background: var(--info); }
    .stat-card-warning::before { background: var(--warning); }
    .stat-card-secondary::before { background: var(--secondary); }
    .stat-card-purple::before { background: var(--purple); }
    .stat-card-danger::before { background: var(--danger); }
    .stat-card-alert::before { background: var(--danger); }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .stat-card:hover::before {
        width: 6px;
    }

    .stat-content {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: var(--transition);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }

    .stat-card-primary .stat-icon { background: var(--primary-light); color: var(--primary); }
    .stat-card-success .stat-icon { background: var(--success-light); color: var(--success); }
    .stat-card-info .stat-icon { background: var(--info-light); color: var(--info); }
    .stat-card-warning .stat-icon { background: var(--warning-light); color: var(--warning); }
    .stat-card-secondary .stat-icon { background: var(--secondary-light); color: var(--secondary); }
    .stat-card-purple .stat-icon { background: var(--purple-light); color: var(--purple); }
    .stat-card-danger .stat-icon { background: var(--danger-light); color: var(--danger); }
    .stat-card-alert .stat-icon { background: var(--danger-light); color: var(--danger); }

    .stat-label {
        font-size: 14px;
        color: var(--gray);
        margin: 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
        margin: 4px 0 0 0;
        line-height: 1;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .trend-indicator {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 20px;
    }

    .trend-indicator.positive {
        background: var(--success-light);
        color: var(--success);
    }

    .trend-indicator.negative {
        background: var(--danger-light);
        color: var(--danger);
    }

    .trend-indicator.neutral {
        background: var(--gray-light);
        color: var(--gray);
    }

    .stat-trend i {
        color: var(--gray);
        transition: var(--transition);
    }

    .stat-card:hover .stat-trend i {
        color: var(--primary);
        transform: translateX(4px);
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 24px;
    }

    /* Dashboard Card */
    .dashboard-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: fadeIn 0.6s ease-out;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px;
        border-bottom: 1px solid var(--border);
    }

    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .card-subtitle {
        font-size: 14px;
        color: var(--gray);
        margin: 4px 0 0 0;
    }

    .btn-link {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition);
    }

    .btn-link:hover {
        gap: 12px;
        color: var(--dark);
    }

    .card-content {
        padding: 0;
    }

    /* Table Wrapper */
    .table-wrapper {
        max-height: 400px;
        overflow-y: auto;
    }

    .table-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
        animation: slideIn 0.4s ease-out;
    }

    .table-row:hover {
        background: var(--gray-lighter);
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .row-content {
        display: flex;
        flex-direction: column;
        flex: 1;
        gap: 8px;
    }

    .customer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .customer-details {
        display: flex;
        flex-direction: column;
    }

    .customer-details strong {
        color: var(--dark);
        font-weight: 600;
        font-size: 15px;
    }

    .customer-contact {
        font-size: 13px;
        color: var(--gray);
    }

    .booking-details, .message-details {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
    }

    .service-name, .message-subject {
        color: var(--dark);
        font-weight: 500;
    }

    .booking-date, .message-date {
        color: var(--gray);
    }

    .row-status {
        margin-left: 16px;
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .status-confirmed {
        background: var(--info-light);
        color: var(--info);
    }

    .status-progress {
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

    .status-new {
        background: var(--success-light);
        color: var(--success);
    }

    .status-read {
        background: var(--info-light);
        color: var(--info);
    }

    .status-replied {
        background: var(--secondary-light);
        color: var(--secondary);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: var(--gray);
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 8px 0;
        color: var(--dark);
    }

    .empty-state p {
        margin: 0;
        font-size: 14px;
        max-width: 300px;
        margin: 0 auto;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from { 
            opacity: 0;
            transform: translateX(-10px);
        }
        to { 
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            padding: 16px;
        }

        .dashboard-header {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .table-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .row-status {
            margin-left: 0;
            width: 100%;
        }
    }

    /* Scrollbar Styling */
    .table-wrapper::-webkit-scrollbar {
        width: 6px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: var(--gray-light);
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: var(--gray);
        border-radius: 3px;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: var(--dark-light);
    }
</style>
@endpush

@endsection