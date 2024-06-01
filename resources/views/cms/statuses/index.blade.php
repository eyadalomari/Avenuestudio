@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.statuses') }}</h5>
            <a status="button" class="btn btn-primary m-1" href="{{ avenue_route('statuses.create') }}">{{ __('common.add') }}</a>
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
                @foreach ($statuses as $status)
                    <tr>
                        <td>{{ $status->status_id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->status->code }}</td>
                        <td>{{ $status->status->sort }}</td>
                        <td>
                            <button status="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('statuses.show', ['status' => $status->status_id]) }}'">
                                {{ __('common.view') }}
                            </button>
                            <button status="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('statuses.edit', ['status' => $status->status_id]) }}'">
                                {{ __('common.edit') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $statuses->links() }}
        </div>
    </div>
@endsection
