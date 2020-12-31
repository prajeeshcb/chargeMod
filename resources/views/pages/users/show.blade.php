@extends('layouts.app')

@section('title', strtoupper($user->fullname))

@section('header')
    <h1 class="page-title">{{ strtoupper($user->fullname) }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-3 text-center">
                    <h4 class="card-title">E-Mail</h4>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <h4 class="card-title">Phone</h4>
                    <p class="card-text">{{ $user->phone }}</p>
                </div>
                <div class="col-md-3 text-center">
                    <h4 class="card-title">Status</h4>
                    <p class="card-text">@if($user->status == 1) Active @else Inactive @endif</p>
                </div>
                <div class="col-md-3 text-center">
                    <h4 class="card-title">Registered Date</h4>
                    <p class="card-text">{{ $user->created_at->toFormattedDateString() }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="col-xl-12">
                <div class="example-wrap m-xl-0">
                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#subscriptionsTab" aria-controls="subscriptionsTab" role="tab" aria-selected="true">Subscriptions</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#activitiesTab" aria-controls="activitiesTab" role="tab" aria-selected="false">Activities</a></li>
                        </ul>
                        <div class="tab-content pt-20">
                            <div class="tab-pane active" id="subscriptionsTab" role="tabpanel">
                                <div class="card-body bg-grey-100">
                                    <form id="form-filter-subscriptions" class="form-inline mb-0">
                                        <div class="form-group">
                                            <label class="sr-only" for="subscriptionSearch">Search</label>
                                            <input id="subscriptionSearch" type="text" class="form-control w-full" placeholder="Search" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <button id="btn-search" type="submit" class="btn btn-primary btn-outline">Search</button>
                                        </div>
                                    </form>
                                </div>
                                {!! $subscriptions->table(['id' => 'tableSubscriptions'], true) !!}
                            </div>
                            <div class="tab-pane" id="activitiesTab" role="tabpanel">
                                <div class="card-body bg-grey-100">
                                    <form id="form-filter-charging-activities" class="form-inline mb-0">
                                        <div class="form-group">
                                            <label class="sr-only" for="chargingActivitySearch">Search</label>
                                            <input id="chargingActivitySearch" type="text" class="form-control w-full" placeholder="Search" autocomplete="off">
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
                                {!! $charging_activities->table(['id' => 'tableChargingActivities'], true) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $subscriptions->scripts() !!}
    {!! $charging_activities->scripts() !!}

    <script>
        $(function() {
            let $tableSubscriptions = $('#tableSubscriptions');

            $tableSubscriptions.on('preXhr.dt', function(e, settings, data) {
                data.filter = {
                    search: $('#subscriptionSearch').val()
                }
            });

            $('#form-filter-subscriptions').submit(function(e) {
                e.preventDefault();
                $tableSubscriptions.DataTable().draw();
            });

            let $tableChargingActivities = $('#tableChargingActivities');

            $tableChargingActivities.on('preXhr.dt', function(e, settings, data) {
                data.filter = {
                    search: $('#chargingActivitySearch').val(),
                    station: $('#station').val(),
                    start: $('#start').val(),
                    end: $('#end').val()
                }
            });

            $('#form-filter-charging-activities').submit(function(e) {
                e.preventDefault();
                $tableChargingActivities.DataTable().draw();
            });
        });
    </script>
@endpush
