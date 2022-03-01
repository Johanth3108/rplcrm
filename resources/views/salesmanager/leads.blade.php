@extends('layouts.salesmanager')

@section('content')

@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}} </strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item active" aria-current="page">Generated leads</li>
    </ol>
</nav>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0"></h4>
      <h4 class="mb-3 mb-md-0"></h4>
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
      </button> --}}
      <a type="button" href="{{route('admin.leads.download')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="download-cloud"></i>
        Download Report
      </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Generated leads</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                          <tr>
                            <th>#id</th>
                            <th>Owner name</th>
                            <th>Contact number</th>
                            <th>Property name</th>
                            <th>Location</th>
                            <th>Property type</th>
                            <th>Lead from</th>
                            <th>Assigned Salesmanager</th>
                            <th>Assigned Salesexecutive</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                            <tr>
                              <td>{{$lead->id}}</td>
                              <td>test owner</td>
                              <td>123456789</td>
                              <td>{{$lead->property_name}}</td>
                              <td>{{$lead->district.", ".$lead->state}}</td>
                              <td>{{$lead->prop_type}}</td>

                              @if ($lead->lead_from)
                              <td>{{$lead->lead_from}}</td>
                              @else
                              <td>Manual</td>
                              @endif
                              <td>{{App\Models\User::where('id', $lead->assigned_man)->get()->first()->name}}</span></td>
                              <td>{{App\Models\User::where('id', $lead->assigned_exe)->get()->first()->name}}</td>
                              
                              <td>{{App\Models\status::where('id', $lead->status)->first()->status}}</td>


                              <td>
                                <div class="dropdown">
                                  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('salesmanager.leads.view', $lead->id)}}">Edit</a>
                                    <a href="{{route('salesmanager.feedback', $lead->id)}}" class="dropdown-item">Feedbacks</a>
                                  </div>
                                </div>
                              </td>
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