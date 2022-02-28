@extends('layouts.salesmanager')

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
      <h4 class="mb-3 mb-md-0">This is Salesmanager portal.</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control">
      </div>
    </div>
</div>
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Number of Latest Lead's</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5 ">
                <h3 class="mb-2">{{$lead_status}}</h3>
                <div class="d-flex align-items-baseline">
                  <a href="{{route('salesexecutive.assigned')}}" class="text-success">
                    <span>View todays leads.</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </a>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7 mt-2" style="position: absolute; left: 36vw; top:0px;">
                {{-- <div id="apexChart2" class="mt-md-3 mt-xl-0"></div> --}}
                <div class="spinner-grow text-danger" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">No. of leads generated</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">3,084</h3>
                <div class="d-flex align-items-baseline">
                  <a href="{{route('admin.addlead')}}" class="text-success">
                    <span>Click to add a new lead.</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </a>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                {{-- <div id="apexChart2" class="mt-md-3 mt-xl-0"></div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->
  

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Status per lead.</h6>
            <div id="perlead"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Leads generated every month.</h6>
            <div id="manual"></div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
  'use strict';
// manualleads

var options = {
  chart: {
    type: 'bar',
    height: '500',
    parentHeightOffset: 0
  },
  colors: ["#FF2E2E"],
  grid: {
    borderColor: "rgba(0, 255, 240, .1)",
    padding: {
      bottom: 0
    }
  },
  series: [{
    name: 'leads',
    data: [{!! "'".$leads."'" !!}]
  }],
  xaxis: {
    type: 'Months',
    categories: ['January','Feburary','March','April','May','June','July','August','September', 'October', 'November', 'December']
  }
}

var apexBarChart = new ApexCharts(document.querySelector("#manual"), options);
apexBarChart.render();

// Apex Bar chart start
var options = {
    chart: {
      type: 'bar',
      height: '500',
      parentHeightOffset: 0
    },
    colors: ["#f77eb9"],    
    grid: {
      borderColor: "rgba(77, 138, 240, .1)",
      padding: {
        bottom: 0
      }
    },
    series: [{
      name: 'sales',
      data: [{!! "'".$per_status_lead."'" !!}]
    }],
    xaxis: {
      type: 'status',
      categories: [{!! "'".$status."'" !!}]
    }
  }
  
  var apexChart = new ApexCharts(document.querySelector("#perlead"), options);
  
  apexChart.render();

});
</script>
@endsection
