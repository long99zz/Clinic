@extends('layouts.app')
@section('content')
@include('patients.partials.add')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Bệnh nhân</li>
				<li>Thông tin bệnh nhân</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if (count($errors) > 0)
        <div class="alert alert-danger">
           
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Bảng bệnh nhân<a class="btn btn-success pull-right" data-toggle="modal" href="#addPatient"><span class="glyphicon glyphicon-plus"></span>Thêm bệnh nhân</a></div>
					<div class="panel-body">
						<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
				        <tr>
				            <th >Mã</th>
					        <th data-sortable="true">Tên</th>
							<th data-sortable="true">Tuổi</th>
							<th data-sortable="true">Giới tính</th>
					        <th data-sortable="true">Địa chỉ</th>
					        <th data-sortable="true">Thao tác</th>
						    </tr>
					    </thead>
					    <tbody>
				    	@foreach($patients as $patient)
				        <tr>
				            <td>{{ $patient->id}}</td>
							<td>{{$patient->last_name}} {{$patient->middle_name}} {{$patient->first_name}}</td>
							<td>{{ $patient->age}}</td>
							<td>{{ $patient->gender}}</td>
				    		<td>{{$patient->location}}, {{$patient->state}}, {{$patient->district}}, {{$patient->country}}</td>
				            <td>
				             <a class="btn btn-sm btn-primary glyphicon glyphicon-eye-open" href="{{ route('patient.show',$patient->id) }}"></a>
				            
				        </tr>
				    @endforeach
				    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->


@endsection