@extends('layouts.app')

@section('title', 'Charging Activities')

@section('header')
    <h1 class="page-title">Charging Activities</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-shadow card-inverse bg-green-600 white">
                <div class="card-block p-10">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div><a class="text-white">TOTAL ENERGY (KW)</a></div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number"><b><span id="total-energy"></span></b> KW</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-shadow card-inverse bg-blue-600 white">
                <div class="card-block p-10">
                    <div class="counter counter-lg counter-inverse text-left">
                        <div class="counter-label mb-20">
                            <div><a class="text-white">TOTAL DURATION</a></div>
                        </div>
                        <div class="counter-number-group mb-15">
                            <span class="counter-number"><b><span id="total-duration"></span></b></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body bg-grey-100">
            <div class="row">
                <div class="col-md-12">
                    <form id="form-filter-charging-activities" class="form-inline mb-0">
                        <div class="form-group">
                            <label class="sr-only" for="search">Search</label>
                            <input id="search" type="text" class="form-control w-full" placeholder="Search" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select id="station" class="form-control select2-hidden-accessible" data-plugin="select2" data-placeholder="Station" data-allow-clear="true" tabindex="-1" aria-hidden="true" style="width: 200px">
                                <option></option>
                                @foreach(\App\Models\Station::getStations() as $station)
                                    <option value="{{ $station->id }}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-daterange" data-plugin="datepicker">
                                <input id="start" type="text" class="form-control mr-2" placeholder="Charged From" autocomplete="off">
                                <input id="end" type="text" class="form-control ml-2" placeholder="Charged To" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="btn-search" type="submit" class="btn btn-primary btn-outline">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-charging-activities'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}

    <script>
        $(function() {
            let totalEnergy = $('#total-energy');
            let totalDuration = $('#total-duration');

            $.ajax({
                url: '{{ url('charging-activities/scope-of-station') }}'
            }).done(function(response){
                totalEnergy.text(response.total_energy);
                totalDuration.text(response.total_duration);
            });

            let $table = $('#tbl-charging-activities');

            $table.on('preXhr.dt', function(e, settings, data) {
                data.filter = {
                    search: $('#search').val(),
                    station: $('#station').val(),
                    start: $('#start').val(),
                    end: $('#end').val()
                }
            });

            $('#form-filter-charging-activities').submit(function(e) {
                e.preventDefault();
                $table.DataTable().draw();

                $.ajax({
                    url: '{{ url('charging-activities/scope-of-station') }}',
                    data: {
                        station: $('#station').val(),
                        start: $('#start').val(),
                        end: $('#end').val()
                    }
                }).done(function(response){
                    totalEnergy.text(response.total_energy);
                    totalDuration.text(response.total_duration);
                });
            });

            setInterval(function(){
                $table.DataTable().draw();
            },15000);
        });
    </script>
@endpush
