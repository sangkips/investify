@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Edit Permission') }}

                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('permissions.index') }}" />
                </div>
            </div>

            <form action="{{ route('permissions.update', $permission) }}" method="POST">
                @csrf
                @method('put')

                <div class="card-body">
                    <x-input label="{{ __('permission Name') }}" id="name" name="name" :value="old('name', $permission->name)" required />
                </div>
                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection