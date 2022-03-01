@extends('layouts.superadmin')

@section('head')
<link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap">
  <div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
        <li class="breadcrumb-item"><a href="#">Staff</a></li>
        <li class="breadcrumb-item active" aria-current="page">Generated leads</li>
      </ol>
    </nav>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
    <a href="{{route('admin.leads.view')}}" type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
      <i class="btn-icon-prepend" data-feather="download"></i>
      Import
    </a>
    <a type="button" href="{{route('admin.leads.download')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </a>
  </div>
</div>




@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}} </strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Generated leads</h5>
                <h6 class="card-subtitle mb-2 text-muted">These are the leads which we recieved.</h6>

                <div class="table-responsive dt-responsive">
                    <table id="dataTableExample" class="table display" cellspacing="0" width="100%">
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
                                <td>@if (App\Models\User::where('id', $lead->assigned_man)->get()->first())
                                  {{App\Models\User::where('id', $lead->assigned_man)->get()->first()->name}}
                                  @else
                                  none
                                @endif</td>
                                <td>@if (App\Models\User::where('id', $lead->assigned_exe)->get()->first())
                                  {{App\Models\User::where('id', $lead->assigned_exe)->get()->first()->name}}
                                  @else
                                  none
                                @endif </td>
                                
                                @if(App\Models\status::where('id', $lead->status)->first())
                                <td>{{App\Models\status::where('id', $lead->status)->first()->status}}</td>
                                @else
                                <td>Invalid status.</td>
                                @endif
                                
                                <td>
                                  <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Manage
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{route('admin.managelead', $lead->id)}}">Edit</a>
                                      <a href="{{route('admin.feedback', $lead->id)}}" class="dropdown-item">Feedbacks</a>
                                      <a class="dropdown-item" id="delete" href="{{route('admin.deletelead', $lead->id)}}">Delete</a>
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
  
<script>
  $('#delete').on('click',function (e) {
      e.preventDefault();
      var self = $(this);
      console.log(self.data('title'));
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire(
                  'Deleted!',
                  'Lead has been deleted.',
                  'success'
              )
              // document.getElementById('form').submit();
              location.href = self.attr('href');
          }
      })

  })
</script>
@endsection