@extends('layouts.telecaller')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Dashboard {{Auth::user()->name}}</h4>
      <h4 class="mb-3 mb-md-0">This is a telecaller portal.</h4>

    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control">
      </div>
    </div>
    
</div>
<div class="card mb-2">
  <div class="card-body">
      <h5 class="card-title"><i class="mdi mdi-calendar" style="font-size: 20px;"></i> Calender</h5>
      <h6 class="card-subtitle mb-2 text-muted">Office calender</h6>
      <p class="card-text">View what is happening in our office, events, celeberations,..etc.</p>
      <a href="{{route('telecaller.calender')}}" class="card-link">Visit.</a>
  </div>
</div>

<div class="card mb-2">
  <div class="card-body">
      <h5 class="card-title"><i class="mdi mdi-link-variant" style="font-size: 20px;"></i> Assigned leads</h5>
      <h6 class="card-subtitle mb-2 text-muted">See the leads assigned to you.</h6>
      <p class="card-text">You can see the leads assigned to you and update the status of the lead.</p>
      <a href="{{route('telecaller.assigned')}}" class="card-link">View your leads.</a>
  </div>
</div>
@endsection
