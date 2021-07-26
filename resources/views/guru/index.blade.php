@extends('layouts.appGuru')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/guru')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">dashboard</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Dashboard</h1>
    </div>
    
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard
            </div>
        </div><!-- /.panel-->
    </div><!-- /.col-->
@endsection
