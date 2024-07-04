@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.statuses') }}</h5>
        </div>
        <div class="col ms-auto text-end">
            <a status="button" class="btn btn-primary m-1"
                href="{{ avenue_route('statuses.create') }}">{{ __('common.add') }}</a>
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
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->label->name }}</td>
                    <td>{{ $status->code }}</td>
                    <td>{{ $status->sort }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action buttons">
                            <button status="button" class="btn btn-primary"
                                onclick="window.location.href='{{ avenue_route('statuses.show', ['status' => $status->id]) }}'">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button status="button" class="btn btn-secondary"
                                onclick="window.location.href='{{ avenue_route('statuses.edit', ['status' => $status->id]) }}'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $statuses->links() }}
    </div>
@endsection
