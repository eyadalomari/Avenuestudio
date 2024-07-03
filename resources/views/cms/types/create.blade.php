@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ empty($type) ? __('common.create_type') : __('common.edit_type') }}</h2>

        <form action="{{ avenue_route('types.store') }}" method="POST">
            @csrf
            @if (!empty($type))
                <input type="hidden" name="id" value="{{ $type->id }}">
            @endif

            @foreach ($languages as $language)
                <div class="form-group row mt-3">
                    <div class="col-2"><label for="name">{{ __('common.'.strtolower($language->name).'_name') }}:</label></div>
                    <div class="col-10">
                        <input type="text" class="form-control @error('name.'.$language->id) is-invalid @enderror" id="name_{{ $language->id }}"
                            name="name[{{ $language->id }}]" placeholder="{{ __('common.enter_'.strtolower($language->name).'_name') }}" value="{{ old('name['.$language->id.']', $type->labels[$language->id]->name ?? '') }}">
                        @error('name.'.$language->id)
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

            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('types.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection
