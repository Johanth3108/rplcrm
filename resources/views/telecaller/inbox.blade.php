@extends('layouts.telecaller')

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('telecaller.home')}}">SAGI CRM</a></li>
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
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                            <th>#id</th>
                            <th>From</th>
                            <th>Message</th>
                            {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                            <tr>
                                <td>{{$message->id}}</td>
                                <td>{{$message->sender_name}}</td>
                                <td>{{$message->message}}</td>
                                {{-- <td><a href="#" class="btn btn-info">Manage</a></td> --}}
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