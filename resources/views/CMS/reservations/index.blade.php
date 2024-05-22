@extends('CMS.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.reservations') }}</h5>
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('reservations.create') }}">{{ __('common.add') }}</a>
        </div>
 
        

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
                    <th>{{ __('common.date_time') }}</th>
                    <th>{{ __('common.photographer') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->mobile }}</td>
                        <td>{{ !empty($reservation->type) ? __('common.'.$reservation->type->code) : 'N/A' }}
                            ({{ __('common.'.$reservation->location_type) }})
                        </td>
                        <td>{{ $reservation->price }}</td>
                        <td>{{ !empty($reservation->status) ? __('common.'.$reservation->status->code) : 'N/A' }}</td>
                        <td>{{ $reservation->has_video ? __('common.active') : __('common.in_active') }}</td>
                        <td>
                            <div class="row">{{ dateTimeFormatter($reservation->start_date) }}</div>
                            <div class="row">{{ dateTimeFormatter($reservation->end_date) }}</div>
                        <td>{{ $reservation->photographer }}</td>
                        <td>
                            <button type="button" class="btn btn-primary m-1" onclick="window.location.href='{{ avenue_route('reservations.show', ['reservation' => $reservation->id]) }}'">
                                {{ __('common.view') }}
                            </button>
                            <button type="button" class="btn btn-primary m-1" onclick="window.location.href='{{ avenue_route('reservations.edit', ['reservation' => $reservation->id]) }}'">
                                {{ __('common.edit') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $reservations->links() }}
        </div>
    </div>
@endsection
