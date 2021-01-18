@extends('layouts.app')
@section('title', 'New Promo COde')

@section('header')
    <h1 class="page-title">New Promo Code</h1>

@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="panel">
        <form id="form-promocode-create" method="POST" action="{{ route('promo-codes.store') }}">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="title" name="title" type="text"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       placeholder="Title" value="{{ old('title') }}"
                                       autocomplete="off">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Start<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="start_at" data-plugin="datepicker" name="start_at" type="text"
                                       class="form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}"
                                       placeholder="Start At" value="{{ old('start_at') }}"
                                       autocomplete="off">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('start_at') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">End<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="end_at" data-plugin="datepicker" name="end_at" type="text"
                                       class="form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}"
                                       placeholder="End At" value="{{ old('end_at') }}"
                                       autocomplete="off">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('end_at') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Code<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input  id="code" name="code" type="text"
                                       class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                       placeholder="Code" value="{{ old('code') }}"
                                       autocomplete="off">
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Discount<span class="required">*</span> </label>
                            <div class="col">
                                <input  id="discount" name="discount" type="text"
                                        class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}"
                                        placeholder="Discount" value="{{ old('discount') }}"
                                        autocomplete="off">
                                @if ($errors->has('discount'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('discount') }}</span>
                                @endif
                            </div>
                            <div class="col">
                                <div class="radio-custom radio-default radio-inline">
                                    <input value="0" type="radio" id="percentage" name="discount_type">
                                    <label for="discount_type">Percentage</label>
                                </div>
                                <div class="radio-custom radio-default radio-inline">
                                    <input value="1" type="radio" id="flat" name="discount_type" checked="">
                                    <label for="discount_type">Flat</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">Multiple Times </label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="can_use_multiple_times" name="can_use_multiple_times" type="checkbox"
                                           value="1" @if(old('can_use_multiple_times', true)) checked @endif
                                    class="{{ $errors->has('can_use_multiple_times') ? ' is-invalid' : '' }}" >
                                    <label for="can_use_multiple_times"></label>
                                </div>
                                @if ($errors->has('can_use_multiple_times'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('can_use_multiple_times') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">Status </label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="status" name="status" type="checkbox" value="1" @if(old('status', true)) checked @endif
                                    class="{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                    <label for="status"></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('status') }}</span>
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

        $('#form-promocode-create').validate({
            rules: {

                title: {
                    required: true
                },
                start_at: {
                    required: true
                },
                end_at: {
                    required: true
                },
                code: {
                    required: true
                },
                discount: {
                    required: true
                },
                discount_type: {
                    required: true
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#role').val("").trigger('change');
            $('#form-promocode-create').resetForm();
        });


    });
</script>
@endpush

@push('css')
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
</style>
@endpush