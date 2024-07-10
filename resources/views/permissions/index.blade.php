@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if (!$permissions)
    <x-empty title="No Permissions found" message="Try adjusting your search or filter to find what you're looking for." button_label="{{ __('Add Permissions') }}" button_route="{{ route('permissions.create') }}" />
    @else
    <div class="container-xl">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <h3 class="mb-1">Success</h3>
            <p>{{ session('success') }}</p>

            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Permissions') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.create route="{{ route('permissions.create') }}" />
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
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('id')" href="#" role="button">
                                    {{ __('Id') }}

                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('name')" href="#" role="button">
                                    {{ __('Name') }}

                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('created_at')" href="#" role="button">
                                    {{ __('Created at') }}

                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $permission->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $permission->created_at->diffForHumans() }}
                            </td>
                            <td class="align-middle text-center">
                                {{--<x-button.show class="btn-icon" route="{{ route('permissions.show', $permission) }}" />--}}
                                <x-button.edit class="btn-icon" route="{{ route('permissions.edit', $permission) }}" />
                                <x-button.delete class="btn-icon" route="{{ route('permissions.destroy', $permission) }}" onclick="return confirm('Are you sure to remove {{ $permission->name }} ?')" />
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
            {{--
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $permissions->firstItem() }}</span> to <span>{{ $permissions->lastItem() }}</span> of <span>{{ $permissions->total() }}</span> entries
            </p>

            <ul class="pagination m-0 ms-auto">
                {{ $permissions->links() }}
            </ul>
        </div>
        --}}
    </div>
</div>
@endif
</div>
@endsection