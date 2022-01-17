@extends('layouts.superadmin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Message</a></li>
      <li class="breadcrumb-item active" aria-current="page">Send a message</li>
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
                <h3 class="card-title">Messenger</h3>
                <form class="forms-sample" action="{{route('admin.message.send')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Message to</label>
                        <select required name="reciever" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Select reciever</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Your message</label>
                        <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

    
@endsection