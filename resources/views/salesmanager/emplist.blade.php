@extends('layouts.salesmanager')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item active" aria-current="page">Employee detail</li>
    </ol>
</nav>
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
                            <th>State</th>
                            <th>District</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Current working lead</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emps as $emp)
                            <tr>
                                <td>{{$emp->id}}</td>
                                <td>{{$emp->name}}</td>
                                <td>{{$emp->email}}</td>
                                <td>{{$emp->contact_number}}</td>
                                <td>{{$emp->state}}</td>
                                <td>{{$emp->district}}</td>
                                <td>{{$emp->department}}</td>
                                
                                @if ($emp->superadmin==true)
                                <td>Super Admin</td>
                                @elseif ($emp->salesmanager==true)
                                <td>Sales Manager</td>
                                @elseif ($emp->salesexecutive==true)
                                <td>Sales Executive</td>
                                @elseif ($emp->telecaller==true)
                                <td>Telecaller</td>
                                @endif
                                <td>Housing.com <span class="badge badge-success">Active</span></td>
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