@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.reservations') }}</h5>
        </div>
        <div class="col ms-auto text-end">
            <a type="button" class="btn btn-primary m-1"
                href="{{ avenue_route('reservations.create') }}">{{ __('common.add') }}</a>
        </div>
    </div>
    <form method="GET" id="filters-form" action="{{ avenue_route('reservations.index') }}">
        <div class="row">
            <div class="col-3 mt-3">
                <span>{{ __('common.keyword') }}</span>
                <input type="text" class="form-control" name="keyword" id="keyword" value="{{ request('keyword') }}"
                    placeholder="{{ __('common.keyword') }}">
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.type') }}</span>
                <select class="form-control" id="type_id" name="type_id">
                    <option value="">--{{ __('common.select') }}--</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type_id }}" {{ request('type_id') == $type->type_id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.status') }}</span>
                <select class="form-control" id="status_id" name="status_id">
                    <option value="">--{{ __('common.select') }}--</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->status_id }}"
                            {{ request('status_id') == $status->status_id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.photographer') }}</span>
                <select class="form-control" id="photographer" name="photographer">
                    <option value="">--{{ __('common.select') }}--</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->user_id }}"
                            {{ request('photographer') == $user->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.from_date') }}</span>
                <input type="date" class="form-control" name="from_date" id="from_date"
                    value="{{ request('from_date') }}">
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.to_date') }}</span>
                <input type="date" class="form-control" name="to_date" id="to_date" value="{{ request('to_date') }}">
            </div>
            <div class="col-3 d-flex align-items-end mt-3">
                <button class="btn btn-primary me-3" type="submit" id="search_btn">{{ __('common.search') }}</button>
                <button class="btn btn-secondary" type="button" id="clear_btn">{{ __('common.clear') }}</button>
            </div>
        </div>
    </form>

    @include('cms.success')

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('common.name') }}</th>
                <th>{{ __('common.mobile') }}</th>
                <th>{{ __('common.type') }}</th>
                <th>{{ __('common.price') }}</th>
                <th>{{ __('common.status') }}</th>
                <th>{{ __('common.has_video') }}</th>
                <th>{{ __('common.date') }}</th>
                <th>{{ __('common.time') }}</th>
                <th>{{ __('common.photographer') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                @php
                    $statusClasses = [
                        'active' => 'table-primary',
                        'completed' => 'table-success',
                        'canceled' => 'table-dark',
                        'deleted' => 'table-danger',
                    ];
                    $statusClass = $statusClasses[$reservation->status->code] ?? '';
                    
                    
                    $statusText = [
                        'active' => 'text-primary',
                        'completed' => 'text-success',
                        'canceled' => 'table-info',
                        'deleted' => 'text-danger',
                    ];
                    $statusText = $statusText[$reservation->status->code] ?? '';
                @endphp

                <tr>
                    <td class="{{ $statusClass }}">{{ $reservation->reservation_id }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->mobile }}</td>
                    <td>{{ !empty($reservation->type_name) ? $reservation->type_name : 'N/A' }}
                        ({{ __('common.' . $reservation->location_type) }})
                    </td>
                    <td>{{ currencyFormatter($reservation->price) }}</td>
                    <td>
                        <p class="fw-bolder {{ $statusText }}">
                            {{ !empty($reservation->status_name) ? $reservation->status_name : 'N/A' }}</p>
                    </td>
                    <td>{{ $reservation->has_video ? __('common.yes') : __('common.no') }}</td>
                    <td>
                        <div class="row">{{ dateFormatter($reservation->date) }}</div>
                    </td>
                    <td>
                        <div class="row">{{ timeFormatter($reservation->start) }}</div>
                        <div class="row">{{ timeFormatter($reservation->end) }}</div>
                    </td>
                    <td>{{ !empty($reservation->thePhotographer) ? $reservation->thePhotographer->name : 'N/A' }}</td>
                    <td class="row">
                        <button type="button" class="btn btn-primary m-1"
                            onclick="window.location.href='{{ avenue_route('reservations.show', ['reservation' => $reservation->reservation_id]) }}'">
                            {{ __('common.view') }}
                        </button>
                        <button type="button" class="btn btn-primary m-1"
                            onclick="window.location.href='{{ avenue_route('reservations.edit', ['reservation' => $reservation->reservation_id]) }}'">
                            {{ __('common.edit') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $reservations->appends(request()->query())->links() }}
    </div>
    <script>
        document.getElementById('clear_btn').addEventListener('click', function() {
            document.getElementById('keyword').value = '';
            document.getElementById('status_id').value = '';
            document.getElementById('type_id').value = '';
            document.getElementById('photographer').value = '';
            document.getElementById('from_date').value = '';
            document.getElementById('to_date').value = '';
            document.getElementById('filters-form').submit();
        });
    </script>
@endsection
