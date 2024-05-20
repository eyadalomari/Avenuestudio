@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>View User</h2>
            @csrf
            <div class="form-group row mt-5">
                <div class="col-2"><span for="name">Name:</span></div>
                <div class="col-10">
                    <span>{{ $user->name }}</span>
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><span for="mobile">Mobile:</span></div>
                <div class="col-10">
                    <span>{{ $user->mobile }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>Email:</span></div>
                <div class="col-10">
                    <span>{{ $user->email }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>Role:</span></div>
                <div class="col-10">
                    <span>{{ $user->role->code ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>Active:</span></div>
                <div class="col-10">
                    <span>{{ $user->is_active == 1 ? 'Yes' : 'No' }}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>Created Date:</span></div>
                <div class="col-10">
                    <span>{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString()}}</span>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><span>Updated Date:</span></div>
                <div class="col-10">
                    <span>{{ \Carbon\Carbon::parse($user->updated_at)->toDayDateTimeString()}}</span>
                </div>
            </div>
            <div class="mt-3">
                <a type="button" class="btn btn-secondary" href="{{ route('staffs.index') }}">Back</a>
            </div>
    </div>
@endsection
