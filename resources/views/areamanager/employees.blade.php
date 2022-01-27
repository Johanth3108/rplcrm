@extends('layouts.areamanager')

@section('head')
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('areamanager.home')}}">SAGI CRM</a></li>
              <li class="breadcrumb-item"><a href="#">Staff</a></li>
              <li class="breadcrumb-item active" aria-current="page">Employee detail</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control">
      </div>
      <a type="button" href="{{route('admin.report.download')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
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
                                @elseif ($emp->areamanager==true)
                                <td>Area Manager</td>
                                @elseif ($emp->salesmanager==true)
                                <td>Sales Manager</td>
                                @elseif ($emp->salesexecutive==true)
                                <td>Sales Executive</td>
                                @elseif ($emp->telecaller==true)
                                <td>Telecaller</td>
                                @endif

                                <td>{{$emp->district}}</td>
                                <td>{{$emp->state}}</td>
                                <td>Housing.com</td>
                                <td><a href="{{route('areamanager.employeeedit', $emp->id)}}" class="btn btn-primary">Manage</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- <script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
	<script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
	<script src="{{asset('assets/js/data-table.js')}}"></script>
    <script src="{{asset('assets/vendors/core/core.js')}}"></script>
	<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('assets/js/template.js')}}"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('dataTableExample').DataTable();
    } );
</script>
@endsection
