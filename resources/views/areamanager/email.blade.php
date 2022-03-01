@extends('layouts.areamanager')

@section('head')
@endsection

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('areamanager.home')}}">SAGI CRM</a></li>
    <li class="breadcrumb-item"><a href="#">Clients</a></li>
    <li class="breadcrumb-item active" aria-current="page">Email</li>
  </ol>
</nav>

@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
  
  <!-- Tabs content -->
  {{-- Tab pane 1 --}}
  <div class="tab-content" id="ex1-content">
    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Send individual or bulk emails</h4>
                        <form action="{{route('areamanager.email.template.send')}}" method="post">
                            @csrf
                            <input type="text" name="list_clients" id="list_clients" hidden>
                            <div class="form-group">
                                <label>Select clients</label>
                                <select class="js-example-basic-multiple w-100" id="multiple" 
                                required multiple multiselect-search="true" multiselect-select-all="true">
                                    
                                    @foreach ($clients as $client)
                                      <option value="{{App\Models\lead::where('client_name', $client->client_name)->first()->id}}">{{$client->client_name." ".App\Models\lead::where('client_name', $client->client_name)->first()->client_em}}</option>    
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Select template</label>
                              <select class="w-100" id="template" name="template" required>
                                <option value="" selected disabled>Select a template</option>
                                  @foreach ($temps as $temp)
                                      <option value="{{$temp->id}}">{{$temp->title}}</option>    
                                  @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="templatemessage">Email</label>
                                <textarea class="form-control" id="templatemessage" name="message" rows="10" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    </div>
    </div>

  </div>
  <script>
    $("#template").change( function (e) {
      e.preventDefault();
      var temp_id = $(this).val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "GET",
        url: "/areamanager/email/template/ajax/"+temp_id,
        success: function (response) {
          document.getElementById('templatemessage').value = response['template'];
        }
      })
    })
  </script>

  <script>
    $("#multiple").change(function (e) {
      e.preventDefault();
      console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text));
      let clnt = document.getElementById('list_clients');
      clnt.value = Array.from(this.selectedOptions).map(x=>x.value??x.text);
    })
  </script>

  <!-- Tabs content -->

	{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
    <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
></script>
<script src="{{asset('multiselect/multiselect-dropdown.js')}}"></script>

@endsection