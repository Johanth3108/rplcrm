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
      <li class="breadcrumb-item"><a href="{{route('salesexecutive.home')}}">SAGI CRM</a></li>
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
      <a type="button" href="#" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
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
                            <th>Client name</th>
                            <th>Contact number</th>
                            <th>Property name</th>
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
                                <td>{{$lead->client_name}}</td>
                                <td>{{$lead->client_phn}}</td>
                                <td>{{$lead->property_name}}</td>
                                <td>{{$lead->prop_type}}</td>

                                @if ($lead->lead_from)
                                <td>{{$lead->lead_from}}</td>
                                @else
                                <td>Manual</td>
                                @endif
                                <td>{{App\Models\User::where('id', $lead->assigned_man)->get()->first()->name}}</span></td>
                                <td>{{App\Models\User::where('id', $lead->assigned_exe)->get()->first()->name}}</td>
                                
                                @if ($lead->status==1)
                                <td class="text-success">Active</td>
                                @elseif ($lead->status==2)
                                <td class="text-warning">On-hold</td>
                                @else
                                <td class="text-danger">Rejected</td>
                                @endif


                                <td>
                                  <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Edit
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      {{-- <a class="dropdown-item" href="{{route('admin.managelead', $lead->id)}}">Manage</a> --}}
                                      <a href="{{route('salesmanager.feedback', $lead->id)}}" class="dropdown-item">Feedbacks</a>
                                    </div>
                                  </div>
                                </td>
                                {{-- <td><a href="{{route('admin.managelead', $lead->id)}}" class="btn btn-info mr-2">Manage</a><a href="{{route('admin.feedback', $lead->id)}}" class="btn btn-info mr-2">Feedbacks</a></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection