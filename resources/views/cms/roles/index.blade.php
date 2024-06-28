@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.roles') }}</h5>
        </div>
        <div class="col ms-auto text-end">
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('roles.create') }}">{{ __('common.add') }}</a>
        </div>
    </div>
    @include('cms.success')

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
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->code }}</td>
                    <td>{{ $role->sort }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action buttons">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='{{ avenue_route('roles.show', ['role' => $role->id]) }}'">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{ avenue_route('roles.edit', ['role' => $role->id]) }}'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $roles->links() }}
    </div>
@endsection
