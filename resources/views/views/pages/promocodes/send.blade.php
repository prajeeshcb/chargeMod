@extends('layouts.app')
@section('title', 'Users')

@section('header')
    <h1 class="page-title">Send Promo Code</h1>


    <form id="form-promo-code-send"  method="POST" action="{{ route('promo-codes.send', $promoCode->id)  }}">
            @csrf
        <input type="hidden" name="selected_users" id="selected_users" class="selected_users">
        <input type="hidden" name="promocode" id="promocode" value="{{ $promoCode->code }}">
        <input type="hidden" name="promocode_start_at" id="promocode_start_at" value="{{ $promoCode->start_at }}">
        <input type="hidden" name="promocode_end_at" id="promocode_end_at" value="{{ $promoCode->end_at }}">
        <input type="hidden" name="promocode_discount_type" id="promocode_discount_type" value="{{ $promoCode->discount_type }}">
        <input type="hidden" name="promocode_discount" id="promocode_discount" value="{{ $promoCode->discount }}">
        <div class="page-header-actions">
            <button id="btn-submit" type="submit" class="btn btn-sm btn-primary btn-round">
                <i class="icon fa-send" aria-hidden="true"></i>Send</button>
        </div>
    </form>

@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <h4>{{$promoCode->title}}</h4>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">Code: <span class="font-weight-500">{{ $promoCode->code }}</span> </div>
                <div class="col-md-3">Start At: <span class="font-weight-500">{{ $promoCode->start_at->toAppDateString() }}</span></div>
                <div class="col-md-3">End At: <span class="font-weight-500">{{ $promoCode->end_at->toAppDateString() }}</span></div>
                <div class="col-md-3">Discount: <span class="font-weight-500">{{ $promoCode->discount_type == \App\Models\PromoCode::DISCOUNT_TYPE_PERCENTAGE ?
                         $promoCode->discount.' %' : $promoCode->discount.' &#8377' }}</span></div>
            </div>
            <span>

            </span>
        </div>
    </div>

    <h4>Selected users</h4>

    <div class="row selected-users">
    </div>

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
            {!! $html->table(['id' => 'tbl-send-promocode'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush

@push('scripts')
<script>
    $(function() {
        var $table = $('#tbl-send-promocode');

        $table.on('preXhr.dt', function ( e, settings, data ) {
            data.filter = {
                q: $('#search-query').val()
            };
        });

        $('#form-filter-users').submit(function(e) {
            e.preventDefault();
            $table.DataTable().draw();
        });


        var selected_users = [];
        $table.on('click', '.btn-add', function(e) {

            var email=$(this).attr('data-email');
            var name=$(this).attr('data-name');
            var image=$(this).attr('data-image');
            var id=$(this).attr('data-id');
            $(".selected-users").append('<div data-id="'+id+'" class="col-md-3 user-block"><div class="card">'+
            '<div class="card-block">'+
            '<div class="media">'+
            '<div class="pr-20">'+
            '<a class="avatar" href="javascript:void(0)">'+
            '<img class="img-fluid" src="'+image+'" alt="...">'+
            '</a>'+
            '</div>'+
            '<div class="media-body">'+
            '<h5 class="mt-0 mb-5">'+name+'</h5>'+
            '<small>'+email+'</small>'+
            '</div>'+
            '<div class="pl-20">'+
            '<button type="button" class="btn btn-close btn-pure btn-default icon wb-close"></button>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>');

            $(this).find('i').removeClass('wb-plus').addClass('wb-check');
            $(this).click(function(){return false;});
            selected_users.push(id);

            selected = $.unique(selected_users);

            $('#selected_users').val(JSON.stringify(selected));
        });

        $('.selected-users').on('click', '.btn-close', function(e) {

            $(this).closest( "div.user-block").remove();
            var id=$(this).closest( "div.user-block").attr('data-id');

            if ((index = selected_users.indexOf(id)) !== -1) {

                 selected_users.splice(index, 1);
             }
             selected = $.unique(selected_users);
             $('#selected_users').val(JSON.stringify(selected));
        });

        $('#form-promo-code-send').submit(function(e) {
            if ($('.user-block').find('.card-block').length > 0) {
                $('#form-promo-code-send').submit();
            } else {
                e.preventDefault();
                alert('Please select at least 1 user');
            }
        });
    })
</script>

@endpush
