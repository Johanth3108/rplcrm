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
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <h6 class="card-title">Employee details</h6>
              <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                      <thead>
                          <tr>
                            <th>#id</th>
                            <th>Property name</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Property type</th>
                            <th>Lead from</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($leads as $lead)
                          <tr>
                              <td>{{$lead->id}}</td>
                              <td>{{$lead->property_name}}</td>
                              <td>{{$lead->state}}</td>
                              <td>{{$lead->district}}</td>
                              <td>{{$lead->prop_type}}</td>
                              <td>{{$lead->lead_from}}</td>
                              <td>Sales executive</td>
                              <td class="text-success">Active</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
      $('dataTableExample').DataTable();
  } );
</script>
@endsection
