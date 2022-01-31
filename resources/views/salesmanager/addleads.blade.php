@extends('layouts.salesmanager')

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Leads</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add leads</li>
    </ol>
</nav>

@if ($message = Session::get('success'))
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
                <h3 class="card-title">Add a lead</h3>
                <form class="forms-sample" action="{{route('salesmanager.addleads.save')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="client_name">Client name</label>
                        <input required type="text" name="client_name" class="form-control" id="client_name" autocomplete="off" placeholder="Enter client's name"  required>
                    </div>
                    <div class="form-group">
                        <label for="client_phn">Client contact number</label>
                        <input required type="text" name="client_phn" class="form-control" id="client_phn" autocomplete="off" placeholder="Enter client's contact number"  required>
                    </div>
                    <div class="form-group">
                        <label for="client_em">Client email</label>
                        <input required type="text" name="client_em" class="form-control" id="client_em" autocomplete="off" placeholder="Enter client's email"  required>
                    </div>
                    <div class="form-group">
                        <label for="propname">Property name</label>
                        <select name="propname" id="propname" class="form-control" id="propname" onchange="change()" required>
                            <option value="" selected disabled>Select a property</option>
                            @foreach ($props as $prop)
                            <option value="{{$prop->propname}}" id="{{$prop->propname}}">{{$prop->propname}}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salesman">Assigning salesmanager</label>
                        <select name="salesman" class="form-control" id="salesman" required>
                            <option value="" selected disabled>Select a salesmanager</option>
                            @foreach ($users as $user)
                                @if ($user->salesmanager==true)
                                    <option value="{{$user->id}}" id="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salesexe">Assigning salesexecutive</label>
                        <select name="salesexe" class="form-control" id="salesexe" disabled multiple>
                            @foreach ($users as $user)
                                @if ($user->salesexecutive==true)
                                <option value="{{$user->id}}" id="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="text" name="exe" id="exe" hidden>
                    </div>
                
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('multiselect/multiselect-dropdown.js')}}"></script>

<script>
    function change() {
        var x = document.getElementById("propname").value;
        {{$j=0}}
        @foreach ($assigns as $assign)
        if (x=='{{$assign->property_name}}') {
            document.getElementById("{{$assign->salesmanager}}").selected = true;
            @for ($i=0; $i<count($assign_exes[$j]); $i++)
                document.getElementById("{{$assign_exes[$j][$i]}}").selected = true;
            @endfor
            {{$j = $j+1}}
        }
        @endforeach
        document.getElementById("exe").value = Array.from(document.getElementById("salesexe").options).filter(option => option.selected).map(option => option.value);
    }
</script>


@endsection