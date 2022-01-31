@extends('layouts.areamanager')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('areamanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item"><a href="#">Report</a></li>
      <li class="breadcrumb-item active" aria-current="page">Apex</li>
    </ol>
</nav>

<div class="row">
    <div class="col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Leads generated every month.</h6>
                <div id="leads"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Leads generated per property.</h6>
                <div id="prop"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Manually assigned leads.</h6>
                <div id="manual"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Automatically assigned leads.</h6>
                <div id="auto"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
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
colors: ["#5CFF5C"],
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
  data: [{!! "'".$manual_leads."'" !!}]
}],
xaxis: {
  type: 'Months',
  categories: ['January','Feburary','March','April','May','June','July','August','September', 'October', 'November', 'December']
}
}

var apexBarChart = new ApexCharts(document.querySelector("#manual"), options);

apexBarChart.render();

// auto leads

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
  data: [{!! "'".$auto_leads."'" !!}]
}],
xaxis: {
  type: 'Months',
  categories: ['January','Feburary','March','April','May','June','July','August','September', 'October', 'November', 'December']
}
}

var apexBarChart = new ApexCharts(document.querySelector("#auto"), options);

apexBarChart.render();

//   property 

var options = {
chart: {
  type: 'bar',
  height: '500',
  parentHeightOffset: 0
},
colors: ["#FFFF2E"],
grid: {
  borderColor: "rgba(77, 138, 240, .1)",
  padding: {
    bottom: 0
  }
},
series: [{
  name: 'sales',
  data: [{!! "'".$per_prop."'" !!}]
}],
xaxis: {
  type: 'sales',
  categories: [{!! "'".$property."'" !!}]
}
}

var property = new ApexCharts(document.querySelector("#prop"), options);

property.render();
});
</script>

    
@endsection