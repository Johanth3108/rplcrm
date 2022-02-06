@extends('layouts.salesexecutive')

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
                            <td>{{App\Models\status::where('id', $lead->status)->first()->status}}</td>

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
