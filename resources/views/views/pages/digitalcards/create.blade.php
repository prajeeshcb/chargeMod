@extends('layouts.app')
@section('title', 'Digital Card')

@section('header')
    <h1 class="page-title">New Digital Card</h1>
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
        <form id="form-digitalcard-create" method="POST" action="{{ route('digital-cards.store') }}">
            @csrf
            <div class="panel-body pt-40">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Number<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="number" name="number" type="text"
                                       class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}"
                                       placeholder="Number" value="{{ old('number') }}"
                                       autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">cost<span class="required">*</span> </label>
                            <div class="col-md-9">
                                <input id="cost" name="cost" type="text"
                                       class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}"
                                       placeholder="Cost" value="{{ old('cost') }}"
                                       autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">{{ $errors->first('cost') }}</span>
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

        $('#form-digitalcard-create').validate({
            rules: {

                number: {
                    required: true
                },
                cost: {
                    required: true
                }
            }
        });

        $('#btn-reset').click(function() {
            $('#role').val("").trigger('change');
            $('#form-digitalcard-create').resetForm();
        });


    });
</script>
@endpush