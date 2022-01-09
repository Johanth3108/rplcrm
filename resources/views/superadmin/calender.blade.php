@extends('layouts.superadmin')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">RPL CRM</a></li>
      <li class="breadcrumb-item"><a href="#">Broadcast</a></li>
      <li class="breadcrumb-item active" aria-current="page">Calender</li>
    </ol>
</nav>

<div class="row">
    <h3 class="text-secondary mx-4">Calender</h3>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <h6 class="card-title">CALENDER</h6> --}}
                <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FKolkata&src=am9oYW50aC5wcy4yMDE5Lm1jdEByYWphbGFrc2htaS5lZHUuaW4&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTFjZTFhOWVkQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTJiY2NlMzAwQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb21iNGMxMTMxYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTc4NGRmNTY0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb21mNWJlMTFmMkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbWZmMGYyNzBmQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb200N2RhYTgzM0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTI0YTgzOWNhQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb21iMzE0ZDFlY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uaW5kaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTg2Y2FkODM0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTU4MTBhYTg1QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbThlNzUyNTE0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbWQ3MGI3NzM4QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb21mYmM2ZjNhNUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb201MjRiNDQyYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21kNDAzOTJmYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTI4OTNjYjVkQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb21kZTU1ZDI0ZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbWNjMjVlMGQ0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb200MzAwMDEzM0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21lY2U5MGU3M0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20zY2U4NzEzZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20yNTFkZjBjZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20yZjdiZjA4YUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTIzMjI5M2I1QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=cmFqYWxha3NobWkuZWR1LmluX2NsYXNzcm9vbTFkNjM3ZDEyQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb20yNTk1MWZlMEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb205OGRlMTlmZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20xMDRmZTA4ZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20wODQxMmQwN0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20xZTlhNTdiNUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb201Y2ZhNDZmYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20xNjQ0ZDUxM0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%2333B679&color=%23202124&color=%23202124&color=%230047a8&color=%237627bb&color=%230047a8&color=%230047a8&color=%230047a8&color=%230047a8&color=%230047a8&color=%230B8043&color=%23202124&color=%23202124&color=%23202124&color=%23137333&color=%230047a8&color=%230047a8&color=%23202124&color=%230047a8&color=%23137333&color=%230047a8&color=%230047a8&color=%23137333&color=%230047a8&color=%23137333&color=%230047a8&color=%23202124&color=%23137333&color=%237627bb&color=%23b80672&color=%230047a8&color=%23202124&color=%230047a8&color=%23202124&color=%23202124" style="border:solid 1px #777" class="w-100" height="590" frameborder="0" scrolling="no"></iframe>

            </div>
        </div>
    </div>
</div>
@endsection