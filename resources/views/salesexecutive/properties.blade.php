@extends('layouts.salesexecutive')

@section('head')
@endsection

@section('content')
@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <h6 class="card-title">Owned properties.</h6>
              <div class="table-responsive">
                  <table id="example" class="table">
                      <thead>
                          <tr>
                              <th>S.no</th>
                          <th>Property name</th>
                          <th>Address</th>
                          <th>Location</th>
                          <th>Property type</th>
                          <th>Status</th>
                          <th>Images</th>
                          <th>Broucher</th>
                          <th>Owner</th>
                          {{-- <th>Action</th> --}}
                          </tr>
                      </thead>
                      <tbody>
                        <?php $i=0 ?>
                        @foreach ($props as $prop)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$prop->propname}}</td>
                            <td>{{Str::limit($prop->address, 20, '...')}}</td>
                            <td>{{$prop->district.", ".$prop->state}}</td>
                            <td>{{$prop->prop_type}}</td>
                            <td>{{App\Models\status::where('id', $lead->status)->first()->status}}</td>
                            <td><i data-feather="check" class="text-success"></i></td>
                            <td><i data-feather="x" class="text-danger"></i></td>
                            <td class="text-info">{{$prop->owner}}</td>
                            {{-- <td><a href="{{route('admin.manageprop', $prop->id)}}" class="btn btn-info">Manage</a></td> --}}
                        </tr>
                            
                        @endforeach
                        
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>


@endsection

@section('script')

<script>
  $('#example').dataTable( {
    "order": [[0, 'desc']]
  } );
</script>
  
@endsection