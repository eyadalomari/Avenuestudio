@extends('cms.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <h5 class="card-title fw-semibold mb-4">{{ __('common.staffs') }}</h5>
            <a type="button" class="btn btn-primary m-1" href="{{ avenue_route('staffs.create') }}">{{ __('common.add') }}</a>
        </div>
        <div id="calendar"></div>
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'timeGridWeek',
                        slotMinTime: '8:00:00',
                        slotMaxTime: '19:00:00',
                        events: @json($events ?? []),
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
                        <td>{{ !empty($user->role) ? __('common.' . $user->role->code) : 'N/A' }}</td>
                        <td>{{ $user->is_active == 1 ? __('common.active') : __('common.in_active') }}</td>
                        <td>{{ ($user->created_at) }}</td>
                        <td>{{ ($user->updated_at) }}</td>
                        <td>
                            <button type="button" class="btn btn-primary m-1"
                                onclick="window.location.href='{{ avenue_route('staffs.show', ['staff' => $user->user_id]) }}'">
                                {{ __('common.view') }}
                            </button>
                            @if ($user->user_id != 1)
                                <button type="button" class="btn btn-primary m-1"
                                    onclick="window.location.href='{{ avenue_route('staffs.edit', ['staff' => $user->user_id]) }}'">
                                    {{ __('common.edit') }}
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection
