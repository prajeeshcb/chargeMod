@extends('layouts.app')
@section('title', 'Admins')

@section('header')
    <h1 class="page-title">Edit Admin</h1>
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
        <form id="form-admin-update" method="POST" action="{{ route('admins.update', $admin->id) }}">
            @csrf
            @method('PUT')

            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="role">Role<span class="required">*</span>: </label>
                            <div class="col-md-9">
                                @if( $admin->role != \App\Models\Admin::ROLE_OWNER)
                                    <select id="role" name="role" data-plugin="select2"
                                            class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                        <option value="">-</option>
                                        <option value="{{ \App\Models\Admin::ROLE_ADMIN }}" {{ old('role', $admin->role) == \App\Models\Admin::ROLE_ADMIN ? 'selected' : '' }}>Admin</option>
                                        <option value="{{ \App\Models\Admin::ROLE_MANAGER }}" {{ old('role', $admin->role) == \App\Models\Admin::ROLE_MANAGER ? 'selected' : '' }}>Manager</option>
                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">{{ $errors->first('role') }}</span>
                                    @endif
                                @else
                                    <input id="role" type="text" readonly class="form-control-plaintext" value="{{  \App\Models\Admin::ROLES[\App\Models\Admin::ROLE_OWNER] }}">
                                    <input name="role" type="hidden" value="{{  \App\Models\Admin::ROLE_OWNER }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span>: </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Full Name" value="{{ old('name', $admin->name) }}"
                                       autocomplete="off">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email<span class="required">*</span>: </label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="@email.com" value="{{ old('email', $admin->email) }}"
                                       autocomplete="off">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="password">Password: </label>
                            <div class="col-md-9">
                                <input id="password" name="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="" autocomplete="off">

                                <small class="form-text text-muted" role="alert">Leave blank if you don't want to update password</small>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="password_confirmation">Confirm Password: </label>
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
                            <label class="col-md-3 col-form-label" for="active">Active </label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="active" name="active" type="checkbox" value="1" @if(old('active', $admin->active)) checked @endif
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

        $('#form-admin-update').validate({
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
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#form-admin-update').resetForm();
        });


    });
</script>
@endpush