@extends('layouts.superadmin')

@section('head')
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Dashboard {{Auth::user()->name}}</h4>
      <h4 class="mb-3 mb-md-0">This is a Superadmin portal.</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control">
      </div>
      {{-- <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
        <i class="btn-icon-prepend" data-feather="download"></i>
        Import
      </button>
      <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="printer"></i>
        Print
      </button>
      <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="download-cloud"></i>
        Download Report
      </button> --}}
    </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Number of employees</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$empcn}}</h3>
                <div class="d-flex align-items-baseline">
                  <a href="{{route('admin.adduser')}}" class="text-success">
                    <span>Click to add a employee.</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </a>
                </div>
              </div>
              {{-- <div class="col-6 col-md-12 col-xl-7">
                <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">No. of leads generated</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{ $leadscn }}</h3>
                <div class="d-flex align-items-baseline">
                  <a href="{{route('admin.addlead')}}" class="text-success">
                    <span>Click to add a new lead.</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </a>
                </div>
              </div>
              {{-- <div class="col-6 col-md-12 col-xl-7">
                <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card- m-0">Leads on follow up</h6>
            <h3 class="mb-2"><span class="text-success">{{ $follow_up }}</span></h3>
            <h6 class="card- m-0">Pending leads</h6>
            <h3 class=""><span class="text-warning">{{ $follow_up }}</span></h3>

            {{-- <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Follow-up and pending leads</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-5">
                  <h3 class="mb-2"><span class="text-success">89.87%</span></h3>
                  <div class="d-flex align-items-baseline">
                  <h6 class="card-title mb-0">Follow-up</h6><br>
                  <h4 class="text-warning">
                    <span>89.87%</span>
                  </h4>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->


<div class="row">
  <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        
        <div class="row">
          <div class="col-xl-12 grid-margin stretch-card">
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
                <div class="card">
                  <div class="card-body">
                      <h6 class="card-title">Leads generated every month.</h6>
                      <div id="leads"></div>
                  </div>
              </div>
              </div>
            </div>
              
          </div>
        </div>
      </div> 
    </div>
  </div>
  
</div>
  
  {{-- <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Cloud storage</h6>
          <div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
            </div>
          </div>
        </div>
        <div id="progressbar1" class="mx-auto"></div>
        <div class="row mt-4 mb-3">
          <div class="col-6 d-flex justify-content-end">
            <div>
              <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase font-weight-medium">Total storage <span class="p-1 ml-1 rounded-circle bg-primary-muted"></span></label>
              <h5 class="font-weight-bold mb-0 text-right">8TB</h5>
            </div>
          </div>
          <div class="col-6">
            <div>
              <label class="d-flex align-items-center tx-10 text-uppercase font-weight-medium"><span class="p-1 mr-1 rounded-circle bg-primary"></span> Used storage</label>
              <h5 class="font-weight-bold mb-0">6TB</h5>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-block">Upgrade storage</button>
      </div>
    </div>
  </div> --}}
</div>


<script>
  $(function() {
  'use strict';
  var options = {
  chart: {
    type: 'bar',
    height: '500',
    parentHeightOffset: 0
  },
  colors: ["#00a326"],
  grid: {
    borderColor: "rgba(0, 255, 240, .1)",
    padding: {
      bottom: 0
    }
  },
  series: [{
    name: 'leads',
    data: [{!! $leads !!}]
  }],
  xaxis: {
    type: 'Months',
    categories: ['January','Feburary','March','April','May','June','July','August','September', 'October', 'November', 'December']
  }
}

var apexBarChart = new ApexCharts(document.querySelector("#leads"), options);

apexBarChart.render();

var options = {
    chart: {
      type: 'bar',
      height: '500',
      parentHeightOffset: 0
    },
    colors: ["#9a6500"],    
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
