<!DOCTYPE html>
<html>

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MTs.S An-Nur Padang</title>
	<link href="{{asset('/lumino')}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('/lumino')}}/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{asset('/lumino')}}/css/datepicker3.css" rel="stylesheet">
	<link href="{{asset('/lumino')}}/css/styles.css" rel="stylesheet">
	{{-- datatabel --}}
	<link rel="stylesheet" href="{{asset('/lumino')}}/datatables.net-bs/css/dataTables.bootstrap.min.css">
	{{-- Sweetalert2 --}}
	<link rel="stylesheet" type="text/css" href="{{asset('sweetalert2/sweetalert2.min.css')}}">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href=""><span>MTs.S An-Nur </span>Padang</a>

			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
                <div class="profile-usertitle-name">{{Auth::guard('admin')->user()->nama}}</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="#"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="{{url('admin/data-admin')}}"><em class="fa fa-users">&nbsp;</em> Data Admin</a></li>
			<li><a href="{{url('admin/data-guru')}}"><em class="fa fa-users">&nbsp;</em> Data Guru</a></li>
			<li><a href="{{url('admin/data-siswa')}}"><em class="fa fa-users">&nbsp;</em> Data Siswa</a></li>
			<li><a href="{{url('admin/data-kelas')}}"><em class="fa fa-file">&nbsp;</em> Data Kelas</a></li>
            <li><a href="{{url('admin/data-mapel')}}"><em class="fa fa-file">&nbsp;</em> Data Mata Pelajaran</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1" class="collapsed" aria-expanded="false">
				<em class="fa fa-navicon">&nbsp;</em> Laporan Anbsensi <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right collapsed" aria-expanded="false"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1" aria-expanded="false" style="height: 0px;">
                    <li><a href="{{route('admin.laporan')}}">
                        <em class="fa fa-file">&nbsp;</em> Laporan
                    </a></li>
				</ul>
			<li><a href="{{url('admin/logout')}}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div>
	<!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        @yield('content')
	</div><!-- /.row -->
	</div>
	<!--/.main-->
	<script src="{{asset('/lumino')}}/js/jquery.min.js"></script>
	<script src="{{asset('/lumino')}}/js/chart.min.js"></script>
	<script src="{{asset('/lumino')}}/js/chart-data.js"></script>
	<script src="{{asset('/lumino')}}/js/easypiechart.js"></script>
	<script src="{{asset('/lumino')}}/js/easypiechart-data.js"></script>
	<script src="{{asset('/lumino')}}/js/bootstrap-datepicker.js"></script>
	<script src="{{asset('/lumino')}}/js/custom.js"></script>
	<script src="{{asset('/lumino')}}/js/bootstrap.min.js"></script>
	{{-- datatabel --}}
	<script src="{{asset('/lumino')}}/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('/lumino')}}/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	{{-- sweetalert2 --}}
	<script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>

	@yield('js')

{{-- <!-- jQuery 3 -->
<script src="{{asset('/lumino')}}/jquery/dist/jquery.min.js"></script> --}}
</body>

</html>
