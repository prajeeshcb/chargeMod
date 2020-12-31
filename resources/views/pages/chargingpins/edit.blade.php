@extends('layouts.app')
@section('title', 'Edit Charging Pin')

@section('header')
    <h1 class="page-title">Edit Charging Pin</h1>

@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="panel">
        <form id="form-chargingpin-update" method="POST" action="{{ route('charging-pins.update', $chargingpin->id) }}">
            @csrf
            @method('PUT')

            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span>: </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Name" value="{{ old('name', $chargingpin->name) }}"
                                       autocomplete="off">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Battery<span class="required">*</span>: </label>
                            <div class="col-md-9">
                                <input id="name" name="battery" type="text"
                                       class="form-control{{ $errors->has('battery') ? ' is-invalid' : '' }}"
                                       placeholder="Battery" value="{{ old('battery', $chargingpin->battery) }}"
                                       autocomplete="off">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('battery') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Type<span class="required">*</span>: </label>
                            <div class="col-md-9">
                                <input id="type" name="type" type="text"
                                       class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                       placeholder="Type" value="{{ old('name', $chargingpin->type) }}"
                                       autocomplete="off">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="active">Status </label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="status" name="status" type="checkbox" value="1" @if(old('status', $chargingpin->status)) checked @endif
                                    class="{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                    <label for="active"></label>
                                </div>

                                @if ($errors->has('active'))
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

        $('#form-chargingpin-update').validate({
            rules: {
                name: {
                    required: true
                },
                battery: {
                    required: true
                },
                type: {
                    required: true
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#form-chargingpin-update').resetForm();
        });


    });
</script>
@endpush