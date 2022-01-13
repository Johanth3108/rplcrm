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
      <li class="breadcrumb-item"><a href="#">Staffs</a></li>
      <li class="breadcrumb-item active" aria-current="page">Assign telecallers</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">SMS</h6>
                <form class="forms-sample" action="#" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="number">Assigning lead:</label>
                        <div class="form-group">
                            <select name="lead" class="form-control" id="inputState">
                                @foreach ($leads as $lead)
                                    <option value="{{$lead->id}}">{{$lead->property_name}}, {{$lead->district}}, {{$lead->address}} <span class="badge badge-success">active</span></option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Assign to:</label>
                        <div class="form-group">
                            <select name="name" class="form-control" id="inputState">
                                @foreach ($telecallers as $telecaller)
                                    <option value="{{$telecaller->id}}">{{$telecaller->name}}</option>
                                @endforeach
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