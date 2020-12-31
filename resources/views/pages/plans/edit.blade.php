@extends('layouts.app')

@section('title', 'Plans')

@section('header')
    <h1 class="page-title">Edit Plan</h1>
@endsection

@section('content')
    <div class="panel">
        <form id="form-edit-plan" method="POST" action="{{ route('plans.update', $plan->id) }}">
            @csrf
            @method('PUT')
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       placeholder="Name" value="{{ $plan->name }}"
                                       autocomplete="off">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price</label>
                            <div class="col-md-9">
                                <input id="price" name="price" type="text"
                                       class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                       placeholder="Price" value="{{ $plan->price }}"
                                       autocomplete="off">
                                @if($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Duration</label>
                            <div class="col-md-9">
                                <input id="duration" name="duration" type="text"
                                       class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}"
                                       placeholder="Duration" value="{{ $plan->duration }}"
                                       autocomplete="off">
                                @if($errors->has('duration'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Energy</label>
                            <div class="col-md-9">
                                <input id="energy" name="energy" type="text"
                                       class="form-control {{ $errors->has('energy') ? 'is-invalid' : '' }}"
                                       placeholder="Energy" value="{{ $plan->energy }}"
                                       autocomplete="off">
                                @if($errors->has('energy'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('energy') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="topup">Top-Up?</label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-warning">
                                    <input id="topup" name="topup" type="checkbox" @if($plan->is_topup == 1) checked @endif>
                                    <label></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="status">Status</label>
                            <div class="col-md-9">
                                <div class="checkbox-custom checkbox-warning">
                                    <input id="status" name="status" type="checkbox" @if($plan->status == 1) checked @endif>
                                    <label></label>
                                </div>
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
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#form-edit-plan').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100
                    },
                    price: {
                        required: true,
                        maxlength: 8,
                        number: true
                    },
                    duration: {
                        required: true,
                        maxlength: 8,
                        digits: true
                    },
                    energy: {
                        required: true,
                        maxlength: 8,
                        number: true
                    },
                }
            });

            $('#topup').change(function() {
                if(this.checked) {
                    $('#duration').attr('disabled', 'disabled');
                    $('#duration').val('');
                } else {
                    $('#duration').removeAttr('disabled');
                }
            });

            @if($plan->is_topup == 1)
                $('#duration').attr('disabled', 'disabled');
                $('#duration').val('');
            @endif
        });
    </script>
@endpush
