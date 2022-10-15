@extends('layouts.app', [
    'pageSlug' => 'participant-dashboard',
    'page' => 'Customer',
    'pageOwner' => 'participant'
])

@section('content')



    <div class="row">

        {{-- <div class="col-lg-6 col-md-12"> --}}
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">How your products are performing.</h3>
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
                                        Total quantity sold
                                    </th>

                                    <th >
                                        Total amount(UGX)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($products as $product) --}}
                                    <tr>
                                        <td>
                                            {{-- {{$product->name}} --}}
                                        </td>
                                        <td>
                                            {{-- {{$product->quantityOrdered}} --}}
                                        </td>
                                        <td>
                                         {{-- {{$product->ratePerItem*$product->totalQuantitySold}} --}}
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
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
