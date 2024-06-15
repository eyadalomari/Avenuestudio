@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ empty($role) ? __('common.create_role') : __('common.edit_role') }}</h2>

        <form action="{{ avenue_route('roles.store') }}" method="POST">
            @csrf
            @if (!empty($role))
                <input type="hidden" name="role_id" value="{{ $role->role_id }}">
            @endif

            @foreach ($languages as $language)
                <div class="form-group row mt-3">
                    <div class="col-2"><label for="name">{{ __('common.'.strtolower($language->name).'_name') }}:</label></div>
                    <div class="col-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_{{ $language->language_id }}"
                            name="name[{{ $language->language_id }}]" placeholder="{{ __('common.enter_'.strtolower($language->name).'_name') }}" value="{{ old('name['.$language->language_id.']', $role->labels[$language->language_id]->name ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach

            <div class="form-group row mt-3">
                <div class="col-2"><label for="code">{{ __('common.code') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        name="code" placeholder="{{ __('common.enter_code') }}" value="{{ old('code', $role->code ?? '') }}">
                    @error('code')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="sort">{{ __('common.sort') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"
                        name="sort" placeholder="{{ __('common.enter_sort') }}" value="{{ old('sort', $role->sort ?? '') }}">
                    @error('sort')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Add more form fields for other columns -->
            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('roles.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection
