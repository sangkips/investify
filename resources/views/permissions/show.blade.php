@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        @permissions('index', ['permission' => $permission])
    </div>
</div>
@endsection