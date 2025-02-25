@extends('layouts.tabler')

@section('content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-inherit mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Store - Settings
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-4">
        @include('profile.component.menu')
        <hr class="mt-0 mb-4" />
        @include('partials.session')
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Update Store Information') }}
                            </h3>
                        </div>
                    </div>

                    <x-form action="{{ route('profile.store.settings.store') }}" method="POST">
                        <div class="card-body">
                            {{-- Store Name --}}
                            <div class="mb-3">
                                <x-input type="text" name="store_name" label="Store Name" value="{{ old('store_name', $user->store_name) }}" required class="{{ $errors->has('store_name') ? 'is-invalid' : '' }}" />
                                @error('store_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Store Phone --}}
                            <div class="mb-3">
                                <x-input type="tel" name="store_phone" label="Store Phone" value="{{ old('store_phone', $user->store_phone) }}" required class="{{ $errors->has('store_phone') ? 'is-invalid' : '' }}" />
                                @error('store_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Store Email --}}
                            <div class="mb-3">
                                <x-input type="email" name="store_email" label="Store Email" value="{{ old('store_email', $user->store_email) }}" required class="{{ $errors->has('store_email') ? 'is-invalid' : '' }}" />
                                @error('store_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Store Address --}}
                            <div class="mb-3">
                                <x-input type="text" name="store_address" label="Store Address" value="{{ old('store_address', $user->store_address) }}" required class="{{ $errors->has('store_address') ? 'is-invalid' : '' }}" />
                                @error('store_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button type="submit">{{ __('Save') }}</x-button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush
