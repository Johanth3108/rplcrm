@extends('layouts.telecaller')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
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
                                <th>Client name</th>
                                <th>Contact number</th>
                                <th>Email</th>
                                <th>Property name</th>
                                <th>Address</th>
                                <th>Property type</th>
                                <th>Lead from</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                            <tr>
                                <td>{{$lead->id}}</td>
                                <td>{{$lead->client_name}}</td>
                                <td>{{$lead->client_phn}}</td>
                                <td>{{$lead->client_em}}</td>
                                <td>{{$lead->property_name}}</td>
                                <td>{{$lead->address}}</td>
                                <td>{{$lead->prop_type}}</td>
                                <td>{{$lead->lead_from}}</td>

                                <td>{{App\Models\status::where('id', $lead->status)->first()->status}}</td>

                                <td><a href="{{route('telecaller.feedback', $lead->id)}}" class="btn btn-info mr-2">Feedbacks</a></td>
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