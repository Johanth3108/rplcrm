@extends('layouts.areamanager')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap">
  <div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('areamanager.home')}}">SAGI CRM</a></li>
        <li class="breadcrumb-item"><a href="#">Staff</a></li>
        <li class="breadcrumb-item active" aria-current="page">Clients</li>
      </ol>
    </nav>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
    <a type="button" href="{{route('admin.leads.download')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </a>
  </div>
</div>




@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>New Employee </strong>portal created!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0"></h4>
      <h4 class="mb-3 mb-md-0"></h4>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Generated leads</h5>
                <h6 class="card-subtitle mb-2 text-muted">These are the leads which we recieved.</h6>

                <div class="table-responsive dt-responsive">
                    <table id="dataTableExample" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th>#id</th>
                            <th>Client name</th>
                            <th>Contact number</th>
                            <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td>{{App\Models\lead::where('client_name', $client->client_name)->first()->id}}</td>
                                <td>{{App\Models\lead::where('client_name', $client->client_name)->first()->client_name}}</td>
                                <td>{{App\Models\lead::where('client_name', $client->client_name)->first()->client_phn}}</td>
                                <td>{{App\Models\lead::where('client_name', $client->client_name)->first()->client_em}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  
<script>
  $('#delete').on('click',function (e) {
      e.preventDefault();
      var self = $(this);
      console.log(self.data('title'));
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire(
                  'Deleted!',
                  'Lead has been deleted.',
                  'success'
              )
              // document.getElementById('form').submit();
              location.href = self.attr('href');
          }
      })

  })
</script>
@endsection