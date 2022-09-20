@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shop') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('checkoutpost') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('laptop') }}</label>

                            <div class="col-md-6">
                                <label for="quantity">quantity</label>
                                <input id="quantity" type="number" class="form-control" name="quantity" >
                                <button class="btn-cart">ADD TO CART</button>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('mouse') }}</label>

                            <div class="col-md-6">
                                <label for="quantity">quantity</label>
                                <input id="quantity" type="number" class="form-control" name="quantity" >
                                <button class="btn-cart">ADD TO CART</button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('fitbit') }}</label>

                            <div class="col-md-6">
                                <label for="quantity">quantity</label>
                                <input id="quantity" type="number" class="form-control" name="quantity" >
                                <button class="btn-cart">ADD TO CART</button>
                                </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('cabinet') }}</label>

                            <div class="col-md-6">
                                <label for="quantity">quantity</label>
                                <input id="quantity" type="number" class="form-control" name="quantity" >
                                <button class="btn-cart">ADD TO CART</button>
                                </div>
                        </div>




                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Checkout') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- this will point to the /public folder --}}
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush


