@extends('layouts.salesmanager')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item active" aria-current="page">Employee detail</li>
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
      {{-- <a type="button"  class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
        <i class="btn-icon-prepend" data-feather="download"></i>
        Import
      </a>
      <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="printer"></i>
        Print
      </button> --}}
      <a href="{{route('admin.report.download')}}" type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="download-cloud"></i>
        Download Report
      </a>
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
                          <th>Employee name</th>
                          <th>Mail id</th>
                          <th>Contact number</th>
                          <th>Position</th>
                          <th>District</th>
                          <th>State</th>
                          <th>Current working lead</th>
                          <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($emps as $emp)
                          <tr>
                              <td>{{$emp->id}}</td>
                              <td>{{$emp->name}}</td>
                              <td>{{$emp->email}}</td>
                              <td>{{$emp->contact_number}}</td>

                              @if ($emp->superadmin==true)
                              <td>Super Admin</td>
                              @elseif ($emp->salesmanager==true)
                              <td>Sales Manager</td>
                              @elseif ($emp->salesexecutive==true)
                              <td>Sales Executive</td>
                              @elseif ($emp->telecaller==true)
                              <td>Telecaller</td>
                              @endif

                              <td>{{$emp->district}}</td>
                              <td>{{$emp->state}}</td>
                              <td>Housing.com <span class="badge badge-success">active</span></td>

                              <td>
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Manage
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a href="{{route('admin.report')}}" class="dropdown-item">View report</a>
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