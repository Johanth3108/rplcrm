@extends('layouts.superadmin')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Property</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage status</li>
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
                <h3 class="card-title">Manage status of leads and properties.</h3>
                <form class="forms-sample" method="POST" action="{{route('admin.status.add')}}">
                    @csrf
                    <div class="form-group mx-3">
                        <input required type="text" name="status" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Status"  required>
                    </div>
                    <button type="submit" class="btn btn-primary mx-3 mb-2">Add</button>
                    <div class="col-md-8 grid-margin stretch-card mx-0">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Available status</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0 ?>
                                            @foreach ($status as $stat)
                                                <tr>
                                                    <th>{{++$i}}</th>
                                                    <td>{{$stat->status}}</td>
                                                    <td><a href="{{route('admin.status.delete', $stat->id)}}" id="delete" class="btn btn-danger">Delete</a></td>
                                                    <td>
                                                        @if ($stat->stat==true)
                                                            <a href="{{route('admin.status.update', $stat->id)}}" class="btn btn-success">Active</a>
                                                        @else
                                                            <a href="{{route('admin.status.update', $stat->id)}}" class="btn btn-warning">In active</a>
                                                        @endif </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
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