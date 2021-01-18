@extends('layouts.app')
@section('title', 'Digital Card Order Items')

@section('header')
    <h1 class="page-title">Order Details:#{{str_pad($order->id,5,0,STR_PAD_LEFT)}}</h1>
    @if($order->status == \App\Models\DigitalCardOrder::DIGITAL_CARD_PROCESSING)
    <div class="page-header-actions">

        <form method="post" name="shipped"  class="form-inline mb-0" action="{{route('digital-card-orders.shipped', $order->id)}}">
            @csrf
            <div class="form-group">
                <button  type="submit" class="btn btn-sm btn-primary btn-round">Mark as Shipped</button>
            </div>
        </form>
    </div>
    @endif
@endsection

@section('content')
    <div class="panel">
        <div class="card-body bg-grey-100">
            <div class="card-block row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2">
                            <h4 class="card-title">Order Number</h4>
                            <p>{{str_pad($order->id,5,0,STR_PAD_LEFT)}}</p>
                        </div>
                        <div class="col-md-2">
                            <h4 class="card-title">User</h4>
                            <p>{{$order->user->name}}</p>
                        </div>

                        <div class="col-md-2">
                            <h4 class="card-title">Quantity</h4>
                            <p>{{$order->quantity}}</p>
                        </div>

                        <div class="col-md-3">
                            <h4 class="card-title">Address</h4>
                            <p>{{$order->street1.', '.$order->street2.', '
                    .$order->city.', '.$order->state.', '.$order->country}}</p>
                        </div>

                        <div class="col-md-3">
                            <h4 class="card-title">Status</h4>
                            @if($order->status==\App\Models\DigitalCardOrder::DIGITAL_CARD_NEW)
                                <p>New</p>
                            @elseif($order->status==\App\Models\DigitalCardOrder::DIGITAL_CARD_PROCESSING)
                                <p>Processing</p>
                            @elseif($order->status==\App\Models\DigitalCardOrder::DIGITAL_CARD_SHIPPED)
                                <p>Shipped</p>

                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div>
            <form id="form-attach-card" method="POST" action="{{ route('digital-card-orders.store') }}">
            <input name="order_id" type="hidden" value="{{$id}}">
            @csrf
            <div class="panel-body pt-40">
                @if($order->status == \App\Models\DigitalCardOrder::DIGITAL_CARD_NEW)
                    <h4 class="card-title">Attach Card</h4>
                    <div class="row">
                        <div class="col-md-8 col-lg-6">
                            @for($i=1;$i<=$order->quantity;$i++)
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">{{$i}}.</label>
                                <div class="col-md-9">
                                    <select  name="cards[]"  data-plugin="select2"
                                            class="form-control{{ $errors->has('cards') ? ' is-invalid' : '' }}">
                                        <option value=""></option>
                                        @foreach($cards as $card)
                                            <option value="{{$card->id}}">{{$card->number}}</option>
                                       @endforeach
                                    </select>
                                    @if ($errors->has('cards'))
                                        <span class="invalid-feedback" role="alert">{{ $errors->first('cards') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                @else
                    <h4 class="card-title">Cards</h4>
                    <div class="row">
                        @foreach($order_items as $order_item)

                        <div class="col-md-3 col-lg-3 ">
                            <div class="card card-block card border border-primary">
                                <blockquote class="blockquote cover-quote card-blockquote">
                                    <div class="row">
                                        <div class="col-md-8">#{{str_pad($order_item->digitalcard->number,5,0,STR_PAD_LEFT)}}</div>
                                        @if($order_item->digitalcard->status == \App\Models\DigitalCard::DIGITAL_CARD_ACTIVATED)
                                            <div class="col-md-4 pull-right"><span class="badge badge-success mr-5 mb-5">Success</span> </div>
                                         @endif
                                    </div>
                                    <footer>
                                        <small class="text-muted">
                                            <b>{{$order->user->name}}</b>
                                            {{--<cite title="Source Title text-right"><p>ChargeMod PVT LTD</p></cite>--}}
                                        </small>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    @endif

            </div>
            <hr/>
            @if($order->status == \App\Models\DigitalCardOrder::DIGITAL_CARD_NEW)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-9">
                        <button id="btn-submit" type="submit" class="btn btn-primary">Save</button>
                        {{--<button id="btn-reset" type="reset" class="btn btn-default btn-outline">Reset</button>--}}
                    </div>
                </div>
            </div>
                @endif
        </form>


    </div>
</div>
@endsection

@push('scripts')



</script>
@endpush
