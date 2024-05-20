@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.create_staff') }}</h2>
        <form action="{{ avenue_route('staffs.store') }}" method="POST">
            @csrf
            <div class="form-group row mt-5">
                <div class="col-2"><label for="name">{{ __('common.name') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><label for="mobile">{{ __('common.mobile') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Enter mobile"
                        value="{{ old('mobile') }}">
                    @error('mobile')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="email">{{ __('common.email') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="password">{{ __('common.password') }}:</label></div>
                <div class="col-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                    @error('password')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="password_confirmation">{{ __('common.confirm_password') }}:</label></div>
                <div class="col-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="role_id">{{ __('common.role') }}:</label></div>
                <div class="col-10">
                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                        <option value="">--{{ __('common.select') }}--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->code }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="is_active">{{ __('common.status') }}:</label></div>
                <div class="col-10">
                    <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                        <option value="">--{{ __('common.select') }}--</option>
                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>{{ __('common.active') }}</option>
                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>{{ __('common.not_active') }}</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Add more form fields for other columns -->
            <a type="button" class="btn btn-secondary" href="{{ avenue_route('staffs.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection
