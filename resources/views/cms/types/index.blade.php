@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.types') }}</h5>
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('types.create') }}">{{ __('common.add') }}</a>
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
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->type_id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->type->code }}</td>
                        <td>{{ $type->type->sort }}</td>
                        <td>
                            <button type="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('types.show', ['type' => $type->type_id]) }}'">
                                {{ __('common.view') }}
                            </button>
                            <button type="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('types.edit', ['type' => $type->type_id]) }}'">
                                {{ __('common.edit') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $types->links() }}
        </div>
    </div>
@endsection
