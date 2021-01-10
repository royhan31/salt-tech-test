@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                      <h4>Success!</h4>
                    </div>
                    <div class="row mb-4">
                      <div class="col-4">
                        Order no.
                      </div>
                      <div class="col-8">
                        <span class="float-right">{{$order->order_number}}<sapn>
                      </div>
                      <div class="col-4">
                        Total
                      </div>
                      <div class="col-8">
                        <span class="float-right">{{$order->balance ? $order->balanceTotal() : $order->productTotal()}}<sapn>
                      </div>
                    </div>
                    {!! $message !!}

                    <div class="row justify-content-center mt-5">
                      <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-block" name="button">Pay Now</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
