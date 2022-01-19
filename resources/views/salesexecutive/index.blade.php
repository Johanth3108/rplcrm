@extends('layouts.salesexecutive')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Dashboard {{Auth::user()->name}}</h4>
      <h4 class="mb-3 mb-md-0">This is Salesmanager portal.</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control">
      </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Number of Salesexecutive's</h6>
                
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">1234</h3>
                  <div class="d-flex align-items-baseline">
                    <a href="{{route('admin.adduser')}}" class="text-success">
                      <span>Click to add a employee.</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">No. of leads generated</h6>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">3,084</h3>
                  <div class="d-flex align-items-baseline">
                    <a href="{{route('admin.addlead')}}" class="text-success">
                      <span>Click to add a new lead.</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- row -->
  

<div class="row">
    <div class="col-md-4 col-lg-5 col-xl-4 grid-margin grid-margin-xl-1 stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Inbox</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                  <a class="dropdown-item d-flex align-items-center" href="{{route('salesmanager.inbox')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                </div>
              </div>
            </div>
            <div class="d-flex flex-column">
                @foreach ($messsages as $message)

                <a href="#" class="d-flex align-items-center border-bottom pb-3">
                    <div class="mr-3">
                      <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                    </div>
                    <div class="w-100">
                      <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2">{{$message->sender_name}}</h6>
                        <p class="text-muted tx-12">{{$message->created_at}}</p>
                      </div>
                      <p class="text-muted tx-13">{{$message->message}}</p>
                    </div>
                </a>
                @endforeach
            </div>
          </div>
        </div>
      </div>
  <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <h6 class="card-title">Employee details</h6>
              <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                      <thead>
                          <tr>
                            <th>#id</th>
                            <th>Property name</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Property type</th>
                            <th>Lead from</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($leads as $lead)
                          <tr>
                              <td>{{$lead->id}}</td>
                              <td>{{$lead->property_name}}</td>
                              <td>{{$lead->state}}</td>
                              <td>{{$lead->district}}</td>
                              <td>{{$lead->prop_type}}</td>
                              <td>{{$lead->lead_from}}</td>
                              <td>Sales executive</td>
                              <td class="text-success">Active</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  
</div>
{{-- 
<div class="card mb-2">
    <div class="card-body">
      <h5 class="card-title"><i class="mdi mdi-message-reply-text" style="font-size: 20px;"></i> Message </h5>
      <h6 class="card-subtitle mb-2 text-muted">Send bulk messages.</h6>
      <p class="card-text">You can send bulk messages for promotions and to gain leads.</p>
      <a href="{{route('salesexecutive.message')}}" class="card-link">Send now.</a>
    </div>
</div>

<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-whatsapp" style="font-size: 20px;"></i> Whatsapp</h5>
        <h6 class="card-subtitle mb-2 text-muted">Send bulk whatsapp messages.</h6>
        <p class="card-text">You can send bulk whatsapp messages for promotions and to gain leads through social media.</p>
        <a href="{{route('salesexecutive.whatsapp')}}" class="card-link">Send now.</a>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-calendar" style="font-size: 20px;"></i> Calender</h5>
        <h6 class="card-subtitle mb-2 text-muted">Office calender</h6>
        <p class="card-text">View what is happening in our office, events, celeberations,..etc.</p>
        <a href="{{route('salesexecutive.calender')}}" class="card-link">Visit.</a>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-lead-pencil" style="font-size: 20px;"></i> Generated leads</h5>
        <h6 class="card-subtitle mb-2 text-muted">Leads from your district</h6>
        <p class="card-text">View leads from your district for follow up to make the lead as a client.</p>
        <a href="{{route('salesexecutive.leads')}}" class="card-link">View now.</a>
    </div>
</div> --}}
@endsection
