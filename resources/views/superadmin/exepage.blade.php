@extends('layouts.superadmin')

@section('head')
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Permissions</a></li>
      <li class="breadcrumb-item active" aria-current="page">Permissions for salesexecutive</li>
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
                <h6 class="card-title">Permissions for salesexecutive</h6>
                <form class="forms-sample" action="{{route('admin.exepage.save')}}" method="POST" >
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2">
                            <h5>Broadcast</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="message" class="form-check-input" @if ($exepage->message==1) checked @endif>
                                    Message
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="whatsapp" class="form-check-input" @if ($exepage->whatsapp==1) checked @endif>
                                    Whatsapp
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="calendar" class="form-check-input" @if ($exepage->calendar==1) checked @endif>
                                    Calendar
                                </label>
                            </div>
                        </div>
                        

                        <div class="col-md-2">
                            <h5>User</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="employees" class="form-check-input" @if ($exepage->employees==1) checked @endif>
                                    Employees
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_user" class="form-check-input" @if ($exepage->add_user==1) checked @endif>
                                    Add user
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <h5>Reports</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="apex" class="form-check-input" @if ($exepage->apex==1) checked @endif>
                                    Reports (apex)
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <h5>Leads</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="gen_leads" class="form-check-input" @if ($exepage->gen_leads==1) checked @endif>
                                    Generated leads
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_lead" class="form-check-input" @if ($exepage->add_lead==1) checked @endif>
                                    Add leads
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <h5>Properties</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="gen_prop" class="form-check-input" @if ($exepage->gen_prop==1) checked @endif>
                                    Generated properties
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_prop" class="form-check-input" @if ($exepage->add_prop==1) checked @endif>
                                    Add properties
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <h5>Telecallers</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="assign" class="form-check-input" @if ($exepage->assign==1) checked @endif>
                                    Assign telecallers
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
