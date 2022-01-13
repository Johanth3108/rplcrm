@extends('layouts.superadmin')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Leads</a></li>
      <li class="breadcrumb-item active" aria-current="page">Employee update</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit employee details</h3>
                <form class="forms-sample" method="POST" action="{{route('admin.save', $emp->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input name="name" type="text" value="{{$emp->name}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Name">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input name="email" type="email" value="{{$emp->email}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Contact number</label>
                        <input name="contact" type="text" value="{{$emp->contact_number}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Property Location">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Current employee position</label>
                        @if ($emp->superadmin==true)
                            <input type="text" value="Super admin" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location">
                        @elseif ($emp->salesmanager==true)
                            <input type="text" value="Sales manager" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location">
                        @elseif ($emp->salesexecutive==true)
                            <input type="text" value="Sales executive" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location">
                        @else
                            <input type="text" value="Telecaller" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location">
                        @endif
                    </div>
                
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Change employee position</label>
                        <select name="position" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select employee position</option>
                            <option value="0">Superadmin </option>
                            <option value="1">Sales manager</option>
                            <option value="2">Sales executive </option>
                            <option value="3">Telecaller</option>
                        </select>
                    </div>

                    
                
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
@endsection