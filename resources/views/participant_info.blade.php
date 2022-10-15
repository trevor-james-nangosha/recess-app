@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
  <div class="col-md-12">
    {{-- <div class="card ">

      <div class="card-body">
        <div class="table-responsive">

        </div>
      </div>
    </div> --}}

    <h1>{{$participant[0]->name}}</h1>
  </div>

</div>
@endsection

{{-- //TODO --}}
{{-- add some more stuff on this page. --}}
{{-- make the description of the participant look better. --}}
