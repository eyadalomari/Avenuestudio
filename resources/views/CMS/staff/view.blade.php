@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.view_staff') }}</h2>
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
                    <span>{{ $user->role->code ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>{{ __('common.status') }}:</span></div>
                <div class="col-10">
                    <span>{{ $user->is_active == 1 ? 'Yes' : 'No' }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>{{ __('common.created_date') }}:</span></div>
                <div class="col-10">
                    <span>{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString()}}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>{{ __('common.updated_date') }}:</span></div>
                <div class="col-10">
                    <span>{{ \Carbon\Carbon::parse($user->updated_at)->toDayDateTimeString()}}</span>
                </div>
            </div>
            <div class="mt-3">
                <a type="button" class="btn btn-secondary" href="{{ avenue_route('staffs.index') }}">{{ __('common.back') }}</a>
            </div>
    </div>
@endsection
