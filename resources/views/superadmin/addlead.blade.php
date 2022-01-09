@extends('layouts.superadmin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Leads</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add leads</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">ADD Property</h3>
                <form class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Property Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Property Name">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Location</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Property Location">
                    </div>
                
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Property Type</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select Property Type</option>
                            <option>2 BHK </option>
                            <option>3 BHK</option>
                            <option>4 BHK </option>
                            <option>Villa</option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">From</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select user type</option>
                            <option>99 acer </option>
                            <option>Magic Brick </option>
                            <option>Manual </option>
                            <option>Housing.com</option>
                            
                        </select>
                        

                    </div>
                    <div class="form-group">
                    
                        <h6 class="card-title">Upload Image</h6>
                        <input type="file" id="myDropify" class="border"/>
                    </div> 
                
                <div class="form-group">
                    
                        <h6 class="card-title">Upload Broucher</h6>
                        <input type="file" id="myDropify" class="border"/>
                    </div>
                
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection