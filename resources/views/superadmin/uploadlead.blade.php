@extends('layouts.superadmin')

@section('head')

<link rel="stylesheet" href="{{asset('assets/vendors/dropify/dist/dropify.min.css')}}">
    
@endsection

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

<form action="{{route('admin.leads.upload')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Dropify</h6>
                <p class="card-description">Read the <a href="https://github.com/JeremyFagis/dropify" target="_blank"> Official Dropify Documentation </a>for a full list of instructions and other options.</p>
                <input type="file" name="sheet" id="myDropify" class="border" data-height="400"  data-show-errors="true" data-allowed-file-extensions="csv"/>
                <button class="btn btn-success mt-2" type="submit">Upload</button>
                <a class="btn btn-warning mt-2" href="{{route('sample.download.lead')}}">Download a sample file</a>
            </div>
        </div>
    </div>

</form>


@endsection

@section('script')
    <script src="{{asset('assets/vendors/dropify/dist/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/dropify.js')}}"></script>
@endsection