@extends('layouts.app')
@section('content')

<div class="col-md-12 main">   
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Icon</li>
		<li> Profile </li>
	</ol>
</div><br>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                <button type="button" class="close" data-dismiss="alert">×</button>
            @endforeach
        </ul>
</div>
@endif

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">{{$employee->last_name}} {{$employee->middle_name}} {{$employee->first_name}}
		<a style="margin-left: 5px" class="btn btn-sm btn-primary pull-right" href="{{route('employee.edit', $employee->id)}}"><span class=" glyphicon glyphicon-edit"> </span>Sửa nhân sự</a><a class="btn btn-sm btn-default pull-right" href="{{url('employee')}}">Trở <span class="glyphicon glyphicon-share-alt"></span></a>
	</div>
	<div class="panel-body">
				<div class="col-md-6">
					<b>Địa chỉ: {{$employee->address}}</b><br>
					<b>Số điện thoại: {{$employee->phone}}</b><br>
					<label>Email: <a href="mail:to">{{$employee->email}}</a></label><br>
					<label>Trình độ: {{$employee->education}}</label><br>
					<label>Mô tả: {{$employee->description}}</label><br>
					<!-- <label>Chứng chỉ: {{$employee->certificate}}</label><br> -->
				</div>
				<div class="col-md-6">
				<label>Ngày làm việc: {{$employee->working_day}}</label><br>
				<label>Giờ làm: {{$employee->in_time}} - {{$employee->out_time}}</label><br>
				<label>Chuyên khoa: {{$employee->department->name}}</label><br>
				
				</div>
	</div>
</div>
</div>
</div>
</div>


@endsection