@extends('layouts.areamanager')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('areamanager.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Property</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add a property type</li>
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
                <h3 class="card-title">Add a property type</h3>
                <form class="forms-sample" method="POST" action="{{route('areamanager.proptype.add')}}">
                    @csrf
                    <div class="form-group mx-3">
                        <input required type="text" name="prop_type" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Property type"  required>
                    </div>
                    <button type="submit" class="btn btn-primary mx-3 mb-2">Add</button>
                    <div class="col-md-6 grid-margin stretch-card mx-0">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Added property types</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Property type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prop_types as $prop_type)
                                                <tr>
                                                    <th>{{$prop_type->id}}</th>
                                                    <td>{{$prop_type->prop_type}}</td>
                                                    <td><a href="{{route('areamanager.proptype.delete', $prop_type->id)}}" id="delete" class="btn btn-danger">Delete</a></td>
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