@extends('layouts.app', ['page' => __('Home'), 'pageSlug' => 'home'])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('ANKA BUSINESS SUPPORT SERVICES') }}</h1>
                        <h3 class="text-lead text-light">{{ __('Welcome!!!!!!!') }}</h3>

                        <p>
                            Best participant: {{$bestParticipant[0]->name}}
                        </p>
                        <p>
                            Points: {{$bestParticipant[0]->numberOfPoints}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
