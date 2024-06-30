@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h1>Admin Panel</h1>

        <h2>Roles</h2>
        <ul>
            @foreach ($roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>

        <h2>Permissions</h2>
        <ul>
            @foreach ($permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>

        <h2>Assign Role to User</h2>
        <form action="{{ avenue_route('admin.assign-role') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign Role</button>
        </form>

        <h2>Assign Permission to Role</h2>
        <form action="{{ avenue_route('admin.assign-permission') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="permission_id">Permission</label>
                <select name="permission_id" id="permission_id" class="form-control">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign Permission</button>
        </form>
    </div>
@endsection
