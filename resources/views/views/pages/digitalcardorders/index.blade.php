@extends('layouts.app')
@section('title', 'Digital Card Orders')

@section('header')
    <h1 class="page-title">Digital Card Orders </h1>
@endsection

@section('content')
    {{--<h2>Admins</h2>--}}
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-filter-digitalcard-order" class="form-inline mb-0">

                @component('components.select-user')
                @endcomponent
                <div class="form-group">
                    <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-digital-card-order'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush

@push('scripts')
<script>
    $(function() {
        var $table = $('#tbl-digital-card-order');

        $table.on('preXhr.dt', function ( e, settings, data ) {
            data.filter = {
                q: $('#search-query').val(),
                user:$('#users').val()
            };
        });

        $('#form-filter-digitalcard-order').submit(function(e) {
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
