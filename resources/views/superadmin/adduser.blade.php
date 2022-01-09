@extends('layouts.superadmin')

@section('head')
@endsection

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>New Employee </strong>portal created!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Staff</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add employee</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add employee</h6>
                <form class="forms-sample" action="{{route('admin.addemp')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Employee Name</label>
                        <input required type="text" name="empname" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input required type="email" name="empemail" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input required type="password" name="emppass" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Phone no</label>
                        <input required type="text" name="empph" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Department</label>
                        <select required name="dept" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled value=null>Select User Department</option>
                            <option value="sales">Sales  </option>
                            <option value="telecaller">Telecaller</option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">User type</label>
                        <select required name="usrtype" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select user type</option>
                            <option value="0">Super Admin </option>
                            <option value="1">Sales Managers </option>
                            <option value="2">Sales Executive </option>
                            <option value="3">Telecaller</option>
                            
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
