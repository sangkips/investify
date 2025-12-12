<div>
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --success: #22c55e;
        --success-light: #dcfce7;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
    }

    /* Card Styling */
    .quotations-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .quotations-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .quotations-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quotations-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-create {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-create:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    /* Filter Bar */
    .filter-bar {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-bar .entries-select {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .filter-bar select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    .filter-bar .search-box {
        position: relative;
        flex: 1;
        max-width: 350px;
    }

    .filter-bar .search-box input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.875rem;
        background: white;
        transition: all 0.2s;
    }

    .filter-bar .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .filter-bar .search-box .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    /* Loading Spinner */
    .loading-overlay {
        padding: 3rem;
        text-align: center;
    }

    /* Table Styling */
    .quotations-table {
        width: 100%;
        border-collapse: collapse;
    }

    .quotations-table thead {
        background: #f8fafc;
    }

    .quotations-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
    }

    .quotations-table th:first-child {
        text-align: left;
    }

    .quotations-table th a {
        color: var(--text-light);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .quotations-table th a:hover {
        color: var(--primary);
    }

    .quotations-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .quotations-table tbody tr:hover {
        background: #fafbfc;
    }

    .quotations-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Quotation Link */
    .quotation-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .quotation-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Customer Name */
    .customer-name {
        font-weight: 500;
    }

    /* Amount */
    .quotation-amount {
        font-weight: 600;
        color: var(--success);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-sent {
        background: var(--success-light);
        color: var(--success);
    }

    .status-pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .status-canceled {
        background: var(--danger-light);
        color: var(--danger);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .action-btn-view {
        background: #e0e7ff;
        color: var(--primary);
    }

    .action-btn-view:hover {
        background: var(--primary);
        color: white;
    }

    .action-btn-complete {
        background: var(--success-light);
        color: var(--success);
    }

    .action-btn-complete:hover {
        background: var(--success);
        color: white;
    }

    .action-btn-delete {
        background: #fee2e2;
        color: #ef4444;
    }

    .action-btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    /* Footer */
    .quotations-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .quotations-footer .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon svg {
        width: 40px;
        height: 40px;
        color: var(--text-light);
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 0.9rem;
        margin: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quotations-header {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .quotations-header-content h1 {
            justify-content: center;
        }

        .btn-create {
            justify-content: center;
        }

        .filter-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-bar .search-box {
            max-width: 100%;
        }

        .quotations-table th,
        .quotations-table td {
            padding: 0.75rem 1rem;
        }

        .quotations-footer {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="quotations-card">
    <!-- Header -->
    <div class="quotations-header">
        <div class="quotations-header-content">
            <h1>{{ __('Quotations') }}</h1>
            <p>{{ $quotations->total() }} {{ __('total quotations') }}</p>
        </div>
        <a href="{{ route('quotations.create') }}" class="btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            {{ __('Add New Quotation') }}
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="entries-select">
            <span>{{ __('Show') }}</span>
            <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
            </select>
            <span>{{ __('entries') }}</span>
        </div>
        <x-search-input placeholder="Search by reference or customer..." />
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="loading-overlay">
        <x-spinner.loading-spinner />
    </div>

    <!-- Table -->
    <div wire:loading.remove class="table-responsive">
        @if($quotations->count() > 0)
        <table class="quotations-table">
            <thead>
                <tr>
                    <th>
                        <a wire:click.prevent="sortBy('reference')" href="#" role="button">
                            {{ __('Quotation No.') }}
                            @include('inclues._sort-icon', ['field' => 'reference'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('customer_name')" href="#" role="button">
                            {{ __('Customer') }}
                            @include('inclues._sort-icon', ['field' => 'customer_name'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('total_amount')" href="#" role="button">
                            {{ __('Total') }}
                            @include('inclues._sort-icon', ['field' => 'total_amount'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'status'])
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotations as $quotation)
                <tr>
                    <td>
                        <a href="{{ route('quotations.show', $quotation->uuid) }}" class="quotation-link">
                            {{ $quotation->reference }}
                        </a>
                    </td>
                    <td class="text-center customer-name">{{ $quotation->customer->name }}</td>
                    <td class="text-center">{{ $quotation->date->format('d M Y') }}</td>
                    <td class="text-center quotation-amount">{{ Number::currency($quotation->total_amount, 'KES') }}</td>
                    <td class="text-center">
                        @php
                            $statusClass = match($quotation->status) {
                                \App\Enums\QuotationStatus::SENT => 'status-sent',
                                \App\Enums\QuotationStatus::CANCELED => 'status-canceled',
                                default => 'status-pending',
                            };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                            {{ $quotation->status->label() }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <h3>{{ __('No quotations found') }}</h3>
            <p>{{ __('Try adjusting your search or create a new quotation.') }}</p>
        </div>
        @endif
    </div>

    <!-- Footer -->
    @if($quotations->count() > 0)
    <div class="quotations-footer">
        <p class="m-0 text-secondary">
            {{ __('Showing') }} <strong>{{ $quotations->firstItem() }}</strong> {{ __('to') }} <strong>{{ $quotations->lastItem() }}</strong> {{ __('of') }}
            <strong>{{ $quotations->total() }}</strong> {{ __('entries') }}
        </p>
        <ul class="pagination m-0">
            {{ $quotations->links() }}
        </ul>
    </div>
    @endif
</div>
</div>