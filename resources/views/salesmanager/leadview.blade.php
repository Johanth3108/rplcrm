@extends('layouts.salesexecutive')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Generated leads</a></li>
      <li class="breadcrumb-item active" aria-current="page">lead</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">{{$lead->property_name}}</h6>
                <form class="forms-sample" action="{{ route('salesmanager.leads.save', $lead->id) }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="prop_name">Property name :</label>
                        <input required disabled value="{{$lead->property_name}}" type="text" name="prop_name" class="form-control" id="number" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label for="addr">Location :</label>
                        @if ($lead->address)
                        <input required type="text" name="addr" value="{{$lead->address}}" class="form-control" id="addr" autocomplete="off" disabled>
                        @else
                        <input required type="text" name="addr" value="We don't have address, pls contact sales manager." class="form-control" id="addr" autocomplete="off" disabled>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="diststat">District & state :</label>
                        <input required type="text" name="diststat" value="{{$lead->district.", ".$lead->state}}" class="form-control" id="diststat" autocomplete="off" disabled>
                    </div>
                    <div class="form-group">
                        <label for="prop_type">Property type :</label>
                        <input required type="text" name="prop_type" value="{{$lead->prop_type}}" class="form-control" id="prop_type" autocomplete="off" disabled>
                    </div>
                    <div class="form-group">
                        <label for="lead_from">Lead from :</label>
                        <input required type="text" name="lead_from" value="{{$lead->lead_from}}" class="form-control" id="lead_from" autocomplete="off" disabled>
                    </div>
                    <div class="form-group">
                        <label for="stat">Current status :</label>
                        @if ($lead->status==1)
                        <input required type="text" name="stat" value="Active" class="form-control text-success" id="stat" autocomplete="off" disabled>
                        @elseif ($lead->status==2)
                        <input required type="text" name="stat" value="On-hold"  class="form-control text-warning" id="stat" autocomplete="off" disabled>
                        @else
                        <input required type="text" name="stat" value="Rejected"  class="form-control text-danger" id="stat" autocomplete="off" disabled>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="upstat">Update status:</label>
                        <div class="form-group">
                            <select name="upstat" class="form-control" id="lead">
                                <option value="1">Active</option>
                                <option value="2">On-hold</option>
                                <option value="3">Rejected</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection