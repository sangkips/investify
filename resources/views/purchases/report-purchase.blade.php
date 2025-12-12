@extends('layouts.tabler')

@section('content')
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

    .report-page {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
        padding: 1.5rem;
    }

    /* Card Styling */
    .report-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Header */
    .report-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .report-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .report-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
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
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        transform: translateY(-2px);
    }

    /* Form Body */
    .report-body {
        padding: 2rem;
    }

    .form-section-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .form-label .required {
        color: var(--danger);
    }

    .form-input {
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    .form-input.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        font-size: 0.75rem;
        color: var(--danger);
        margin-top: 6px;
    }

    /* Footer */
    .report-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-export {
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
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-export:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    .btn-cancel {
        background: white;
        color: var(--text-light);
        border: 1px solid #e2e8f0;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background: #f8fafc;
        color: var(--text-dark);
        border-color: #cbd5e1;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .report-page {
            padding: 0;
        }

        .report-card {
            border-radius: 0;
            max-width: 100%;
        }

        .report-header {
            flex-direction: column;
            text-align: center;
        }

        .report-header-content h1 {
            justify-content: center;
        }

        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .report-body {
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .report-footer {
            flex-direction: column;
            padding: 1.5rem;
        }

        .btn-export,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="report-page">
    <div class="report-card">
        <!-- Header -->
        <div class="report-header">
            <div class="report-header-content">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    {{ __('Purchase Report') }}
                </h1>
                <p>{{ __('Generate daily purchase reports') }}</p>
            </div>
            <a href="{{ route('purchases.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                {{ __('Back to Purchases') }}
            </a>
        </div>

        <form action="{{ route('purchases.getPurchaseReport') }}" method="POST">
            @csrf
            <!-- Form Body -->
            <div class="report-body">
                <div class="form-section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    {{ __('Select Date Range') }}
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="start_date">
                            {{ __('Start Date') }} <span class="required">*</span>
                        </label>
                        <input 
                            type="date" 
                            class="form-input @error('start_date') is-invalid @enderror" 
                            name="start_date" 
                            id="start_date" 
                            value="{{ old('start_date') }}"
                        >
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="end_date">
                            {{ __('End Date') }} <span class="required">*</span>
                        </label>
                        <input 
                            type="date" 
                            class="form-input @error('end_date') is-invalid @enderror" 
                            name="end_date" 
                            id="end_date" 
                            value="{{ old('end_date') }}"
                        >
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="report-footer">
                <a class="btn-cancel" href="{{ route('purchases.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    {{ __('Cancel') }}
                </a>
                <button class="btn-export" type="submit" name="export_type" value="pdf">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    {{ __('Export as PDF') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection