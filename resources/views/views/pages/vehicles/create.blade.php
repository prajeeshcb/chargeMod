@extends('layouts.app')
@section('title', 'New Vehicle')

@section('header')
    <h1 class="page-title">New Vehicle</h1>
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
        <form id="form-vehicle-create" method="POST" action="{{ route('vehicles.store') }}">
            @csrf

            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">name<span class="required">*</span> </label>
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
                            <label class="col-md-3 col-form-label">Model<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="model" name="model" type="text"
                                       class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}"
                                       placeholder="Model" value="{{ old('model') }}"
                                       autocomplete="off">

                                @if ($errors->has('model'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('model') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Year<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="year" name="year" type="text"
                                       class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}"
                                       placeholder="Year" value="{{ old('battery') }}"
                                       autocomplete="off">

                                @if ($errors->has('year'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('year') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Battery<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="battery" name="battery" type="text"
                                       class="form-control{{ $errors->has('battery') ? ' is-invalid' : '' }}"
                                       placeholder="Battery" value="{{ old('battery') }}"
                                       autocomplete="off">

                                @if ($errors->has('battery'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('battery') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Charging Time<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="charging_time" name="charging_time" type="text"
                                       class="form-control{{ $errors->has('charging_time') ? ' is-invalid' : '' }}"
                                       placeholder="Charging Time" value="{{ old('charging_time') }}"
                                       autocomplete="off">

                                @if ($errors->has('charging_time'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('charging_time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="role">Manufacturers<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select id="Manufactures" name="manufacturer_id" data-plugin="select2"
                                        class="form-control{{ $errors->has('manufacturer_id') ? ' is-invalid' : '' }}">
                                    <option value="">-</option>
                                    @foreach ($manufactures as $manufacturer)
                                        <option value="{{ $manufacturer->id }}" @if(old('manufacturer_id') == $manufacturer->name) selected @endif>{{ $manufacturer->name }}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('manufacturer_id'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('manufacturer_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="role">Charging Pin<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <select id="charging_pins" name="charging_pin_id" data-plugin="select2"
                                        class="form-control{{ $errors->has('charging_pin_id') ? ' is-invalid' : '' }}">
                                    <option value="">-</option>
                                    @foreach ($charging_pins as $charging_pin)
                                        <option value="{{ $charging_pin->id }}" @if(old('charging_pin_id') == $charging_pin->name) selected @endif>{{ $charging_pin->name }}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('charging_pin_id'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('charging_pin_id') }}</span>
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

        $('#form-vehicle-create').validate({
            rules: {

                name: {
                    required: true
                },
                model: {
                    required: true,
                },
                year: {
                    required: true
                },
                battery: {
                    required: true
                },
                charging_time: {
                    required: true
                },
                manufacturer_id: {
                    required: true
                },
                charging_pin_id: {
                    required: true
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#role').val("").trigger('change');
            $('#form-vehicle-create').resetForm();
        });


    });
</script>
@endpush