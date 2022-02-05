@extends('layouts.salesexecutive')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesexecutive.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item"><a href="#">Report</a></li>
      <li class="breadcrumb-item active" aria-current="page">Apex</li>
    </ol>
</nav>

    
    
        <div class="col-xl-12 grid-margin stretch-card">
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

});
</script>
    
@endsection