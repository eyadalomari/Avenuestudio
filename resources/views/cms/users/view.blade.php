@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.view_user') }}</h2>
        @csrf
        <div class="form-group row mt-5">
            <div class="col-2"><span for="name">{{ __('common.name') }}:</span></div>
            <div class="col-10">
                <span>{{ $user->name }}</span>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-2"><span for="mobile">{{ __('common.mobile') }}:</span></div>
            <div class="col-10">
                <span>{{ $user->mobile }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.email') }}:</span></div>
            <div class="col-10">
                <span>{{ $user->email }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.role') }}:</span></div>
            <div class="col-10">
                @forelse ($user->roles as $role)
                    <li>{{ $role->label->name }}</li>
                @empty
                    <span>N/A</span>
                @endforelse

            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.status') }}:</span></div>
            <div class="col-10">
                <span>{{ $user->is_active == 1 ? __('common.active') : __('common.in_active') }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.created_date') }}:</span></div>
            <div class="col-10">
                <span>{{ dateTimeFormatter($user->created_at) }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.updated_date') }}:</span></div>
            <div class="col-10">
                <span>{{ dateTimeFormatter($user->updated_at) }}</span>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.profile_picture') }}:</span></div>
            <div class="col-10">
                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="100">
            </div>
        </div>



        <div class="mt-3">
            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('users.index') }}">{{ __('common.back') }}</a>
        </div>
    </div>
@endsection
