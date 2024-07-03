@extends('cms.dashboard')

@section('content')
    <div class="container">
        <h2>{{ empty($role) ? __('common.create_role') : __('common.edit_role') }}</h2>

        <form action="{{ avenue_route('roles.store') }}" method="POST">
            @csrf
            @if (!empty($role))
                <input type="hidden" name="id" value="{{ $role->id }}">
            @endif

            @foreach ($languages as $language)
                <div class="form-group row mt-3">
                    <div class="col-2"><label
                            for="name">{{ __('common.' . strtolower($language->name) . '_name') }}:</label>
                    </div>
                    <div class="col-10">
                        <input type="text" class="form-control @error('name.' . $language->id) is-invalid @enderror"
                            id="name_{{ $language->id }}" name="name[{{ $language->id }}]"
                            placeholder="{{ __('common.enter_' . strtolower($language->name) . '_name') }}"
                            value="{{ old('name[' . $language->id . ']', $role->labels[$language->id]->name ?? '') }}">
                        @error('name.' . $language->id)
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach

            <div class="form-group row mt-3">
                <div class="col-2"><label for="code">{{ __('common.code') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        name="code" placeholder="{{ __('common.enter_code') }}"
                        value="{{ old('code', $role->code ?? '') }}">
                    @error('code')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-2"><label for="sort">{{ __('common.sort') }}:</label></div>
                <div class="col-10">
                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"
                        name="sort" placeholder="{{ __('common.enter_sort') }}"
                        value="{{ old('sort', $role->sort ?? '') }}">
                    @error('sort')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-2 mt-3"><label for="permissions">{{ __('common.permissions') }}:</label></div>
                <div class="col-10">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('common.section') }}</th>
                                <th>{{ __('common.name') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            id="permissions[{{ $permission->id }}]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <label class="form-check-label" for="permissions[{{ $permission->id }}]">{{ $permission->section }}</label>
                                    </td>
                                    <td>
                                        <label class="form-check-label" for="permissions[{{ $permission->id }}]">{{ $permission->name }}</label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @error('permissions')
                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            </div>




            <a type="button" class="btn btn-secondary"
                href="{{ avenue_route('roles.index') }}">{{ __('common.back') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
        </form>
    </div>
@endsection
