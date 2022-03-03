@extends('layouts.superadmin')

@section('head')
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Permissions</a></li>
      <li class="breadcrumb-item active" aria-current="page">Permissions for areamanager</li>
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
                <h6 class="card-title">Permissions for salesmanager</h6>
                <form class="forms-sample" action="{{route('admin.areamanpage.save')}}" method="POST" >
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2">
                            <h5>User</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="employees" class="form-check-input" @if ($areamanpage->employees==1) checked @endif>
                                    Employees
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_user" class="form-check-input" @if ($areamanpage->add_user==1) checked @endif>
                                    Add user
                                </label>
                            </div>
                            {{-- <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="usr_perm" class="form-check-input" @if ($areamanpage->usr_perm==1) checked @endif>
                                    User permission
                                </label>
                            </div> --}}
                        </div>

                        <div class="col-md-2">
                            <h5>User permissions</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="sales_man" class="form-check-input" @if ($areamanpage->sales_man==1) checked @endif>
                                    Sales manager
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="sales_exe" class="form-check-input" @if ($areamanpage->sales_exe==1) checked @endif>
                                    Sales executive
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="tele" class="form-check-input" @if ($areamanpage->tele==1) checked @endif>
                                    Telecaller
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h5>Properties</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="gen_prop" class="form-check-input" @if ($areamanpage->gen_prop==1) checked @endif>
                                    Generated properties
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_prop" class="form-check-input" @if ($areamanpage->add_prop==1) checked @endif>
                                    Add properties
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_proptype" class="form-check-input" @if ($areamanpage->add_proptype==1) checked @endif>
                                    Add property type
                                </label>
                            </div>
                            {{-- <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="clients" class="form-check-input" @if ($areamanpage->clients==1) checked @endif>
                                    Clients
                                </label>
                            </div> --}}
                            
                        </div>

                        <div class="col-md-2">
                            <h5>Leads</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="gen_leads" class="form-check-input" @if ($areamanpage->gen_leads==1) checked @endif>
                                    Generated leads
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="add_lead" class="form-check-input" @if ($areamanpage->add_lead==1) checked @endif>
                                    Add leads
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h5>Clients</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="view_clients" class="form-check-input" @if ($areamanpage->view_clients==1) checked @endif>
                                    View clients
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="broadcast" class="form-check-input" @if ($areamanpage->broadcast==1) checked @endif>
                                    Broadcast
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="email" class="form-check-input" @if ($areamanpage->email==1) checked @endif>
                                    Email
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="email_temp" class="form-check-input" @if ($areamanpage->email_temp==1) checked @endif>
                                    Email templates
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <h5>Reports</h5>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="lpm" class="form-check-input" @if ($areamanpage->lpm==1) checked @endif>
                                    Leads per month
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="lpp" class="form-check-input" @if ($areamanpage->lpp==1) checked @endif>
                                    Leads per property
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="mal" class="form-check-input" @if ($areamanpage->mal==1) checked @endif>
                                    Manual assigned leads
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input value="1" type="checkbox" name="aal" class="form-check-input" @if ($areamanpage->aal==1) checked @endif>
                                    Automatic assigned leads
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
