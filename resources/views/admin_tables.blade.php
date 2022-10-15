@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Products table</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  Product name
                </th>
                <th>
                  Total quantity sold
                </th>
                <th>
                  Quantity available
                </th>
                <th class="text-center">
                  Rate per item
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                        {{$product->name}}
                        </td>
                        <td>
                            {{$product->totalQuantitySold}}
                        </td>
                        <td>
                            {{$product->quantityAvailable}}
                        </td>
                        <td class="text-center">
                            {{$product->ratePerItem}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card  card-plain">
      <div class="card-header">
        <h4 class="card-title"> Orders</h4>
        <p class="category"> Showing the last 10 orders</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  Date
                </th>
                <th>
                  Product ID
                </th>
                <th>
                  Quantity ordered
                </th>
                <th class="text-center">
                  Total amount
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                        {{$order->date}}
                        </td>
                        <td>
                        {{$order->productID}}
                        </td>
                        <td>
                            {{$order->quantityOrdered}}
                        </td>
                        <td class="text-center">
                            {{$order->totalAmount}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
