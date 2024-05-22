@extends('CMS.dashboard')

@section('content')
    <div class="container">
        <h2>{{ __('common.view_type') }}</h2>
        @csrf
        @foreach ($type->labels as $row)
            <div class="form-group row mt-3">
                <div class="col-2"><span for="name">{{ __('common.'.strtolower($languages[$row->language_id]->name).'_name') }}:</span></div>
                <div class="col-10">
                    <span>{{ $row->name }}</span>
                </div>
            </div>
        @endforeach

        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.code') }}:</span></div>
            <div class="col-10">
                <span>{{ $type->code }}</span>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-2"><span>{{ __('common.sort') }}:</span></div>
            <div class="col-10">
                <span>{{ $type->sort }}</span>
            </div>
        </div>
        <div class="mt-3">
            <a type="button" class="btn btn-secondary" href="{{ avenue_route('types.index') }}">{{ __('common.back') }}</a>
        </div>
    </div>
@endsection
