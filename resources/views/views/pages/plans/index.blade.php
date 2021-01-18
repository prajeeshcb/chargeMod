@extends('layouts.app')

@section('title', 'Plans')

@section('header')
    <h1 class="page-title">Plans</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ route('plans.create') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Create New Plan</span>
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-plans" class="form-inline mb-0">
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
            {!! $html->table(['id' => 'tbl-plans'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}

    <script>
        $(function() {
            let $table = $('#tbl-plans');

            $table.on('preXhr.dt', function(e, settings, data) {
                data.filter = {
                    search: $('#search').val()
                }
            });

            $('#form-filter-plans').submit(function(e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $table.on('click', '.btn-delete', function(e) {
                e.preventDefault();

                var ladda = Ladda.create(this);
                var url = this.href;

                ladda.start();

                alertify.okBtn('Delete');
                alertify.confirm('Are you sure?', function() {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json'
                    }).done(function(data, textStatus, jqXHR) {
                        $table.DataTable().draw();
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                    }).always(function() {
                        ladda.stop();
                    });
                }, function() {
                    ladda.stop();
                });
            });
        });
    </script>
@endpush
