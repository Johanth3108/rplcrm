@extends('layouts.salesexecutive')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesexecutive.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Leads</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lead feedbacks</li>
    </ol>
</nav>

@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<div class="card">
    <div class="card-body">
      <div class="row position-relative">
        {{-- <div class="col-lg-4 chat-aside border-lg-right">
          
        </div> --}}
        <div class="col-lg-12 chat-content">
          <div class="chat-header border-bottom pb-2 mb-3">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center">
                <i data-feather="corner-up-left" id="backToChatList" class="icon-lg mr-2 ml-n2 text-muted d-lg-none"></i>
                <figure class="mb-0 mr-2">
                  <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="image">
                  <div class="status online"></div>
                  <div class="status online"></div>
                </figure>
                <div>
                  <h4>{{$lead->client_name}}</h4>
                  <h5>{{$lead->property_name}}</h5>
                  <h5 class="text-muted tx-13">{{$lead->client_name}} / {{$lead->client_phn}} / {{$lead->client_em}}</h5>
                </div>
              </div>
              
            </div>
          </div>
          <div class="chat-body">
            <ul class="messages">
                @foreach ($feedbacks as $feedback)

                <li class="message-item me mb-3">
                    <h5>{{$feedback->fb_name}} - <span class="h6 text-muted">{{$feedback->created_at}}</span></h5>
                    <div class="content">
                      <div class="message">
                        <div class="bubble">
                          <p>{{$feedback->message}}</p>
                        </div>
                      </div>
                    </div>
                </li>
                    
                @endforeach
              
            </ul>
          </div>
          <div class="chat-footer d-flex">
            
            <form class="search-form flex-grow mr-2" id="form" method="POST" action="{{route('salesexecutive.feedback.send')}}"}}>
                @csrf
                {{-- {{$lead->client_name}} --}}
                <div class="input-group">
                    <input type="text" name="lead_id" value="{{$lead->id}}" hidden>
                </div>
                <div class="input-group">
                    <input type="text" name="fb_name" value="{{Auth::user()->name}}" hidden>
                </div>
                <div class="input-group">
                    <input type="text" name="message" class="form-control rounded-pill mr-2" id="chatForm" placeholder="Type a message" required>
                    <button type="submit"  class="btn btn-primary btn-icon rounded-circle">
                        <i data-feather="send"></i>
                    </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- <script src="{{asset('assets/js/chat.js')}}"></script> --}}
@endsection