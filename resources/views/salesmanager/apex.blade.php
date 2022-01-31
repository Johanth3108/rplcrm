@extends('layouts.salesmanager')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item"><a href="#">Report</a></li>
      <li class="breadcrumb-item active" aria-current="page">Apex</li>
    </ol>
</nav>

<div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Total Lead</h6>
    <div id="apexLine"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Housing.com Lead</h6>
    <div id="apexMixed"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var options = {
    chart: {
      height: 300,
      type: "line",
      parentHeightOffset: 0
    },
    colors: ["#f77eb9", "#7ee5e5","#4d8af0"],
    grid: {
      borderColor: "rgba(77, 138, 240, .1)",
      padding: {
        bottom: -15
      }
    },
    series: [
      {
        name: "Data a",
        data: [45, 52, 38, 45]
      },
      {
        name: "Data b",
        data: [12, 42, 68, 33]
      },
      {
        name:
          "Data c",
        data: [8, 32, 48, 53]
      }
    ],
    xaxis: {
      type: "datetime",
      categories: ["2015", "2016", "2017", "2018"]
    },
    markers: {
      size: 0
    },
    stroke: {
      width: 3,
      curve: "smooth",
      lineCap: "round"
    },
    legend: {
      show: true,
      position: "top",
      horizontalAlign: 'left',
      containerMargin: {
        top: 30
      }
    },
    responsive: [
      {
        breakpoint: 500,
        options: {
          legend: {
            fontSize: "11px"
          }
        }
      }
    ]
  };
  var apexLineChart = new ApexCharts(document.querySelector("#leads"), options);
  apexLineChart.render();
    </script>
@endsection