@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>View Reservation</h2>
            @csrf
            <div class="form-group row mt-5">
                <div class="col-2"><span for="name">Name:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->name }}</span>
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><span for="mobile">Mobile:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->mobile }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="type_id">Type:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->type->code }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="price">Price:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->price }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="price_remaining">Remaining Price:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->price_remaining }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="photographer">Photographer:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->photographer }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="status_id">Status:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->status->code }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="has_video">Has Video:</span></div>
                <div class="col-10">
                    <span>{{ $reservation->has_video == 1?'yes':'no' }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="start_date">Start Date:</span></div>
                <div class="col-10">
                    <span>{{ \Carbon\Carbon::parse($reservation->start_date)->toDayDateTimeString() }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="end_date">End Date:</span></div>
                <div class="col-10">
                    <span>{{ \Carbon\Carbon::parse($reservation->end_date)->toDayDateTimeString() }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span for="note">Note:</span></div>
                <div class="col-10">
                    <span>{{ !empty($reservation->note)?$reservation->note:'N/A' }}</span>
                </div>
            </div>
            <div class="mt-3">
                <a type="button" class="btn btn-secondary" href="{{ avenue_route('reservations.index') }}">Back</a>
            </div>
    </div>
@endsection
