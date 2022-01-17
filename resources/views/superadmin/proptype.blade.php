@extends('layouts.superadmin')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Property</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add a property type</li>
    </ol>
</nav>

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
                <h3 class="card-title">Add a property type</h3>
                <form class="forms-sample" method="POST" action="{{route('admin.proptype.add')}}">
                    @csrf
                    <div class="form-group">
                        <label for="inputState">Add a property type</label>
                        <input required type="text" name="prop_type" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Property type"  required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Available property types</label>
                        @foreach ($prop_types as $prop_type)
                        <h6 class="card-subtitle ml-2 text-dark">{{strtoupper($prop_type->prop_type)}}</h6>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
@endsection