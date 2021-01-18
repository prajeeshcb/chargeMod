@extends('layouts.app')
@section('title', 'Promo Codes')

@section('header')
    <h1 class="page-title">Promo Codes</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ route('promo-codes.create') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Create Promo Code</span>
        </a>
    </div>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-promocodes" class="form-inline mb-0">
                <div class="form-group">
                    <label class="sr-only" for="inputUnlabelUsername">Search</label>
                    <input id="search-query" type="text" class="form-control w-full" placeholder="Search..." autocomplete="off">
                </div>
                <div class="form-group">
                    {{--<label class="sr-only1 mr-2 " for="role">Start: </label>--}}
                    <input id="start_at" data-plugin="datepicker" name="start_at" type="text"
                           class="form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}"
                           placeholder="Start At" value="{{ old('start_at') }}"
                           autocomplete="off">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('start_at') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    {{--<label class="sr-only1 mr-2 " for="role">End: </label>--}}
                    <input id="end_at" data-plugin="datepicker" name="end_at" type="text"
                           class="form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}"
                           placeholder="End At" value="{{ old('end_at') }}"
                           autocomplete="off">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('end_at') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-promocodes'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush

@push('scripts')
<script>
    $(function() {
        var $table = $('#tbl-promocodes');

        $table.on('preXhr.dt', function ( e, settings, data ) {
            data.filter = {
                q: $('#search-query').val(),
                start_at: $('#start_at').val(),
                end_at: $('#end_at').val()
            };
        });

        $('#form-filter-promocodes').submit(function(e) {
            e.preventDefault();
            $table.DataTable().draw();
        });

        $table.on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var url = this.href;

            var ladda = Ladda.create(this);
            ladda.start();
            alertify.okBtn("Delete");
            alertify.confirm("Are you sure?", function () {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json' /*,
                     global: false */ // set false to disable global event handler
                }).done(function(data, textStatus, jqXHR ) {
                    $table.DataTable().draw();
                }).fail(function(jqXHR, textStatus, errorThrown ) {

                }).always(function() {
                    ladda.stop();
                });
            }, function () {
                ladda.stop();
            });
        });
    })
</script>
@endpush
