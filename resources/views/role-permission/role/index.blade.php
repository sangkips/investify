@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if ($roles->isEmpty())
    <x-empty title="No Roles found" message="Try adjusting your search or filter to find what you're looking for." button_label="{{ __('Add Role') }}" button_route="{{ route('roles.create') }}" />
    @else
    <div class="container-xl">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <h3 class="mb-1">Success</h3>
            <p>{{ session('success') }}</p>

            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif
    @section('content') 
    <header class="page-header page-header-compact page-header-light border-bottom bg-inherit mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Role Settings
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-4">
        @include('profile.component.menu')


        <hr class="mt-0 mb-4" />


        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Roles') }}
                    </h3>
                </div>

                <div class="card-actions">
                    @can('create role')
                    <a href="{{ route('roles.create') }}" class="btn btn-success add-list mx-1 rounded">
                        Add new Role
                    </a>
                    @endcan
                </div>
            </div>
        

            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-secondary">
                        Show
                        <div class="mx-2 d-inline-block">
                            <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                        entries
                    </div>
                    <div class="ms-auto text-secondary">
                        Search:
                        <div class="ms-2 d-inline-block">
                            <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Search invoice">
                        </div>
                    </div>
                </div>
            </div>

            <x-spinner.loading-spinner />

            <div class="table-responsive">
                <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center w-1">
                                {{ __('ID') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('name')" href="#" role="button">
                                    {{ __('Name') }}

                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr>
                            <td class="align-middle text-center" style="width: 10%">
                            {{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $role->name }}
                            </td>
                            <td class="align-middle text-center" style="width: 15%">
                                <x-button.add class="btn-icon" route="{{ route('roles.add-permissions', $role) }}" />
                               
                                <x-button.edit class="btn-icon" route="{{ route('roles.edit', $role) }}" />
                            
                                <x-button.delete class="btn-icon" route="{{ route('roles.destroy', $role) }}" />
                             
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="align-middle text-center" colspan="8">
                                No results found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $roles->links() }}

        </div>
        @endif
    </div>
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush