@extends('layouts.salesmanager')

@section('head')
@endsection

@section('content')
@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif


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
      <a type="button" href="{{route('admin.property.download')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="download-cloud"></i>
        Download Report
      </a>
    </div>
</div>


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <h6 class="card-title">Owned properties.</h6>
              <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                      <thead>
                          <tr>
                          <th>#id</th>
                          <th>Property name</th>
                          <th>Address</th>
                          <th>District</th>
                          <th>State</th>
                          <th>Property type</th>
                          <th>Status</th>
                          <th>Owner</th>
                          {{-- <th>Action</th> --}}
                          </tr>
                      </thead>
                      <tbody>

                        @foreach ($props as $prop)
                        <tr>
                            <td>{{$prop->id}}</td>
                            <td>{{$prop->propname}}</td>
                            <td>{{$prop->address}}</td>
                            <td>{{$prop->district}}</td>
                            <td>{{$prop->state}}</td>
                            <td>{{$prop->prop_type}}</td>
                            <td>{{App\Models\status::where('id', $prop->status)->first()->status}}</td>
                            <td class="text-info">{{$prop->owner}}</td>
                            {{-- <td><a href="{{route('admin.manageprop', $prop->id)}}" class="btn btn-info">Manage</a></td> --}}
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
