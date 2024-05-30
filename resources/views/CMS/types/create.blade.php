@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>{{ empty($type) ? __('common.create_type') : __('common.edit_type') }}</h2>
        <form action="{{ avenue_route('types.store') }}" method="POST">
            @csrf
            @if (!empty($type))
                <input type="hidden" name="type_id" value="{{ $type->type_id }}">
            @endif

            @foreach ($languages as $language)
                <div class="form-group row mt-3">
                    <div class="col-2"><label for="name">{{ __('common.'.strtolower($language->name).'_name') }}:</label></div>
                    <div class="col-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_{{ $language->language_id }}"
                            name="name[{{ $language->language_id }}]" placeholder="{{ __('common.enter_'.strtolower($language->name).'_name') }}" value="{{ old('name['.$language->language_id.']', $type->labels[$language->language_id]->name ?? '') }}">
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
                        name="code" placeholder="{{ __('common.enter_code') }}" value="{{ old('code', $type->code ?? '') }}">
                    @error('code')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="sort">{{ __('common.sort') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"
                        name="sort" placeholder="{{ __('common.enter_sort') }}" value="{{ old('sort', $type->sort ?? '') }}">
                    @error('sort')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Add more form fields for other columns -->
            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('types.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection
