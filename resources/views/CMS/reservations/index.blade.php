@extends('CMS.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">Reservations</h5>
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('reservations.create') }}">Add</a>
        </div>
        <div id="calendar"></div>
        @push('scripts')
        <script> 
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '19:00:00',
                    events: @json($events??[]),
                });
                calendar.render();
            });
        </script>
    @endpush

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('common.name') }}</th>
                    <th>{{ __('common.mobile') }}</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Has Video</th>
                    <th>Date & Time</th>
                    <th>photographer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->mobile }}</td>
                        <td>{{ !empty($reservation->type) ? $reservation->type->code : 'N/A' }}
                            ({{ $reservation->location_type }})
                        </td>
                        <td>{{ $reservation->price }}</td>
                        <td>{{ !empty($reservation->status) ? $reservation->status->code : 'N/A' }}</td>
                        <td>{{ $reservation->has_video ? 'Yes' : 'No' }}</td>
                        <td>
                            <div class="row">{{ \Carbon\Carbon::parse($reservation->start_date)->toDayDateTimeString()}}</div>
                            <div class="row">{{  \Carbon\Carbon::parse($reservation->end_date)->toDayDateTimeString() }}</td></div>
                        <td>{{ $reservation->photographer }}</td>
                        <td>
                            <button type="button" class="btn btn-primary m-1" onclick="window.location.href='{{ avenue_route('reservations.show', ['reservation' => $reservation->id]) }}'">
                                View
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
