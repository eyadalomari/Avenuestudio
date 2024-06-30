@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.staffs') }}</h5>
        </div>
        <div class="col ms-auto text-end">
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('staffs.create') }}">{{ __('common.add') }}</a>
        </div>
    </div>

    @include('cms.success')

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('common.name') }}</th>
                <th>{{ __('common.mobile') }}</th>
                <th>{{ __('common.email') }}</th>
                <th>{{ __('common.role') }}</th>
                <th>{{ __('common.status') }}</th>
                <th>{{ __('common.created_date') }}</th>
                <th>{{ __('common.updated_date') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <li>{{ $role->role_name }}</li>
                        @endforeach
                    </td>
                    <td>{{ $user->is_active == 1 ? __('common.active') : __('common.in_active') }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action buttons">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='{{ avenue_route('staffs.show', ['staff' => $user->id]) }}'">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            @if ($user->id != 1)
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='{{ avenue_route('staffs.edit', ['staff' => $user->id]) }}'">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $users->links() }}
    </div>
@endsection
