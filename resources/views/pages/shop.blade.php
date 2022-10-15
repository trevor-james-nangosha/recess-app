@extends('layouts.app', ['page' => __('Shop'), 'pageSlug' => 'shop'])

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="The shopping page - place your orders">
	<meta name="author" content="">
	<title></title>
	<link rel="favicon" href="assets1/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets1/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets1/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets1/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets1/css/style.css">
	<link rel="stylesheet" href={{'css/app.css'}}>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<script src="assets1/js/html5shiv.js"></script>
	<script src="assets1/js/respond.min.js"></script>
    <script>
        window.User = {
            userID: {{$userID}},
        }
    </script>
</head>

<body>


	<header id="head" class="secondary">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>Products</h1>
				</div>

                <div class="submit-form-div">
                    <form action="" method="POST" class="submit-form-checkout">
                        @csrf
                        <button type="submit" class="checkout-btn">
                            CHECK OUT
                            <i class="tim-icons icon-wallet-43" style="margin-left: 10px"></i>
                        </button>
                    </form>
                </div>
			</div>
		</div>
	</header>


	<section class="container">
		<div class="row-product flat">
            @for ($i = 0; $i < 10; $i++)
                @foreach ($products as $product)
                <div class="card">
                    <ul class="plan plan1" style="list-style: none; ">
                        <li class="plan-price product-name">
                            {{ $product->productName}}
                        </li>
                        <li class="product-description">
                            <p>{{ $product->description}}</p>
                        </li>

                        <li class="product-price">
                            <p>UGX. {{ $product->ratePerItem}}</p>
                        </li>

                        <div class="cart-input-row">
                            <input type="number" class="input-quantity" id="" btn placeholder="">
                            <i class="tim-icons icon-cart btn cart-btn"></i>
                        </div>
                    </ul>
                </div>
                @endforeach
            @endfor

            {{-- @foreach ($products as $product)
                <div class="card card-product">
                    <ul class="plan plan1" style="list-style: none">
                        <li class="plan-price">
                            <strong>Product: </strong>{{ $product->productName}}
                        </li>
                        <li>
                            <strong>Product description</strong><p>{{ $product->description}}</p>
                        </li>
                        <i class="tim-icons icon-cart btn"></i>


                    </ul>
                </div>
            @endforeach --}}
		</div>

	</section>

    <div class="click-addcart-modal">
        <div class="click-addcart-modal-content"></div>
    </div>

    <div class="click-checkout-modal">
        <div class="click-checkout-modal-content"></div>
    </div>



	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets1/js/custom.js"></script>
</body>
</html>

@endsection
@push('js')
    <script src={{'js/cart.js'}}></script>

@endpush

