@extends('layouts.app', ['pageSlug' => 'customer-dashboard', 'page' => 'Customer'])

@section('content')



    <div class="row">

        {{-- <div class="col-lg-6 col-md-12"> --}}
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Recent orders you made.</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Product name
                                    </th>
                                    <th>
                                        Quantity ordered
                                    </th>

                                    <th >
                                        Total amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{$order->name}}
                                        </td>
                                        <td>
                                            {{$order->quantityOrdered}}
                                        </td>
                                        <td>
                                         {{$order->totalAmount}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </div>


    <div class="row">

        {{-- <div class="col-lg-6 col-md-12"> --}}
            <div class="card ">


            </div>
        {{-- </div> --}}
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
@endpush

{{-- //TODO; --}}
{{-- edit my dtabase logic so that all participants MUST have products
update the checkoutController to cater for the new additional fields in the products table
fix my points awarding logic --}}
