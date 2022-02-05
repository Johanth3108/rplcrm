@extends('layouts.superadmin')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item"><a href="#">Report</a></li>
      <li class="breadcrumb-item active" aria-current="page">Apex</li>
    </ol>
</nav>


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
        
    </div>
<script>
    $(function() {
    'use strict';
    
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