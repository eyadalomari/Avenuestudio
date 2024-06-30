@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ empty($user) ? __('common.create_user') : __('common.edit_user') }}</h2>

        <form action="{{ avenue_route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!empty($user))
                <input type="hidden" name="id" value="{{ $user->id }}">
            @endif
            <div class="form-group row mt-5">
                <div class="col-2"><label for="name">{{ __('common.name') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="{{ __('common.enter_name') }}" value="{{ old('name', $user->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><label for="mobile">{{ __('common.mobile') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                        name="mobile" placeholder="{{ __('common.enter_mobile') }}" value="{{ old('mobile', $user->mobile ?? '') }}">
                    @error('mobile')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="email">{{ __('common.email') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="{{ __('common.enter_email') }}" value="{{ old('email', $user->email ?? '') }}">
                    @error('email')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="password">{{ __('common.password') }}:</label></div>
                <div class="col-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="{{ __('common.enter_password') }}">
                    @error('password')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="password_confirmation">{{ __('common.confirm_password') }}:</label></div>
                <div class="col-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation" placeholder="{{ __('common.confirm_password') }}">
                    @error('password_confirmation')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="is_active">{{ __('common.status') }}:</label></div>
                <div class="col-10">
                    <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                        <option value="">--{{ __('common.select') }}--</option>
                        <option value="1" {{ old('is_active', $user->is_active ?? '') == 1 ? 'selected' : '' }}>
                            {{ __('common.active') }}</option>
                        <option value="0" {{ old('is_active', $user->is_active ?? '') == 0 ? 'selected' : '' }}>
                            {{ __('common.in_active') }}</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><label for="image">{{ __('common.profile_picture') }}:</label></div>
                <div class="col-10">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>

            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('users.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection
