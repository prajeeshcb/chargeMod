@extends('layouts.app')

@section('title', 'Subscriptions')

@section('header')
    <h1 class="page-title">Subscriptions</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <div class="row">
                <div class="col-md-9">
                    <form id="form-filter-subscriptions" class="form-inline mb-0">
                        <div class="form-group">
                            <label class="sr-only" for="search">Search</label>
                            <input id="search" type="text" class="form-control w-full" placeholder="Search" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select id="plan" class="form-control select2-hidden-accessible" data-plugin="select2" data-placeholder="Plan" data-allow-clear="true" tabindex="-1" aria-hidden="true" style="width: 200px">
                                <option></option>
                                <optgroup label="Main Plans">
                                    @foreach(\App\Models\Plan::getPlans() as $plan)
                                        @if($plan->is_topup == 0)
                                            <option value="{{ $plan->name }}">{{ $plan->name }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="Top-Up Plans">
                                    @foreach(\App\Models\Plan::getPlans() as $plan)
                                        @if($plan->is_topup == 1)
                                            <option value="{{ $plan->name }}">{{ $plan->name }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-daterange" data-plugin="datepicker">
                                <input id="start" type="text" class="form-control mr-2" placeholder="Recharged From" autocomplete="off">
                                <input id="end" type="text" class="form-control ml-2" placeholder="Recharged To" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="btn-search" type="submit" class="btn btn-primary btn-outline">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 text-right">
                    <button id="btn-add-energy" class="btn btn-success">ADD ENERGY</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-subscriptions'], true) !!}
        </div>
    </div>

    <div class="modal fade" id="modal-users" aria-labelledby="modal-users-label" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <form class="modal-content" id="form-add-energy" method="POST" action="{{ route('subscriptions.store') }}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="modal-users-label">ADD ENERGY</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="user">User</label>
                            <select id="user" name="user" class="form-control select2-hidden-accessible station" data-plugin="select2" data-placeholder="Choose a user" tabindex="-1" aria-hidden="true">
                                <option></option>
                                @foreach(\App\Models\User::getAll() as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name . ' (' . $user->phone . ')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="energy">Energy (KW)</label>
                            <input id="energy" type="text" class="form-control" name="energy" placeholder="Energy (KW)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group text-center">
                            <button type="submit" class="btn btn-success">ADD</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}

    <script>
        $(function() {
            let $table = $('#tbl-subscriptions');

            $table.on('preXhr.dt', function(e, settings, data) {
                data.filter = {
                    search: $('#search').val(),
                    plan: $('#plan').val(),
                    start: $('#start').val(),
                    end: $('#end').val()
                }
            });

            $('#form-filter-subscriptions').submit(function(e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-add-energy').click(function() {
                $('#modal-users').modal('toggle');
            });

            $('#form-add-energy').validate({
                rules: {
                    user: {
                        required: true
                    },
                    energy: {
                        required: true
                    }
                }
            });
        });
    </script>
@endpush
