@extends('layouts.salesmanager')

@section('head')
<link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endsection

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
      <li class="breadcrumb-item active" aria-current="page">Assigned leads</li>
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
                <h6 class="card-title">Assigned leads</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                            <th hidden>#id</th>
                            <th>S.no</th>
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
                            <?php $i = 0; ?>
                            @foreach ($leads as $lead)
                            <tr>
                                <td hidden>{{$lead->id}}</td>
                                @if ($lead->lead_from=='99Acres')
                                  <td>{{'ac'.++$i}}</td>
                                @elseif ($lead->lead_from=='Magicbricks')
                                  <td>{{'mg'.++$i}}</td>
                                @else
                                  <td>{{'ma'.++$i}}</td>
                                @endif
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
                                
                                <td>{{App\Models\status::where('id', $lead->status)->first()->status}}</td>



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