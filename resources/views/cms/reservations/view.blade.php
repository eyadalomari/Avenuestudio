@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.view_reservation') }}</h2>
        @csrf
        <div class="form-group row mt-5">
            <div class="col-2"><span>{{ __('common.name') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->name }}</span>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.mobile') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->mobile }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.type') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->type_name }} ({{ __('common.' . $reservation->location_type) }})</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.price') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->price }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.remaining_price') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->price_remaining }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.name') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->thePhotographer->name }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.status') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->status_name }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.has_video') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->has_video == 1 ? __('common.yes') : __('common.no') }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.date') }}:</span></div>
            <div class="col-10">
                <span>{{ dateFormatter($reservation->date) }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.time') }}:</span></div>
            <div class="col-10">
                <span>{{ timeFormatter($reservation->start).' - '.timeFormatter($reservation->end) }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.note') }}:</span></div>
            <div class="col-10">
                <span>{{ !empty($reservation->note) ? $reservation->note : 'N/A' }}</span>
            </div>
        </div>
        <div class="mt-3">
            <a type="button" class="btn btn-secondary" href="{{ avenue_route('reservations.index') }}">Back</a>
        </div>
    </div>
@endsection
