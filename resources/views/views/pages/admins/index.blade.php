@extends('layouts.app')
@section('title', 'Admins')

@section('header')
    <h1 class="page-title">Admins</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ route('admins.create') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Create Admin</span>
        </a>
    </div>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-admins" class="form-inline mb-0">
                <div class="form-group">
                    <label class="sr-only" for="inputUnlabelUsername">Search</label>
                    <input id="search-query" type="text" class="form-control w-full" placeholder="Search..." autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="sr-only1 mr-2 " for="role">Role: </label>
                    <select id="role" name="role" class="form-control">
                        <option value="">All</option>
                        <option value="1">Owner</option>
                        <option value="2">Admin</option>
                        <option value="3">Manager</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="sr-only1 mr-2" for="status">Status: </label>
                    <select id="status" name="status" class="form-control">
                        <option>All</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-admins'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush

@push('scripts')
<script>
    $(function() {
        var $table = $('#tbl-admins');

        $table.on('preXhr.dt', function ( e, settings, data ) {
            data.filter = {
                q: $('#search-query').val(),
                role: $('#role').val(),
                status: $('#status').val()
            };
        });

        $('#form-filter-admins').submit(function(e) {
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
