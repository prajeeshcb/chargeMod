@extends('layouts.app')
@section('title', 'Users')

@section('header')
    <h1 class="page-title">QR Codes</h1>
    <div class="page-header-actions">
        <button type="button" class="btn btn-primary btn-round btn-sm" data-toggle="modal"
                data-target="#exampleModal" data-whatever="@mdo">Generate</button>
    </div>

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
                    <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            {!! $html->table(['id' => 'tbl-users'], true) !!}
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="form-generate-qr-code" action="{{route('qr-code.store')}}" >
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Generate QR Code</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Count</label>
                                <input name="count" type="text" class="form-control" id="count">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save & Download</button>
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

        $('#form-generate-qr-code').validate({
            rules: {

                count: {
                    required: true,
                    number: true
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
    })
</script>
@endpush
