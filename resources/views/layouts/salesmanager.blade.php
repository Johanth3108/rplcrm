<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
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
</head>
<body class="sidebar-dark">
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
			<div class="sidebar-header">
			  <a href="{{route('salesmanager.home')}}" class="sidebar-brand">
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
				  <a href="{{route('salesmanager.home')}}" class="nav-link">
					<i class="link-icon" data-feather="box"></i>
					<span class="link-title">Dashboard</span>
				  </a>
				</li>
				<li class="nav-item nav-category">Broadcast</li>
				
				<li class="nav-item">
				  <a class="nav-link" data-toggle="collapse" href="#sms" role="button" aria-expanded="false" aria-controls="sms">
					<i class="link-icon" data-feather="file-text"></i>
					<span class="link-title">SMS</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				  </a>
				  <div class="collapse" id="sms">
					<ul class="nav sub-menu">
					  <li class="nav-item">
						<a href="{{ route('salesmanager.message') }}" class="nav-link">Message</a>
					  </li>
					  <li class="nav-item">
						<a href="{{ route('salesmanager.whatsapp') }}" class="nav-link">Whatsapp</a>
					  </li>
					</ul>
				  </div>
				</li>
				<li class="nav-item">
				  <a href="{{route('salesmanager.calender')}}" class="nav-link">
					<i class="link-icon" data-feather="calendar"></i>
					<span class="link-title">Calendar</span>
				  </a>
				</li>
	  
				<li class="nav-item nav-category">Staffs </li>
				<li class="nav-item">
				  <a class="nav-link" data-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
					<i class="link-icon" data-feather="user"></i>
					<span class="link-title">User</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				  </a>
				  <div class="collapse" id="forms">
					<ul class="nav sub-menu">
					  
					  <li class="nav-item">
						  <a href="{{route('salesmanager.employer')}}" class="nav-link">Employees</a>
						</li>
					</ul>
				  </div>
				</li>
				<li class="nav-item">
				  <a class="nav-link"  data-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
					<i class="link-icon" data-feather="pie-chart"></i>
					<span class="link-title">Report</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				  </a>
				  <div class="collapse" id="charts">
					<ul class="nav sub-menu">
					  <li class="nav-item">
						<a href="{{route('salesmanager.apex')}}" class="nav-link">Apex</a>
					  </li>
					</ul>
				  </div>
				</li>
				<li class="nav-item">
				  <a class="nav-link" data-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
					<i class="link-icon" data-feather="briefcase"></i>
					<span class="link-title">Leads</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				  </a>
				  <div class="collapse" id="tables">
					<ul class="nav sub-menu">
					  <li class="nav-item">
						<a href="{{ route('salesmanager.leads') }}" class="nav-link">Generated leads</a>
					  </li>
					  <li class="nav-item">
						<a href="{{route('salesmanager.addleads')}}" class="nav-link test">Add Lead</a>
					  </li>
					</ul>
				  </div>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#properties" role="button" aria-expanded="false" aria-controls="properties">
					  <i class="link-icon" data-feather="layout"></i>
					  <span class="link-title">Properties</span>
					  <i class="link-arrow" data-feather="chevron-down"></i>
					</a>
					<div class="collapse" id="properties">
					  <ul class="nav sub-menu">
						<li class="nav-item">
						  <a href="{{route('salesmanager.properties')}}" class="nav-link">Properties</a>
						</li>
					  </ul>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#message" role="button" aria-expanded="false" aria-controls="message">
					  <i class="link-icon" data-feather="server"></i>
					  <span class="link-title">Message</span>
					  <i class="link-arrow" data-feather="chevron-down"></i>
					</a>
					<div class="collapse" id="message">
					  <ul class="nav sub-menu">
						<li class="nav-item">
						  <a href="{{route('salesmanager.inbox')}}" class="nav-link">Inbox <span class="badge badge-pill badge-danger"> {{Auth::user()->notification}}</span></a>
						</li>
						<li class="nav-item">
						  <a href="{{route('salesmanager.pmessage')}}" class="nav-link">Send message</a>
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
					{{-- <form class="search-form">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i data-feather="search"></i>
								</div>
							</div>
							<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
						</div>
					</form> --}}
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							{{-- <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="font-weight-medium ml-1 mr-1">English</span>
							</a> --}}
							<div class="dropdown-menu" aria-labelledby="languageDropdown">
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ml-1"> English </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i> <span class="ml-1"> French </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ml-1"> German </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-pt" title="pt" id="pt"></i> <span class="ml-1"> Portuguese </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-es" title="es" id="es"></i> <span class="ml-1"> Spanish </span></a>
							</div>
            </li>
						
						<li class="nav-item dropdown nav-messages">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="mail"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="messageDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">9 New Messages</p>
									<a href="javascript:;" class="text-muted">Clear all</a>
								</div>
								<div class="dropdown-body">
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Leonardo Payne</p>
												<p class="sub-text text-muted">2 min ago</p>
											</div>	
											<p class="sub-text text-muted">Project status</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Carl Henson</p>
												<p class="sub-text text-muted">30 min ago</p>
											</div>	
											<p class="sub-text text-muted">Client meeting</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Jensen Combs</p>												
												<p class="sub-text text-muted">1 hrs ago</p>
											</div>	
											<p class="sub-text text-muted">Project updates</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Yaretzi Mayo</p>
												<p class="sub-text text-muted">5 hr ago</p>
											</div>
											<p class="sub-text text-muted">New record</p>
										</div>
									</a>
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-center">
									<a href="javascript:;">View all</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown nav-notifications">
							<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="bell"></i>
								<div class="indicator">
									<div class="circle"></div>
								</div>
							</a>
							<div class="dropdown-menu" aria-labelledby="notificationDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">6 New Notifications</p>
									<a href="javascript:;" class="text-muted">Clear all</a>
								</div>
								<div class="dropdown-body">
									<a href="javascript:;" class="dropdown-item">
										<div class="icon">
											<i data-feather="user-plus"></i>
										</div>
										<div class="content">
											<p>New customer registered</p>
											<p class="sub-text text-muted">2 sec ago</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="icon">
											<i data-feather="gift"></i>
										</div>
										<div class="content">
											<p>New Order Recieved</p>
											<p class="sub-text text-muted">30 min ago</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="icon">
											<i data-feather="alert-circle"></i>
										</div>
										<div class="content">
											<p>Server Limit Reached!</p>
											<p class="sub-text text-muted">1 hrs ago</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="icon">
											<i data-feather="layers"></i>
										</div>
										<div class="content">
											<p>Apps are ready for update</p>
											<p class="sub-text text-muted">5 hrs ago</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="icon">
											<i data-feather="download"></i>
										</div>
										<div class="content">
											<p>Download completed</p>
											<p class="sub-text text-muted">6 hrs ago</p>
										</div>
									</a>
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-center">
									<a href="javascript:;">View all</a>
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
											<a href="{{route('salesmanager.profile')}}" class="nav-link">
												<i data-feather="user"></i>
												<span>Profile</span>
											</a>
										</li>
										{{-- <li class="nav-item">
											<a href="javascript:;" class="nav-link">
												<i data-feather="repeat"></i>
												<span>Switch User</span>
											</a>
										</li> --}}
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
				<p class="text-muted text-center text-md-left">Copyright © 2020 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>. All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->
		 --}}
		</div>
	</div>

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

	<script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>

</body>
</html>
