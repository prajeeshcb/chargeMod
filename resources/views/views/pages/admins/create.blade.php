@extends('layouts.app')
@section('title', 'Admins')

@section('header')
    <h1 class="page-title">New Admin</h1>
    <div class="page-header-actions">
        {{--<button type="button" class="btn btn-sm btn-primary btn-round">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Create Admin</span>
        </button>--}}
    </div>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="panel">
        <form id="form-admin-create" method="POST" action="{{ route('admins.store') }}">
            @csrf

            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="role">Role<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select id="role" name="role" data-plugin="select2"
                                        class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                    <option value="">-</option>
                                    @foreach (\App\Models\Admin::ROLES as $role => $label)
                                        @if ($role != \App\Models\Admin::ROLE_OWNER && $role != \App\Models\Admin::ROLE_ADMIN)
                                            <option value="{{ $role }}" @if(old('role') == $role) selected @endif>{{ $label }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Full Name" value="{{ old('name') }}"
                                       autocomplete="off">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="@email.com" value="{{ old('email') }}"
                                       autocomplete="off">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="password">Password<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="password" name="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="" autocomplete="off">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="password_confirmation">Confirm Password<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       placeholder="" autocomplete="off">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="active">Stations</label>
                            <div class="col-md-9">
                                <select class="form-control select2-hidden-accessible" multiple="" name="stations[]" data-plugin="select2" data-select2-id="stations" tabindex="-1" aria-hidden="true">
                                    @foreach(\App\Models\Station::all() as $station)
                                        <option value="{{ $station->id }}" data-select2-id="station-{{ $station->id }}">{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="active">Active </label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="active" name="active" type="checkbox" value="1" @if(old('active', true)) checked @endif
                                           class="{{ $errors->has('active') ? ' is-invalid' : '' }}" >
                                    <label for="active"></label>
                                </div>

                                @if ($errors->has('active'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('active') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-9">
                        <button id="btn-submit" type="submit" class="btn btn-primary">Save</button>
                        {{--<button id="btn-reset" type="reset" class="btn btn-default btn-outline">Reset</button>--}}
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        'use strict';

        $('#form-admin-create').validate({
            rules: {
                role: {
                    required: true
                },
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                password_confirmation: {
                    required: true
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#role').val("").trigger('change');
            $('#form-admin-create').resetForm();
        });


    });
</script>
@endpush
