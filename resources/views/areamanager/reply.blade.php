@extends('layouts.areamanager')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('telecaller.home')}}">RPL CRM</a></li>
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
                <h3 class="card-title">Reply to {{$reciever->name}}</h3>
                <form class="forms-sample" action="{{route('areamanager.message.send')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="reply">Reply to</label>
                        <input type="text" class="form-control" value="{{$reciever->name}}" id="reply" autocomplete="off" placeholder="Reciever name" required disabled>
                        <input type="text" class="form-control" value="{{$reciever->id}}" name="reciever" id="reply" autocomplete="off" placeholder="Reciever name" hidden>
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