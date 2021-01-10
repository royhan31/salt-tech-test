@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if($errors->all() || Session::has('failed'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('failed') ?? 'Failed order prepaid balance'}}
          </div>
          @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3"><h4>Prepaid Balance</h4></div>
                    <form class="" action="{{route('balance.store')}}" method="post">
                      @csrf
                      <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                          <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" minLength="7" maxlength="12" name="mobile_number" value="{{old('mobile_number')}}" placeholder="Mobile Numbe (081)" required autofocus/>
                          @error('mobile_number')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                          <select class="form-control" name="value" required>
                            <option value="">Enter Your Value</option>
                            <option value="10000" {{old('value') == 10000 ? 'selected' : ''}}>10.000</option>
                            <option value="50000" {{old('value') == 50000 ? 'selected' : ''}}>50.000</option>
                            <option value="100000" {{old('value') == 100000 ? 'selected' : ''}}>100.000</option>
                          </select>
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
