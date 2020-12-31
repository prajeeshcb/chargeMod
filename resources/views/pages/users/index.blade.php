@extends('layouts.app')
@section('title', 'Users')

@section('header')
    <h1 class="page-title">Users</h1>

@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-users" class="form-inline mb-0">
                <div class="form-group">
                    <label class="sr-only" for="inputUnlabelUsername">Search</label>
                    <input id="search-query" type="text" class="form-control w-full" placeholder="Search..." autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="sr-only1 mr-2 " for="role">Start: </label>
                    <input id="start_at" data-plugin="datepicker" name="start_at" type="text"
                           class="form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}"
                           placeholder="Start At" value="{{ old('start_at') }}"
                           autocomplete="off">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('start_at') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="sr-only1 mr-2 " for="role">End: </label>
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
            {!! $html->table(['id' => 'tbl-users'], true) !!}
        </div>
    </div>

    <div class="modal fade" id="modal-station" aria-labelledby="modal-station-label" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <form class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="modal-station-label">STATION</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <select class="form-control select2-hidden-accessible station" data-plugin="select2" data-placeholder="Choose a station" tabindex="-1" aria-hidden="true">
                                <option></option>
                                @foreach(\App\Models\Station::getStations() as $station)
                                    <option value="{{ $station->id }}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="card border">
                                <div class="card-block bg-white p-20">
                                    <button type="button" class="btn btn-floating btn-sm btn-warning">
                                        <i class="fa-plug"></i>
                                    </button>
                                    <span class="ml-15 font-weight-400">AVAILABLE PINS</span>
                                    <div class="content-text text-center mb-0">
                                        <span class="font-size-40 font-weight-100 pin-count">0</span>
                                        <input id="user-id" type="hidden">
                                        <input id="station-id" type="hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group text-center">
                            <button class="btn btn-success modal-btn-start" disabled>START</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush

@push('scripts')
<script>
    $(function() {

        $('#form-filter-users').validate({
            rules: {

                start_at: {
                    required: function(element){
                        return $("#end_at").val()!="";
                    }
                },
                end_at: {
                    required: function(element){
                        return $("#start_at").val()!="";
                    }
                }
            }
        });


        var $table = $('#tbl-users');

        $table.on('preXhr.dt', function ( e, settings, data ) {
            data.filter = {
                q: $('#search-query').val(),
                start_at: $('#start_at').val(),
                end_at: $('#end_at').val()
            };
        });

        $('#form-filter-users').submit(function(e) {
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

        $table.on('click', '.btn-edit', function(e) {
            e.preventDefault();

            var url = this.href;

            var ladda = Ladda.create(this);
            ladda.start();

            var status= $(this).attr('data-status');
            var statuslabel='';
            if(status == 1){
                statuslabel='Activate User';
            }else{
                statuslabel='Inactivate User';
            }

            alertify.okBtn(statuslabel);
            alertify.confirm("Are you sure?", function () {
                $.ajax({
                    url: url,
                    type: 'POST',
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

        $table.on('click', '.a-start', function() {
            $('#modal-station').modal('toggle');
            $('#user-id').val($(this).data('user-id'));
        });

        $table.on('click', '.a-stop', function(e) {
            e.preventDefault();

            let url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'POST'
            }).done(function() {
                $table.DataTable().draw();
                toastr.success('Charging stopped');
            });
        });

        $('.station').on('change', function() {
            let stationID = $(this).val();
            $('#station-id').val(stationID);

            $.ajax({
                url: '{{ url('stations') }}' + '/' + stationID
            }).done(function(response) {
                let pinCount = response.available_pins_count;

                $('.pin-count').text(pinCount);

                if (pinCount > 0) {
                    $('.modal-btn-start').removeAttr('disabled');
                }
            });
        });

        $('#modal-station').on('hidden.bs.modal', function() {
            $('.pin-count').text('0');
            $('.modal-btn-start').attr('disabled', 'disabled');
            $('.station').val('').trigger('change');
        });

        $('.modal-btn-start').click(function(e) {
            e.preventDefault();

            let userID = $('#user-id').val();
            let stationID = $('#station-id').val();

            $.ajax({
                url: '{{ url('charging-activities/start') }}',
                type: 'POST',
                data: {
                    user_id: userID,
                    station_id: stationID
                }
            }).done(function() {
                $('#modal-station').modal('toggle');
                $table.DataTable().draw();
                toastr.success('Charging started');
            });
        });

        setInterval(function(){
            $table.DataTable().draw();
        },15000);
    });
</script>
@endpush
