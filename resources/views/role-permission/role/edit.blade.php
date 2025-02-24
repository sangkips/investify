@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Edit Role') }}

                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('roles.index') }}" />
                </div>
            </div>

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method("PUT")

                <div class="card-body">
                    <x-input label="{{ __('role Name') }}" id="name" name="name" :value="old('name', $role->name)" required />
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