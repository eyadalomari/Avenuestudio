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
                        <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->label->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.status') }}</span>
                <select class="form-control" id="status_id" name="status_id">
                    <option value="">--{{ __('common.select') }}--</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}"
                            {{ request('status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->label->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 mt-3">
                <span>{{ __('common.photographer') }}</span>
                <select class="form-control" id="photographer" name="photographer">
                    <option value="">--{{ __('common.select') }}--</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ request('photographer') == $user->id ? 'selected' : '' }}>
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
                <th>{{ __('common.photographer') }}</th>
                <th>{{ __('common.type') }}</th>
                <th>{{ __('common.price') }}</th>
                <th>{{ __('common.status') }}</th>
                <th>{{ __('common.date_time') }}</th>
                <th>{{ __('common.time') }}</th>
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

                    $statusTextClasses = [
                        'active' => 'text-primary',
                        'completed' => 'text-success',
                        'canceled' => 'table-info',
                        'deleted' => 'text-danger',
                    ];
                    $statusTextClass = $statusTextClasses[$reservation->status->code] ?? '';
                @endphp

                <tr>
                    <td class="{{ $statusClass }}">{{ $reservation->id }}</td>
                    <td>
                        <div>{{ $reservation->name }}</div>
                        <div>{{ $reservation->mobile }}</div>
                    </td>
                    <td>
                        @if (!empty($reservation->thePhotographer))
                            <div>{{ $reservation->thePhotographer->name }}</div>
                            <div>{{ $reservation->thePhotographer->mobile }}</div>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <div>{{ $reservation->type->label->name }} ({{ __('common.' . $reservation->location_type) }})</div>
                    </td>
                    <td>{{ currencyFormatter($reservation->price) }}</td>
                    <td>
                        <p class="fw-bolder {{ $statusTextClass }}">
                            {{ $reservation->status->label->name }}
                        </p>
                    </td>
                    <td>
                        <div>{{ dateFormatter($reservation->date) }}</div>
                        <div>{{ timeFormatter($reservation->start) }} - {{ timeFormatter($reservation->end) }}</div>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action buttons">
                            <button type="button" class="btn btn-primary" title="View"
                                onclick="window.location.href='{{ avenue_route('reservations.show', ['reservation' => $reservation->id]) }}'">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            @if ($reservation->status->code == 'active')
                                <button type="button" class="btn btn-secondary" title="Edit"
                                    onclick="window.location.href='{{ avenue_route('reservations.edit', ['reservation' => $reservation->id]) }}'">
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
