@extends('layouts.salesmanager')
@section('head')
<link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endsection
@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Message</a></li>
      <li class="breadcrumb-item active" aria-current="page">Inbox</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Messenger</h5>
                <h6 class="card-subtitle mb-2 text-muted">Messages sent by others can be viewed here.</h6>

                <div class="table-responsive">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                            <th>#id</th>
                            <th>From</th>
                            <th>Message</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                            <tr>
                                <td>{{$message->id}}</td>
                                <td>{{$message->sender_name}}</td>
                                <td>{{$message->message}}</td>
                                <td><a href="{{route('salesmanager.pmessage.reply', $message->sender_id)}}" class="btn btn-info">Reply</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('dataTableExample').DataTable();
    } );
</script> --}}
    
@endsection

@section('script')

<script>
  $('#example').dataTable( {
    "order": [[0, 'desc']]
  } );
</script>
  
@endsection