@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h2 class="card-title"> Participants</h2>
        <h6 class="card-title"> Get to know the participants better. click on their names to read more.</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  Participant name
                </th>
                <th>
                  Email
                </th>
                <th>
                  Date of Birth
                </th>
                <th class="text-center">
                  Products interested in
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach($participants as $participant)
                        <tr>
                            <td>
                                <a href="/about/participants/{{$participant->id}}">{{$participant->name}}</a>
                            </td>
                            <td>
                                {{$participant->email}}
                            </td>
                            <td>
                                {{$participant->dateOfBirth}}
                            </td>
                            <td class="text-center">
                                {{$participant->kind}}
                            </td>
                        </tr>


                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="col-md-12">
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
</div> --}}
@endsection
