@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
          </div>
          @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3"><h4>Order History</h4></div>
                      <form class="" action="{{route('order.search')}}" method="get">
                        <div class="row justify-content-end">
                            <div class="col-md-6 mb-3">
                              <input type="text" class="form-control" name="val" value="{{Request::get('val')}}" placeholder="Search by Order no." />
                            </div>
                        </div>
                    </form>
                    <ul class="list-group">
                      @if($orders->count() < 1)
                        <div class="col-12 mt-5 text-center">
                          <h4>No result Orders</h4>
                        </div>
                      @else
                      @foreach($orders as $order)
                        <li class="list-group-item">
                          <div class="row">
                            <div class="col-8">
                              <p>{{$order->order_number}}
                                <span class="ml-3">{{$order->balance ? $order->balanceTotal() : $order->productTotal()}}</span>
                              </p>
                              <p>
                                @if($order->balance)
                                   {{number_format($order->balance->value, 0,',','.')}} for {{$order->balance->mobile_number}}
                                @else
                                {{$order->product->product_name}} that costs {{$order->product->priceIdr()}}
                                @endif
                              </p>
                            </div>
                            <div class="col-4 mt-3 text-right">
                              @if($order->status === null)
                                <a href="{{route('order.pay', $order)}}" class="btn btn-primary" name="button">Pay Now</a>
                              @elseif(!$order->status && $order->balance)
                                <span class="text-danger">Failed</span>
                              @elseif($order->status && $order->balance)
                                <span class="text-success">Success</span>
                              @elseif(!$order->status && $order->product)
                                <span class="text-danger">Cancaled</span>
                              @elseif($order->status && $order->product)
                                <span class="text-center">
                                  <b>Shipping Code </b>
                                  <br />
                                  <b>{{$order->product->shipping_code}}</b>
                                </span>
                              @endif
                            </div>
                          </div>

                        </li>
                      @endforeach
                      @endif
                    </ul>
                    <div class="row justify-content-center mt-5">
                      <nav aria-label="Page navigation example">
                      {{$orders->links()}}
                      </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
