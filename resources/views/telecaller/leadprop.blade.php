@extends('layouts.telecaller')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('telecaller.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item"><a href="#">Report</a></li>
      <li class="breadcrumb-item active" aria-current="page">Apex</li>
    </ol>
</nav>


    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Manually assigned leads.</h6>
                    <div id="manual"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
      function resolveAfter2Seconds() {
        return new Promise(resolve => {
          setTimeout(() => {
            resolve('resolved');
          }, 500);
        });
      }

      async function asyncCall() {
        console.log('calling');
        const result = await resolveAfter2Seconds();
        console.log(result);
          document.getElementById('dashboard').classList.remove('active');
          document.getElementById('message').classList.remove('active');
          document.getElementById('inbox').classList.remove('active');
          document.getElementById('send').classList.remove('active');
        
        // expected output: "resolved"
      }
      let i = 1;
      if (i==1) {
        asyncCall();
        i++;
      }
      
    </script>
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
      data: [{!! "'".$manual_leads."'" !!}]
    }],
    xaxis: {
      type: 'Months',
      categories: ['January','Feburary','March','April','May','June','July','August','September', 'October', 'November', 'December']
    }
  }
  
  var apexBarChart = new ApexCharts(document.querySelector("#manual"), options);
  
  apexBarChart.render();

});
</script>
@endsection
