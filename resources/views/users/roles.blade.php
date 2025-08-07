@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Management
                </div>
                <h2 class="page-title">
                    User Roles
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users and Their Roles</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Current Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roles->count() > 0)
                                        <span class="badge bg-primary">{{ $user->roles->first()->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">No Role</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            Assign Role
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach($roles as $role)
                                            <li>
                                                <form action="{{ route('users.assign-role', $user) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="role" value="{{ $role->name }}">
                                                    <button type="submit" class="dropdown-item">{{ ucfirst($role->name) }}</button>
                                                </form>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if($user->roles->count() > 0)
                                    <form action="{{ route('users.remove-role', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            Remove Role
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Role Descriptions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Admin</h4>
                        <p>Full access to all features including user management.</p>
                        
                        <h4>Manager</h4>
                        <p>Can manage products, orders, purchases, quotations, customers, suppliers, and view reports.</p>
                        
                        <h4>Sales</h4>
                        <p>Can manage orders, quotations, and customers. Has access to dashboard.</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Inventory</h4>
                        <p>Can manage products, purchases, suppliers, categories, and units. Has access to dashboard.</p>
                        
                        <h4>Viewer</h4>
                        <p>Read-only access to dashboard and reports.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection