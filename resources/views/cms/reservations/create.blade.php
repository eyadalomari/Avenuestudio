@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ empty($reservation) ? __('common.create_reservation') : __('common.edit_reservation') }}</h2>
        
        @if ($errors->has('overlap'))
            <div class="alert alert-danger">{{ $errors->first('overlap') }}</div>
        @endif

        <form action="{{ avenue_route('reservations.store') }}" method="POST">
            @csrf
            @if (!empty($reservation))
                <input type="hidden" name="id" value="{{ $reservation->id }}">
            @endif
            <div class="form-group row mt-5">
                <div class="col-2"><label for="name">{{ __('common.name') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="{{ __('common.enter_name') }}" value="{{ old('name', $reservation->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><label for="mobile">{{ __('common.mobile') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                        name="mobile" placeholder="{{ __('common.enter_mobile') }}" value="{{ old('mobile', $reservation->mobile ?? '') }}">
                    @error('mobile')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="type_id">{{ __('common.type') }}:</label></div>
                <div class="col-5">
                    <select class="form-control @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                        <option value="">--{{ __('common.select') }}--</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('type_id', $reservation->type_id ?? '') == $type->id ? 'selected' : '' }}>
                                {{ $type->label->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-5">
                    <select class="form-control @error('location_type') is-invalid @enderror" id="location_type"
                        name="location_type">
                        <option value="">--{{ __('common.select') }}--</option>
                        <option value="indoor"
                            {{ old('location_type', $reservation->location_type ?? '') == 'indoor' ? 'selected' : '' }}>
                            {{ __('common.indoor') }}</option>
                        <option value="outdoor"
                            {{ old('location_type', $reservation->location_type ?? '') == 'outdoor' ? 'selected' : '' }}>
                            {{ __('common.outdoor') }}</option>
                    </select>
                    @error('location_type')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="price">{{ __('common.price') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" placeholder="{{ __('common.enter_price') }}" value="{{ old('price', $reservation->price ?? '') }}">
                    @error('price')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="price_remaining">{{ __('common.remaining_price') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('price_remaining') is-invalid @enderror"
                        id="price_remaining" name="price_remaining" placeholder="{{ __('common.enter_remaining_price') }}"
                        value="{{ old('price_remaining', $reservation->price_remaining ?? '') }}">
                    @error('price_remaining')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="photographer">{{ __('common.photographer') }}:</label></div>
                <div class="col-10">
                    <select class="form-control @error('photographer') is-invalid @enderror" id="photographer"
                        name="photographer">
                        {{ print_r($users) }}
                        <option value="">--{{ __('common.select') }}--</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('photographer', $reservation->photographer ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('photographer')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="status_id">{{ __('common.status') }}:</label></div>
                <div class="col-10">
                    <select class="form-control @error('status_id') is-invalid @enderror" id="status_id" name="status_id">
                        <option value="">--{{ __('common.select') }}--</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('status_id', $reservation->status_id ?? '') == $status->id ? 'selected' : '' }}>
                                {{  $status->label->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="has_video">{{ __('common.has_video') }}:</label></div>
                <div class="col-10">
                    <select class="form-control @error('has_video') is-invalid @enderror" id="has_video"
                        name="has_video">
                        <option value="">--{{ __('common.select') }}--</option>
                        <option value="1"
                            {{ old('has_video', $reservation->has_video ?? '') == '1' ? 'selected' : '' }}>
                            {{ __('common.yes') }}</option>
                        <option value="0"
                            {{ old('has_video', $reservation->has_video ?? '') == '0' ? 'selected' : '' }}>
                            {{ __('common.no') }}</option>
                    </select>
                    @error('has_video')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="date">{{ __('common.date') }}:</label></div>
                <div class="col-10">
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                        name="date" value="{{ old('date', $reservation->date ?? '') }}">
                    @error('date')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="start">{{ __('common.start_time') }}:</label></div>
                <div class="col-10">
                    <input type="time" class="form-control @error('start') is-invalid @enderror" id="start"
                        name="start" step="60" value="{{ old('start', $reservation->start ?? '') }}">
                    @error('start')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="end">{{ __('common.end_time') }}:</label></div>
                <div class="col-10">
                    <input type="time" class="form-control @error('end') is-invalid @enderror" id="end"
                        name="end" step="60" value="{{ old('end', $reservation->end ?? '') }}">
                    @error('end')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="note">{{ __('common.note') }}:</label></div>
                <div class="col-10">
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note', $reservation->note ?? '') }}</textarea>
                    @error('note')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('reservations.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var startInput = document.getElementById('start');
        startInput.value = startInput.value.substring(0, 5);

        startInput.addEventListener('change', function() {
            if (startInput.value.length > 5) {
                startInput.value = startInput.value.substring(0, 5);
            }
        });

        var endInput = document.getElementById('end');
        endInput.value = endInput.value.substring(0, 5);

        endInput.addEventListener('change', function() {
            if (endInput.value.length > 5) {
                endInput.value = endInput.value.substring(0, 5);
            }
        });
    });
</script>
