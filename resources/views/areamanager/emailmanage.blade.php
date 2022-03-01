
@extends('layouts.areamanager')

@section('head')
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('areamanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Clients</a></li>
      <li class="breadcrumb-item active" aria-current="page">Email template</li>
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
  <!-- Tabs content -->
  {{-- Tab pane 1 --}}
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create email templates</h4>
                            <form action="{{route('areamanager.email.template.save')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Template title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Message</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="10" placeholder="Message to be mailed..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
  <!-- Tabs content -->

    <script src="{{asset('multiselect/multiselect-dropdown.js')}}"></script>

@endsection