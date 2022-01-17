@extends('layouts.salesmanager')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>New Employee </strong>portal created!
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
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">SMS</a></li>
      <li class="breadcrumb-item active" aria-current="page">Message</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">SMS</h6>
                <form class="forms-sample" action="{{route('salesmanager.message.send')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="number">Message to:</label>
                        <input required type="tel" name="number" class="form-control" id="number" autocomplete="off" placeholder="Reciever number">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your message:</label>
                        <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>
                        {{-- <input required type="email" name="empemail" class="form-control" id="exampleInputEmail1" placeholder="Email"> --}}
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection