@extends('layouts.app')
@section('title', 'Edit Station')

@section('header')
    <h1 class="page-title">Edit Station</h1>

@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="panel">
        <form id="form-chargingpin-update" enctype="multipart/form-data"  method="POST" action="{{ route('stations.update', $stations->id) }}">
            @csrf
            @method('PUT')
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Name" value="{{ old('name', $stations->name) }}"
                                       autocomplete="off">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Phone<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="phone" name="phone" type="text"
                                               class="phone-group form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                               placeholder="Phone" value="{{ old('phone',$stations->phone) }}"
                                               autocomplete="off">

                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input id="mobile" name="mobile" type="text"
                                               class="phone-group form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                               placeholder="Mobile" value="{{ old('mobile',$stations->mobile) }}"
                                               autocomplete="off">

                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="text"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="Email" value="{{ old('email',$stations->email) }}"
                                       autocomplete="off">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Address<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="street1" name="street1" type="text"
                                               class="form-control{{ $errors->has('street1') ? ' is-invalid' : '' }}"
                                               placeholder="Street1" value="{{ old('street1',$stations->street1) }}"
                                               autocomplete="off">

                                        @if ($errors->has('street1'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('street1') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="street2" name="street2" type="text"
                                               class="form-control{{ $errors->has('street2') ? ' is-invalid' : '' }}"
                                               placeholder="Street2" value="{{ old('street2',$stations->street2) }}"
                                               autocomplete="off">

                                        @if ($errors->has('street2'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('street2') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="city" name="city" type="text"
                                               class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                               placeholder="City" value="{{ old('city',$stations->city) }}"
                                               autocomplete="off">

                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input id="state" name="state" type="text"
                                               class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}"
                                               placeholder="State" value="{{ old('state',$stations->state) }}"
                                               autocomplete="off">

                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="country" name="country" type="text"
                                               class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                               placeholder="Country" value="{{ old('country',$stations->country) }}"
                                               autocomplete="off">

                                        @if ($errors->has('country'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input id="zip" name="zip" type="text"
                                               class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}"
                                               placeholder="Zip" value="{{ old('zip',$stations->zip) }}"
                                               autocomplete="off">

                                        @if ($errors->has('zip'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('zip') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Location<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="latitude" name="latitude" type="text"
                                               class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}"
                                               placeholder="Latitude" value="{{ old('latitude',$stations->latitude) }}"
                                               autocomplete="off">

                                        @if ($errors->has('latitude'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('latitude') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input id="longitude" name="longitude" type="text"
                                               class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                               placeholder="Longitude" value="{{ old('longitude',$stations->longitude) }}"
                                               autocomplete="off">

                                        @if ($errors->has('longitude'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('longitude') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="blackbox">Status</label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="status" name="status" type="checkbox" @if($stations->status == 1) checked @endif>
                                    <label for="status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="blackbox">Blackbox</label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                    <input id="blackbox" name="blackbox" type="checkbox" @if($stations->is_blackbox == 1) checked @endif>
                                    <label for="blackbox"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Device ID</label>
                            <div class="col-md-9">
                                <input id="device-id" name="device_id" type="text"
                                       class="form-control{{ $errors->has('device_id') ? ' is-invalid' : '' }}"
                                       placeholder="Device ID" value="{{ old('device_id', $stations->device_id) }}"
                                       autocomplete="off">
                                @if ($errors->has('device_id'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('device_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Device UUID</label>
                            <div class="col-md-9">
                                <input id="device-uuid" name="device_uuid" type="text"
                                       class="form-control{{ $errors->has('device_uuid') ? ' is-invalid' : '' }}"
                                       placeholder="Device UUID" value="{{ old('device_uuid', $stations->device_uuid) }}"
                                       autocomplete="off">
                                @if ($errors->has('device_uuid'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('device_uuid') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label class="col-md-3 col-form-label" for="status">Charging Pins </label>
                            <div class="col-md-9 ">
                                @foreach($station_charging_pins as $station_charging_pin )
                                    <div  class="form-group row">
                                            <input name="id[]" type="hidden" value="{{ $station_charging_pin->id }}" >
                                    <div class="col">
                                        <select name="charging_pin_id[]" data-plugin="select2"
                                                class="charging-pin-dropdown form-control{{ $errors->has('charging_pin_id') ? ' is-invalid' : '' }}">
                                            <option value="">-</option>
                                            @foreach($chargingpins as $chargingpin)
                                                <option value="{{ $chargingpin->id}}" {{ old('charging_pin_id',
                                             $chargingpin->id) == $station_charging_pin->charging_pin_id ? 'selected' : '' }}>{{ $chargingpin->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('charging_pin_id'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('charging_pin_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <input id="relay_switch_number" name="relay_switch_number[]" type="text"
                                               class="form-control{{ $errors->has('relay_switch_number') ? ' is-invalid' : '' }}"
                                               placeholder="Relay Switch Number" value="{{ old('relay_switch_number',$station_charging_pin->relay_switch_number) }}"
                                               autocomplete="off">

                                        @if ($errors->has('relay_switch_number'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('relay_switch_number') }}</span>
                                        @endif
                                    </div>
                                    <div class="col" style="flex-grow: 0;flex-shrink: 1; align-self: center">
                                        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                                            <input id="pin_status" name="pin_status[]" data-id="{{ $station_charging_pin->id }}" type="checkbox" value="1" @if(old('pin_status', $station_charging_pin->status)) checked @endif
                                            class="{{ $errors->has('pin_status') ? ' is-invalid' : '' }}" >
                                            <label for="pin_status"></label>
                                            <input type="hidden" name="pin_status_value[]" value="{{ $station_charging_pin->status }}">
                                        </div>
                                        @if ($errors->has('pin_status'))
                                            <span class="invalid-feedback" role="alert">{{ $errors->first('pin_status') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-1" style="flex-grow: 0;flex-shrink: 1; align-self: center">
                                        <a id="close" class="btn btn-pure btn-default icon wb-trash btn-close" href="#"></a>
                                    </div>
                                </div>
                                @endforeach
                                <div class="charging-pins-container">

                                </div>
                                <a id="add-charging-pin" class="pt-10" href="#">Add Charging Pin</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 col-lg-6 ">
                        <div class="form-group row">

                            <div class="col-md-8">
                                <img id="img-preview" class="img-fluid" src="{{ $stations->image }}" alt="...">
                            </div>
                            <div class="col-md-8">
                                <input   id="image" name="image" type="file"
                                         class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                         placeholder="Image" value="{{ old('image',$stations->image) }}"
                                         autocomplete="off">

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('image') }}</span>
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
                    </div>
                </div>
            </div>

        </form>
    </div>
    {{--Template for charging pins--}}
    <div  class="form-group row charging-pin-template hidden-xs-up charging-pins-array">
        <div class="col">
            <select  name="charging_pin_id[]"
                    class="charging-pin-dropdown form-control{{ $errors->has('charging_pin_id') ? ' is-invalid' : '' }}">
                <option value="">-</option>
                @foreach($chargingpins as $chargingpin)
                    <option value="{{ $chargingpin->id }}">{{ $chargingpin->name  }}</option>
                @endforeach
            </select>
            @if ($errors->has('charging_pin_id'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('charging_pin_id') }}</span>
            @endif
        </div>
        <div class="col">
            <input id="relay_switch_number" name="relay_switch_number[]" type="text"
                   class="form-control{{ $errors->has('relay_switch_number') ? ' is-invalid' : '' }}"
                   placeholder="Relay Switch Number" value="{{ old('relay_switch_number') }}"
                   autocomplete="off">
            @if ($errors->has('relay_switch_number'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('relay_switch_number') }}</span>
            @endif
        </div>
        <div class="col" style="flex-grow: 0;flex-shrink: 1; align-self: center">
            <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                <input id="pin_status" name="pin_status[]" type="checkbox" value="1" @if(old('pin_status', true)) checked @endif
                class="{{ $errors->has('pin_status') ? ' is-invalid' : '' }} pin-status" >
                <label for="pin_status"></label>
                <input type="hidden" name="pin_status_value[]" value="1">
            </div>
            @if ($errors->has('pin_status'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('pin_status') }}</span>
            @endif
        </div>
        <div class="col-md-1" style="flex-grow: 0;flex-shrink: 1; align-self: center">
            <a id="close" class="btn btn-pure btn-default icon wb-trash btn-close" href="#"></a>
        </div>
    </div>
    <style type="text/css">
        .hidden-xs-up{
            display: none;
            visibility: hidden;
        }
    </style>
    {{--Template for charging pins Ends--}}
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
                phone: {
                    require_from_group: [1, ".phone-group"]
                },
                mobile: {
                    require_from_group: [1, ".phone-group"]
                },
                email: {
                    required: true,
                    email: true
                },
                street1: {
                    required: true
                },
                street2: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },
                zip: {
                    required: true
                },
                latitude: {
                    required: true
                },
                longitude: {
                    required: true
                },
                device_id: {
                    required: true
                },
                device_uuid: {
                    required: true
                },
                image:{
                    extension: "jpeg,png,jpg"

                },
                "relay_switch_number[]": "required",
                "charging_pin_id[]":"required"
            }
        });

        $('#btn-reset').click(function() {
            $('#role').val("").trigger('change');
            $('#form-station-create').resetForm();
        });

        $("#image").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#add-charging-pin').click(function(event) {
            event.preventDefault();
            var template=$('.charging-pin-template').clone();
            template.removeClass('charging-pin-template');
            template.removeClass('hidden-xs-up');
            template.appendTo('.charging-pins-container');
            template.find('.charging-pin-dropdown').select2();
        });

        $('body').on('click', '#close', function(event) {
            event.preventDefault();
            $(this).closest('.form-group').remove();
        });

        $("input[name='pin_status[]']").on('change', function() {
            if($(this).is(':checked')) {
                $(this).nextAll('input').first().val(1);
            } else {
                $(this).nextAll('input').first().val(0);
            }
        });

        $('.charging-pins-container').on('click', '.pin-status', function() {
            if($(this).is(':checked')) {
                $(this).nextAll('input').first().val(1);
            } else {
                $(this).nextAll('input').first().val(0);
            }
        });

        let chargingPinsArray;

        $('#blackbox').on('change', function() {
            if ($(this).prop('checked')) {
                chargingPinsArray = $('.charging-pins-array').detach();
            } else {
                $('.charging-pins-container').append(chargingPinsArray);
            }
        });
    });
</script>
@endpush
