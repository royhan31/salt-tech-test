@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if($errors->all())
          <div class="alert alert-danger" role="alert">
            Failed order product
          </div>
          @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">Product Page</div>
                    <form class="" action="{{route('product.store')}}" method="post">
                      @csrf
                        <div class="row justify-content-center">
                          <div class="col-md-12 mb-3">
                            <textarea type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" placeholder="product" required autofocus>{{old('product_name')}}</textarea>
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-md-12 mb-3">
                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" value="" placeholder="Shipping address" required>{{old('shipping_address')}}</textarea>
                            @error('shipping_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-md-12 mb-5">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}" placeholder="Price" required/>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-md-8">
                            <button type="submit" class="btn btn-primary btn-block" name="button">Submit</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
