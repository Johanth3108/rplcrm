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
                <h3 class="card-title">Add a lead</h3>
                <form class="forms-sample" action="{{route('admin.savelead')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="propname">Property name</label>
                        <select name="propname" class="form-control" id="propname" required>
                            <option value="" selected disabled>Select a property</option>
                            @foreach ($props as $prop)
                            <option value="{{$prop->id}}">{{$prop->propname}}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salesman">Assigning salesmanager</label>
                        <select name="salesman" class="form-control" id="salesman" required>
                            <option value="" selected disabled>Select a salesmanager</option>
                            @foreach ($users as $user)
                            @if ($user->salesmanager==true)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salesexe">Assigning salesexecutive</label>
                        <select name="salesexe" class="form-control" id="salesexe" required>
                            <option value="" selected disabled>Select a salesexecutive</option>
                            @foreach ($users as $user)
                            @if ($user->salesexecutive==true)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>


@endsection