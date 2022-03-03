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
                            <h5>Leads</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="gen_leads" class="form-check-input" @if ($exepage->gen_leads==1) checked @endif>
                                    Generated leads
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h5>Telecallers</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="tele" class="form-check-input" @if ($exepage->tele==1) checked @endif>
                                    Telecallers list
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_tele" class="form-check-input" @if ($exepage->add_tele==1) checked @endif>
                                    Assign telecallers
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h5>Reports</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="lpp" class="form-check-input" @if ($exepage->lpp==1) checked @endif>
                                    Leads per property
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="mal" class="form-check-input" @if ($exepage->mal==1) checked @endif>
                                    Manual assigned leads
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="aal" class="form-check-input" @if ($exepage->aal==1) checked @endif>
                                    Automatic assigned leads
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h5>Clients</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="view_clients" class="form-check-input" @if ($exepage->view_clients==1) checked @endif>
                                    View clients
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="broadcast" class="form-check-input" @if ($exepage->broadcast==1) checked @endif>
                                    Broadcast
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="email" class="form-check-input" @if ($exepage->email==1) checked @endif>
                                    Email
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="email_temp" class="form-check-input" @if ($exepage->email_temp==1) checked @endif>
                                    Email templates
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
