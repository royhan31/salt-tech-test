@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(Session::has('errors'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('errors') }}
          </div>
          @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3"><h4>Pay your order</h4></div>
                    <form action="{{route('order.update', $order)}}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="row justify-content-center">
                        <div class="col-md-8 mb-3">
                          <input type="text" class="form-control" name="phone" value="{{$order->order_number}}" placeholder="Order no." readonly/>
                        </div>
                        <div class="col-md-8">
                          <button type="submit" class="btn btn-primary btn-block" name="button">Pay Now</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
