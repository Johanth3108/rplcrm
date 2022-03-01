@extends('layouts.salesexecutive')

@section('content')
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
                  <div class="spinner-grow text-primary" role="status">
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

// perlead
apexBarChart.render();

//   property 

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
      type: 'sales',
      categories: [{!! "'".$per_prop."'" !!}]
    }
  }
  
  var property = new ApexCharts(document.querySelector("#perlead"), options);
  
  property.render();
});
</script>
{{-- 
<div class="card mb-2">
    <div class="card-body">
      <h5 class="card-title"><i class="mdi mdi-message-reply-text" style="font-size: 20px;"></i> Message </h5>
      <h6 class="card-subtitle mb-2 text-muted">Send bulk messages.</h6>
      <p class="card-text">You can send bulk messages for promotions and to gain leads.</p>
      <a href="{{route('salesexecutive.message')}}" class="card-link">Send now.</a>
    </div>
</div>

<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-whatsapp" style="font-size: 20px;"></i> Whatsapp</h5>
        <h6 class="card-subtitle mb-2 text-muted">Send bulk whatsapp messages.</h6>
        <p class="card-text">You can send bulk whatsapp messages for promotions and to gain leads through social media.</p>
        <a href="{{route('salesexecutive.whatsapp')}}" class="card-link">Send now.</a>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-calendar" style="font-size: 20px;"></i> Calender</h5>
        <h6 class="card-subtitle mb-2 text-muted">Office calender</h6>
        <p class="card-text">View what is happening in our office, events, celeberations,..etc.</p>
        <a href="{{route('salesexecutive.calender')}}" class="card-link">Visit.</a>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-lead-pencil" style="font-size: 20px;"></i> Generated leads</h5>
        <h6 class="card-subtitle mb-2 text-muted">Leads from your district</h6>
        <p class="card-text">View leads from your district for follow up to make the lead as a client.</p>
        <a href="{{route('salesexecutive.leads')}}" class="card-link">View now.</a>
    </div>
</div> --}}
@endsection
