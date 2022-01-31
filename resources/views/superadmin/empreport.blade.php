@extends('layouts.superadmin')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Employee</a></li>
      <li class="breadcrumb-item active" aria-current="page">Report</li>
    </ol>
</nav>

<div class="row">
    <div class="col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Leads attended.</h6>
                <div id="apexLine"></div>
            </div>
        </div>
    </div>
</div>
@endsection