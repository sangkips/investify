@extends('layouts.tabler')

@section('content')
<style>
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --success: #22c55e;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
    }

    .quotation-edit-page {
        min-height: 100vh;
        padding: 1.5rem;
    }

    .quotation-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .quotation-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .quotation-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quotation-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .header-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        background: var(--warning);
        color: white;
    }

    .info-section {
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-dark);
        padding: 10px 14px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 768px) {
        .quotation-edit-page {
            padding: 0;
        }

        .quotation-card {
            border-radius: 0;
        }

        .quotation-header {
            flex-direction: column;
            text-align: center;
        }

        .header-actions {
            flex-direction: column;
            width: 100%;
        }

        .btn-back {
            justify-content: center;
        }

        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-section {
            padding: 1rem;
        }
    }
</style>

<div class="quotation-edit-page">
    <div class="quotation-card">
        <!-- Header -->
        <div class="quotation-header">
            <div class="quotation-header-content">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    {{ __('Edit Quotation') }} #{{ $quotation->reference }}
                </h1>
                <p>{{ __('Modify products, quantities, and details') }}</p>
            </div>
            <div class="header-actions">
                <span class="header-status">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                    {{ __('Pending') }}
                </span>
                <a href="{{ route('quotations.show', $quotation->uuid) }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>

        <!-- Quotation Info Section -->
        <div class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">{{ __('Customer') }}</span>
                    <div class="info-value">{{ $quotation->customer_name }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Reference') }}</span>
                    <div class="info-value">{{ $quotation->reference }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Date') }}</span>
                    <div class="info-value">{{ $quotation->date->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Created By') }}</span>
                    <div class="info-value">{{ $quotation->user->name }}</div>
                </div>
            </div>
        </div>

        <!-- Editable Products Section -->
        @livewire('edit-quotation-form', ['quotation' => $quotation])
    </div>
</div>
@endsection
