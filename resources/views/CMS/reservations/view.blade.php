@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.view_reservation') }}</h2>
        @csrf
        <div class="form-group row mt-5">
            <div class="col-2"><span for="name">{{ __('common.name') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->name }}</span>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-2"><span for="mobile">{{ __('common.mobile') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->mobile }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="type_id">{{ __('common.type') }}:</span></div>
            <div class="col-10">
                <span>{{ !empty($reservation->type) ? __('common.' . $reservation->type->code) : 'N/A' }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="price">{{ __('common.price') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->price }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="price_remaining">{{ __('common.remaining_price') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->price_remaining }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="photographer">{{ __('common.name') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->photographer }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="status_id">{{ __('common.status') }}:</span></div>
            <div class="col-10">
                <span>{{ !empty($reservation->status) ? __('common.' . $reservation->status->code) : 'N/A' }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="has_video">{{ __('common.has_video') }}:</span></div>
            <div class="col-10">
                <span>{{ $reservation->has_video == 1 ? 'yes' : 'no' }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="start_date">{{ __('common.start_date') }}:</span></div>
            <div class="col-10">
                <span>{{ dateTimeFormatter($reservation->start_date) }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="end_date">{{ __('common.end_date') }}:</span></div>
            <div class="col-10">
                <span>{{ dateTimeFormatter($reservation->end_date) }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span for="note">{{ __('common.note') }}:</span></div>
            <div class="col-10">
                <span>{{ !empty($reservation->note) ? $reservation->note : 'N/A' }}</span>
            </div>
        </div>
        <div class="mt-3">
            <a type="button" class="btn btn-secondary" href="{{ avenue_route('reservations.index') }}">Back</a>
        </div>
    </div>
@endsection
