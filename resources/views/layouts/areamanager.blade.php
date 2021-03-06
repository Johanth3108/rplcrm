<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Area manager</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_1/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	@yield('head')
</head>
{{-- <body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body> --}}
<body class="sidebar-dark" id="body">
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
      <div class="sidebar-header">
        <a href="{{route('areamanager.home')}}" class="sidebar-brand">
          SAGI<span>CRM</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="{{route('areamanager.home')}}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          @if ($areamanpage->employees || $areamanpage->add_user)
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
              <i class="link-icon" data-feather="user"></i>
              <span class="link-title">User</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="forms">
              <ul class="nav sub-menu">
                @if ($areamanpage->employees==true)
                <li class="nav-item">
                  <a href="{{route('areamanager.employees')}}" class="nav-link">Employees</a>
                </li>
                @endif
                
                @if ($areamanpage->add_user==true)
                <li class="nav-item">
                  <a href="{{route('areamanager.adduser')}}" class="nav-link">Add User</a>
                </li>
                @endif
                
              </ul>
            </div>
          </li> 
          @endif

          @if ($areamanpage->usr_perm==1)
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#permissions" role="button" aria-expanded="false" aria-controls="permissions">
              <i class="link-icon" data-feather="activity"></i>
              <span class="link-title">User permissions</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="permissions">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('areamanager.manpage')}}" class="nav-link">Sales manager</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('areamanager.exepage')}}" class="nav-link">Sales executive</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('areamanager.telepage')}}" class="nav-link">Telecaller</a>
                </li>
              </ul>
            </div>
          </li>
          @endif

          
          @if ($areamanpage->gen_prop==true || $areamanpage->add_prop==true || $areamanpage->gen_prop==true)
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#properties" role="button" aria-expanded="false" aria-controls="properties">
              <i class="link-icon" data-feather="layout"></i>
              <span class="link-title">Properties</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="properties">
              <ul class="nav sub-menu">
                @if ($areamanpage->gen_prop==true)
                <li class="nav-item">
                  <a href="{{route('areamanager.properties')}}" class="nav-link">Generated properties</a>
                </li>
                @endif
                
                @if ($areamanpage->add_prop==true)
                <li class="nav-item">
					        <a href="{{route('areamanager.addprop')}}" class="nav-link">Add properties</a>
                </li>
                @endif
                
                @if ($areamanpage->add_proptype==true)
                <li class="nav-item">
                  <a href="{{route('areamanager.proptype')}}" class="nav-link">Add property type</a>
                </li>
                @endif
                
              </ul>
            </div>
          </li>  
          @endif
          

          @if ($areamanpage->gen_leads || $areamanpage->add_lead)
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
              <i class="link-icon" data-feather="briefcase"></i>
              <span class="link-title">Leads</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav sub-menu">
                @if ($areamanpage->gen_leads==true)
                <li class="nav-item">
                  <a href="{{route('areamanager.leads')}}" class="nav-link">Generated leads</a>
                </li>
                @endif
                
                @if ($areamanpage->add_lead)
                <li class="nav-item">
                  <a href="{{route('areamanager.addlead')}}" class="nav-link">Add Lead</a>
                </li>
                @endif
                
              </ul>
            </div>
          </li>  
          @endif
          

          @if ($areamanpage->clients==true)
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#clients" role="button" aria-expanded="false" aria-controls="clients">
              <i class="link-icon" data-feather="anchor"></i>
              <span class="link-title">Clients</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="clients">
              <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('areamanager.clients')}}" class="nav-link">View Clients</a>
              </li>
              <li class="nav-item">
                <a href="{{route('areamanager.broadcast')}}" class="nav-link">Broadcast</a>
              </li>
              <li class="nav-item">
                <a href="{{route('areamanager.email')}}" class="nav-link">Email</a>
              </li>
              <li class="nav-item">
                <a href="{{route('areamanager.email.template')}}" class="nav-link">Email templates</a>
              </li>
              </ul>
            </div>
            </li>
          @endif
          

          @if ($areamanpage->apex==true)
          <li class="nav-item">
            <a class="nav-link"  data-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
              <i class="link-icon" data-feather="pie-chart"></i>
              <span class="link-title">Report</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('areamanager.apex')}}" class="nav-link">Leads per month</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('areamanager.leadproperty')}}" class="nav-link">Leads per property</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('areamanager.leadmanual')}}" class="nav-link">Manual assigned leads</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('areamanager.leadauto')}}" class="nav-link">Automatic assigned leads</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          

          {{-- @if ($areamanpage->calendar==true)
          <li class="nav-item">
            <a href="{{route('areamanager.calender')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Calendar</span>
            </a>
          </li>
          @endif --}}
          

          @if ($areamanpage->message || $areamanpage->whatsapp)
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sms" role="button" aria-expanded="false" aria-controls="sms">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">SMS</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="sms">
              <ul class="nav sub-menu">
                @if ($areamanpage->message)
                <li class="nav-item">
                  <a href="#" class="nav-link">Message</a>
                </li>
                @endif
                
                {{-- @if ($areamanpage->whatsapp==true)
                <li class="nav-item">
                  <a href="#" class="nav-link">Whatsapp</a>
                </li>
                @endif --}}
                
              </ul>
            </div>
          </li>  
          @endif
          

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#message" role="button" aria-expanded="false" aria-controls="message">
              <i class="link-icon" data-feather="server"></i>
              <span class="link-title">Message</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="message">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('areamanager.inbox')}}" class="nav-link">Inbox <span class="badge badge-pill badge-danger"> {{Auth::user()->notification}}</span></a>
                </li>
                <li class="nav-item">
                  <a href="{{route('areamanager.message')}}" class="nav-link">Send message</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar">
				<a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
				<div class="navbar-content">
					<form class="search-form">
						<div class="input-group">
							<div class="input-group-prepend">
                <iframe src="https://free.timeanddate.com/clock/i85z25nz/n553/fs22/ftb/pa0/tt0/tw1/th2/ta1" frameborder="0" width="434" height="26"></iframe>
							</div>
						</div>
					</form>
					<ul class="navbar-nav">
						<li class="nav-item dropdown nav-notifications">
							<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="bell"></i>
								@if ($noti>0)
								<div class="indicator">
									<div class="circle"></div>
								</div>
								@endif
								
							</a>
							<div class="dropdown-menu" aria-labelledby="notificationDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">{{count($messsages)}} New Notifications</p>
									<a href="javascript:;" class="text-muted">Clear all</a>
								</div>
								<div class="dropdown-body">
									@foreach ($messsages as $message)
									<a href="{{route('areamanager.reply', $message->sender_id)}}" class="dropdown-item">
										<div class="icon">
											<i data-feather="layers"></i>
										</div>
										<div class="content">
											<p>{{$message->message}}</p>
											<p class="sub-text text-muted">{{$message->sender_name}}</p>
										</div>
									</a>
									@endforeach
									
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-center">
									<a href="{{ route('areamanager.inbox') }}">View all</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown nav-profile">
							<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="https://via.placeholder.com/30x30" alt="userr">
							</a>
							<div class="dropdown-menu" aria-labelledby="profileDropdown">
								<div class="dropdown-header d-flex flex-column align-items-center">
									<div class="figure mb-3">
										<img src="https://via.placeholder.com/80x80" alt="">
									</div>
									<div class="info text-center">
										<p class="name font-weight-bold mb-0">{{Auth::user()->name}}</p>
										<p class="email text-muted mb-3">{{Auth::user()->email}}</p>
									</div>
								</div>
								<div class="dropdown-body">
									<ul class="profile-nav p-0 pt-3">
										<li class="nav-item">
											<a href="{{route('areamanager.profile')}}" class="nav-link">
												<i data-feather="user"></i>
												<span>Profile</span>
											</a>
										</li>
										<li class="nav-item">
											{{-- <a href="javascript:;" class="nav-link">
												<i data-feather="log-out"></i>
												<span>Log Out</span>
											</a> --}}
												<a class="nav-link" href="{{ route('logout') }}"
												   onclick="event.preventDefault();
																 document.getElementById('logout-form').submit();">
												<i data-feather="log-out"></i>

													{{ __('Logout') }}
												</a>
			
												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
										</li>
										
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<!-- partial -->

			<div class="page-content">

		<main class="py-4">
			@yield('content')
		</main>
        </div>
			</div>

			{{-- <!-- partial:partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
				<p class="text-muted text-center text-md-left">Copyright ?? 2020 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>. All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->
		 --}}
		</div>
	</div>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="{{asset('assets/vendors/core/core.js')}}"></script>
	<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('assets/js/template.js')}}"></script>
	<script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('assets/js/datepicker.js')}}"></script>
	<script src="{{asset('assets/js/dashboard.js')}}"></script>

	<script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
	<script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
	<script src="{{asset('assets/js/data-table.js')}}"></script>

	<script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
	<script src="{{asset('assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
	<script src="{{asset('assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
	<script src="{{asset('assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
	<script src="{{asset('assets/js/apexcharts.js')}}"></script>

  @yield('script')


	<script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
  


</body>
</html>
