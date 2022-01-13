@extends('layouts.superadmin')

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item active" aria-current="page">Generated leads</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Generated leads</h5>
                <h6 class="card-subtitle mb-2 text-muted">These are the leads which we recieved.</h6>

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
                                <td>Test salesexecutive <span class="badge badge-primary">Johanth p s</span></td>
                                
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