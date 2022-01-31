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
                        <input name="name" type="text" value="{{$emp->name}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input name="email" type="email" value="{{$emp->email}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Contact number</label>
                        <input name="contact" type="text" value="{{$emp->contact_number}}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Contact number" required>
                    </div>

                    {{-- <div class="form-group">
                        <label for="exampleInputUsername1">Current employee position</label>
                        @if ($emp->superadmin==true)
                            <input type="text" value="Super admin" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location" required>
                        @elseif ($emp->salesmanager==true)
                            <input type="text" value="Sales manager" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location" required>
                        @elseif ($emp->salesexecutive==true)
                            <input type="text" value="Sales executive" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location" required>
                        @else
                            <input type="text" value="Telecaller" class="form-control" disabled id="exampleInputUsername1" autocomplete="off" placeholder="Property Location" required>
                        @endif
                    </div> --}}
                
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Change employee position</label>
                        <select name="position" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select employee position</option>
                            <option value="0" @if ($emp->superadmin==true) selected @endif>Superadmin </option>
                            <option value="1" @if ($emp->salesmanager==true) selected @endif>Sales manager</option>
                            <option value="2" @if ($emp->salesexecutive==true) selected @endif>Sales executive </option>
                            <option value="3" @if ($emp->telecaller==true) selected @endif>Telecaller</option>
                        </select>
                    </div>

                    
                
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
@endsection