@extends('layouts.app')

@section('title', 'Payments')

@section('header')
    <h1 class="page-title">Payments</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-payments" class="form-inline mb-0">
                <div class="form-group">
                    <label class="sr-only" for="search">Search</label>
                    <input id="search" type="text" class="form-control w-full" placeholder="Search" autocomplete="off">
                </div>
                <div class="form-group">
                    <button id="btn-search" type="submit" class="btn btn-primary btn-outline">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-payments'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}

    <script>
        $(function() {
            let $table = $('#tbl-payments');

            $table.on('preXhr.dt', function(e, settings, data) {
                data.filter = {
                    search: $('#search').val()
                }
            });

            $('#form-filter-payments').submit(function(e) {
                e.preventDefault();
                $table.DataTable().draw();
            });
        });
    </script>
@endpush
