@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.profile') }}</h2>

        @include('cms.success')

        <form action="{{ avenue_route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-image-wrapper mt-3" id="profileImageWrapper">
                <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror"
                    id="profile_image" name="profile_image" accept="image/*" style="display: none">
                <label for="profile_image" id="profileImageLink">
                    <img id="profileImagePreview"
                        src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('images/profile/user-1.jpg') }}"
                        alt="Profile Picture" class="img-fluid">
                    <span class="edit-icon"><i class="fa fa-edit"></i></span>
                </label>
            </div>
            <div class="form-group row mt-5">
                <div class="col-2"><label for="name">{{ __('common.name') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="{{ __('common.enter_name') }}"
                        value="{{ old('name', $user->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><label for="mobile">{{ __('common.mobile') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                        name="mobile" placeholder="{{ __('common.enter_mobile') }}"
                        value="{{ old('mobile', $user->mobile ?? '') }}">
                    @error('mobile')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2"><label for="email">{{ __('common.email') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="{{ __('common.enter_email') }}"
                        value="{{ old('email', $user->email ?? '') }}">
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
                        id="password_confirmation" name="password_confirmation"
                        placeholder="{{ __('common.confirm_password') }}">
                    @error('password_confirmation')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection



<style>
    .profile-image-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-image-wrapper img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        cursor: pointer;
        border-radius: 50%;
    }

    .edit-icon {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px;
        border-radius: 50%;
    }

    .edit-icon i {
        font-size: 16px;
    }
</style>

<script>
    document.getElementById('profile_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
                document.getElementById('profileImageWrapper').style.display = 'block';
                document.getElementById('profileImageLink').href = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
