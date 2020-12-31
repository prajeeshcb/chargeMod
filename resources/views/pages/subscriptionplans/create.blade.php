@extends('layouts.app')
@section('title', 'Subscription Plan')

@section('header')
    <h1 class="page-title">New Subscription Plan</h1>
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
        <form id="form-subscriptionplan-create" method="POST" action="{{ route('subscription-plans.store') }}">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Name" value="{{ old('name') }}"
                                       autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Interval<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select id="interval" name="interval" data-plugin="select2"
                                        class="form-control{{ $errors->has('interval') ? ' is-invalid' : '' }}">
                                    <option value="0">Monthly</option>
                                    <option value="1">Yearly</option>
                                </select>
                                @if ($errors->has('interval'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('interval') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Interval Count<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="interval_count" name="interval_count" type="text"
                                       class="form-control{{ $errors->has('interval_count') ? ' is-invalid' : '' }}"
                                       placeholder="Interval Count" value="{{ old('interval_count') }}"
                                       autocomplete="off">
                                @if ($errors->has('interval_count'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('interval_count') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Amount<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="amount" name="amount" type="text"
                                       class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                       placeholder="Amount" value="{{ old('amount') }}"
                                       autocomplete="off">
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Quantity<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="quantity" name="quantity" type="text"
                                       class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                       placeholder="Quantity" value="{{ old('quantity') }}"
                                       autocomplete="off">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('quantity') }}</span>
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

        $('#form-subscriptionplan-create').validate({
            rules: {

                name: {
                    required: true
                },
                interval: {
                    required: true
                },
                interval_count: {
                    required: true
                },
                amount: {
                    required: true
                },
                quantity: {
                    required: true
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#role').val("").trigger('change');
            $('#form-subscriptionplan-create').resetForm();
        });


    });
</script>
@endpush