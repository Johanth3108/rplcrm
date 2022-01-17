@extends('layouts.superadmin')

@section('content')

@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}} </strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<div class="profile-page tx-13">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="profile-header">
                <div class="cover">
                    <div class="gray-shade"></div>
                    <figure>
                        <img src="https://via.placeholder.com/1148x272" class="img-fluid" alt="profile cover">
                    </figure>
                    <div class="cover-body d-flex justify-content-between align-items-center">
                        <div>
                            <img class="profile-pic" src="https://via.placeholder.com/100x100" alt="profile">
                            <span class="profile-name">{{Auth::user()->name}}</span>
                            <span class="profile-email">{{Auth::user()->email}}</span>
                        </div>
                    </div>
                </div>
                <div class="header-links">
                    <ul class="links d-flex align-items-center mt-3 mt-md-0">
                        <li class="header-link-item d-flex align-items-center active">
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                            
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                            
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit employee details</h3>
                <form class="forms-sample" method="POST" action="{{route('admin.update', Auth::user()->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input name="name" type="text" class="form-control" value="{{Auth::user()->name}}" id="exampleInputUsername1" autocomplete="off" placeholder="Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input name="email" type="email" class="form-control" value="{{Auth::user()->email}}" id="exampleInputUsername1" autocomplete="off" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Contact number</label>
                        <input name="contact" type="text" class="form-control" value="{{Auth::user()->contact_number}}" id="exampleInputUsername1" autocomplete="off" placeholder="Contact number" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">District</label>
                        <input name="district" type="text" class="form-control" value="{{Auth::user()->district}}" id="exampleInputUsername1" autocomplete="off" placeholder="District" disabled required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">State</label>
                        <input name="state" type="text" class="form-control" value="{{Auth::user()->state}}" id="exampleInputUsername1" autocomplete="off" placeholder="State" disabled required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
@endsection