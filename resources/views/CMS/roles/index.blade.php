@extends('CMS.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.roles') }}</h5>
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('roles.create') }}">{{ __('common.add') }}</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('common.name') }}</th>
                    <th>{{ __('common.code') }}</th>
                    <th>{{ __('common.sort') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->role_id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->code }}</td>
                        <td>{{ $role->sort }}</td>
                        <td>
                            <button type="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('roles.show', ['role' => $role->role_id]) }}'">
                                {{ __('common.view') }}
                            </button>
                            <button type="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('roles.edit', ['role' => $role->role_id]) }}'">
                                {{ __('common.edit') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $roles->links() }}
        </div>
    </div>
@endsection
