@extends('layouts.app', ['pageSlug' => 'admin-dashboard', 'page' => 'Admin'])

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Performance</h5>
                            <h2 class="card-title">Total sales(UGX.) per participant</h2>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total points per participant</h5>
                    {{-- <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3> --}}
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Percentage sale of posted products</h5>
                    {{-- <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3> --}}
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Number of return purchases</h5>
                    {{-- <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3> --}}
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        {{-- <div class="col-lg-6 col-md-12"> --}}
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Participants table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Participant ID.
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th class="text-center">
                                        Total Sales(UGX.)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participants as $participant)
                                    <tr>
                                        <td>
                                        {{$participant->id}}
                                        </td>
                                        <td>
                                        {{$participant->email}}
                                        </td>
                                        <td>
                                        {{$participant->name}}
                                        </td>
                                        <td class="text-center">
                                        NULL
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
                <div class="card-header">
                    <h4 class="card-title">Customers table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Customer name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Shipping address
                                    </th>
                                    <th class="text-center">
                                        Most purchased product.
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>
                                    {{$customer->name}}
                                    </td>
                                    <td>
                                    {{$customer->email}}
                                    </td>
                                    <td>
                                    {{$customer->shippingAddress}}
                                    </td>
                                    <td class="text-center">
                                    NULL
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
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
            // fetch the data then initialise the page charts.
            // provide some arguments to the initDashboard() function
            fetch('/data/dashboard/charts')
                .then(response => response.json())
                .then(data => {
                    let participants = []
                    let sales = []

                    let salesParticipants = []
                    let totalPoints = []

                    let percentParticipants = []
                    let totalPosted = []
                    let totalSold = []
                    let percentages = []

                    let returnParticipants = []
                    let returnPurchases = []

                    for(let item of data[0]){
                        if(participants.indexOf(item.name) === -1){
                            participants.push(item.name)
                            if(item.totalAmount === null){
                                sales.push(0)
                            }
                            else{
                                sales.push(item.totalAmount)
                            }
                        }else if(participants.indexOf(item.name) !== -1){
                            sales[participants.indexOf(item.name)] += item.totalAmount;
                        }
                    }

                    for(let item of data[1]){
                        if(salesParticipants.indexOf(item.name) === -1){
                            salesParticipants.push(item.name)
                            if(item.numberOfPoints === null){
                                totalPoints.push(0)
                            }
                            else{
                                totalPoints.push(item.numberOfPoints)
                            }
                        }else if(salesParticipants.indexOf(item.name) !== -1){
                            totalPoints[salesParticipants.indexOf(item.name)] += item.numberOfPoints;
                        }
                    }

    // ---------------------------------------------------------------------------------------------------------------------------
                    for(let item of data[2]){
                        if(percentParticipants.indexOf(item.name) === -1){
                            percentParticipants.push(item.name)
                            if(item.totalQuantityPosted === null){
                                totalPosted.push(0)
                            }
                            else{
                                totalPosted.push(item.totalQuantityPosted)
                            }
                        }else if(percentParticipants.indexOf(item.name) !== -1){
                            totalPosted[percentParticipants.indexOf(item.name)] += item.totalQuantityPosted;
                        }
                    }

                    for(let item of data[2]){
                        if(percentParticipants.indexOf(item.name) === -1){
                            percentParticipants.push(item.name)
                            if(item.totalQuantitySold === null){
                                totalSold.push(0)
                            }
                            else{
                                totalSold.push(item.totalQuantitySold)
                            }
                        }else if(percentParticipants.indexOf(item.name) !== -1){
                            if(item.totalQuantitySold === null){
                                totalSold[percentParticipants.indexOf(item.name)] = 0;
                            }else if(item.totalQuantitySold !== null){
                                if(totalSold[percentParticipants.indexOf(item.name)] !== null){
                                    totalSold[percentParticipants.indexOf(item.name)] = item.totalQuantitySold;
                                }else{
                                    totalSold[percentParticipants.indexOf(item.name)] = item.totalQuantitySold;
                                }
                            }
                        }
                    }

                    //the percentages part
                    for (let index = 0; index < totalSold.length; index++) {
                        result = (totalSold[index]/totalPosted[index])*100
                        if(!isNaN(result)){
                            percentages[index] = result
                        }else{
                            percentages[index] = 0
                        }
                    }

    // some issues for now
    // -----------------------------------------------------------------------------------------------------------------------

                    for (let item of data[3]) {
                        if(returnParticipants.indexOf(item.name) === -1){
                            returnParticipants.push(item.name)
                            if(item.numberOfTimes === null){
                                returnPurchases.push(0)
                            }
                            else{
                                returnPurchases.push(item.numberOfTimes - 1)
                            }
                        }else if(returnParticipants.indexOf(item.name) !== -1){
                            if(item.numberOfTimes === null){
                                continue
                            }else{
                                returnPurchases[returnParticipants.indexOf(item.name)] += item.numberOfTimes - 1;
                            }
                        }
                        // TODO;
                        // fix bugs for return purchases logic

                    }

                    demo.initDashboardPageCharts(participants, sales, salesParticipants, totalPoints, percentParticipants, percentages, returnParticipants, returnPurchases);
                })
        });
    </script>
@endpush

{{-- //TODO; --}}
{{-- edit my dtabase logic so that all participants MUST have products
update the checkoutController to cater for the new additional fields in the products table
fix my points awarding logic --}}
