@extends('layouts.salesmanager')

@section('head')
@endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('salesmanager.home')}}">SAGI CRM</a></li>
    <li class="breadcrumb-item"><a href="#">Clients</a></li>
    <li class="breadcrumb-item active" aria-current="page">Broadcast</li>
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


  <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a
        class="nav-link active"
        id="ex1-tab-1"
        data-mdb-toggle="tab"
        href="#ex1-tabs-1"
        role="tab"
        aria-controls="ex1-tabs-1"
        aria-selected="true"
        >SMS</a
      >
    </li>
    <li class="nav-item" role="presentation">
      <a
        class="nav-link"
        id="ex1-tab-2"
        data-mdb-toggle="tab"
        href="#ex1-tabs-2"
        role="tab"
        aria-controls="ex1-tabs-2"
        aria-selected="false"
        >Whatsapp</a
      >
    </li>
  </ul>
  <!-- Tabs navs -->
  
  <!-- Tabs content -->
  {{-- Tab pane 1 --}}
  <div class="tab-content" id="ex1-content">
    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Send individual or bulk sms</h4>
                        <form action="{{route('salesmanager.message.send')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Select clients</label>
                                <select class="js-example-basic-multiple w-100" name="clients" id="multiple" multiple="multiple" 
                                multiselect-search="true" multiselect-select-all="true" onchange="client()" required>
                                    @foreach ($clients as $client)
                                        <option value="{{App\Models\lead::where('client_name', $client->client_name)->first()->client_phn}}">{{$client->client_name." ".App\Models\lead::where('client_name', $client->client_name)->first()->client_phn}}</option>    
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select template</label>
                                <select class="w-100" onChange="myNewFunction(this);" required>
                                  <option value="" selected disabled>Select a template</option>
                                    @foreach ($ress as $res)
                                        <option value="{{$res['id']}}">{{$res['title'].", MESSAGE-> ".$res['body']}}</option>    
                                        {{-- <option value=""></option>     --}}
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" name="template" id="template" hidden>
                            <input type="text" name="list_clients" id="list_clients" hidden>
                            {{-- <div class="form-group">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="10"></textarea>
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    {{-- tab pane 2 --}}
    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
      <a href="https://web.whatsapp.com/" target="_blank" class="btn btn-primary">Login into whatsapp</a>

    </div>
  </div>
  <!-- Tabs content -->

	{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
    <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
></script>
<script src="{{asset('multiselect/multiselect-dropdown.js')}}"></script>
<script>
  function myNewFunction(element) {
    var text = element.options[element.selectedIndex].text;
    text = text.split('> ')[1];
    document.getElementById('template').value  = text;
    console.log(text);
  }
</script>
<script>
  $("#multiple").change(function (e) {
    e.preventDefault();
    console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text));
    let clnt = document.getElementById('list_clients');
    clnt.value = Array.from(this.selectedOptions).map(x=>x.value??x.text);
  })
</script>

@endsection