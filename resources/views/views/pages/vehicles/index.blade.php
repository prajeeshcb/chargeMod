@extends('layouts.app')
@section('title', 'Vehicles')

@section('header')
    <h1 class="page-title">Vehicles</h1>
    <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="{{ route('vehicles.create') }}">
            <i class="icon fa-plus" aria-hidden="true"></i>
            <span class="text hidden-sm-down">Create Vehicle</span>
        </a>
    </div>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-vehicles" class="form-inline mb-0">
                <div class="form-group">
                    <label class="sr-only" for="inputUnlabelUsername">Search</label>
                    <input id="search-query" type="text" class="form-control w-full" placeholder="Search..." autocomplete="off">
                </div>

                {{--<div class="form-group">--}}
                    {{--<label class="sr-only1 mr-2 " for="role">Manufacturer: </label>--}}
                    {{--<select id="manufactures" name="manufactures" class="form-control" >--}}
                        {{--<option value="">All</option>--}}
                        {{--@foreach($manufactures as $manufacturer)--}}
                        {{--<option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                @component('components.select-manufacturer')
                @endcomponent
                <div class="form-group">
                    <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-vehicles'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush

@push('scripts')
<script>
    $(function() {
        var $table = $('#tbl-vehicles');

        $table.on('preXhr.dt', function ( e, settings, data ) {
            data.filter = {
                q: $('#search-query').val(),
                manufacturers: $('#manufactures').val()
            };
        });

        $('#form-filter-vehicles').submit(function(e) {
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
