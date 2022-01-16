@extends('layouts.superadmin')

@section('head')
@endsection

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
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Properties</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add properties</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add a property.</h6>
                <form class="forms-sample" action="{{route('admin.updateprop', $prop->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Property Name</label>
                        <input required type="text" value="{{$prop->propname}}" name="propname" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Property name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input required type="text" value="{{$prop->address}}" name="address" class="form-control" id="exampleInputEmail1" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">District</label>
                        <input required type="text" value="{{$prop->district}}" name="district" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="District" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">State</label>
                        <input required type="text" value="{{$prop->state}}" name="state" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="State" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Property type</label>
                        <input required type="text" value="{{$prop->prop_type}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="State" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Property Type</label>
                        <select name="prop_type" class="form-control" id="exampleFormControlSelect1" required>
                            <option disabled>Select Property Type</option>
                            <option selected>2 BHK </option>
                            <option>3 BHK</option>
                            <option>4 BHK </option>
                            <option>Villa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name of Owner</label>
                        <input required type="text" value="{{$prop->owner}}" name="owner" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Owner name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Status</label>
                        <select name="status" class="form-control" id="exampleFormControlSelect1">
                            <option disabled value=null>Set current status of the property.</option>
                            <option value="active">Active  </option>
                            <option value="sold">Sold</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
