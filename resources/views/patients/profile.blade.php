@extends('layouts.app')
@section('content')
@include('patients.partials.disease')
@include('patients.partials.edit')
@include('patients.partials.appointment')
@include('patients.partials.js')

<div class="col-lg-12 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Bệnh nhân</li>
			<li>Hồ sơ bệnh nhân</li>
		</ol>
	</div><br><!--/.row-->
	<!-- Modal -->
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif
@if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
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
				<div class="panel-heading">Tên bệnh nhân: {{$patient->last_name}} {{$patient->middle_name}} {{$patient->first_name}}
				<a class="btn btn-primary pull-right" data-toggle="modal" href="#editPatient"><span class="glyphicon glyphicon-edit"></span> Sửa bệnh nhân</a></div>
				<div class="panel-body">
				<div class="col-md-6">
				Điện thoại bệnh nhân: {{ $patient->phone}}<br>
				Địa chỉ bệnh nhân: {{$patient->location}}, {{$patient->state}}, {{$patient->district}}, {{$patient->country}}<br>
				Tuổi: {{$patient->age}}<br>
				Nhóm máu: {{$patient->blood_group}}<br>
				@if($patient->relative_name)
				Tên người thân: {{$patient->relative_name}}<br>
				Điện thoại người thân: {{$patient->relative_phone}}<br>
				@endif
				
				</div>
				<div class="col-md-6">
				<b>Giới tính: </b> {{$patient->gender}}<br>
				<b>Ngày sinh: </b> {{$patient->birth_date}}<br>
				<b>Tiền sử bệnh: </b> {{$patient->anamnesis}}<br>
				</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Lịch hẹn khám
				<a class="btn btn-primary pull-right" data-toggle="modal" href="#addAppointment"><span class="glyphicon glyphicon-plus"></span>Thêm lịch hẹn</a>

				<a class="btn btn-primary pull-right" style=" margin-right: 20px ;" data-toggle="modal" href="#addDisease"><span class="glyphicon glyphicon-plus"></span>Thêm kết quả khám</a>
		
			</div>
				<div class="panel-body">
				@if($patient->appointments->count())
				<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
				   	 	<thead>
				        <tr>
				        	<th data-sortable="true">Mã</th>
				            <th data-sortable="true">Tên lịch hẹn</th>
					        <th data-sortable="true">Tên bác sĩ</th>
					        <th data-sortable="true">Mô tả</th>
					        <th data-sortable="true">Thời gian</th>
					        <th>Status</th>
					        <th data-sortable="true">Thao tác</th>

						    </tr>
					    </thead>
					    <tbody>
					   
					    @foreach( $patient->appointments()->get() as $appointment)
					    <tr>
					    <td>{{$appointment->id}}</td>
					    <td>{{$appointment->name}}</td>
					    <td>{{$appointment->doctor->employee->last_name}} {{$appointment->doctor->employee->middle_name}}  {{$appointment->doctor->employee->first_name}}</td>
					    <td>{{$appointment->description}}</td>
					    <td>{{$appointment->appointment_date}} {{$appointment->time}}</td>
					    <td>
					    @if($appointment->status)
					   	<a class="btn-sm btn-success" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-ok"></span> Xác nhận</a>	
						@else
						<a class="btn-sm btn-warning" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-refresh"> </span> Đang chờ</a>
						@endif
					   </td>
					   <td> <a class="btn-sm btn-info" href="{{ route('appointment.index')}}"><span class=" glyphicon glyphicon-eye-open"> </span> Xem tất cả..</a>
                       </td>
                       </tr>
					   @endforeach
					   
					    </tbody>
					</table>
					@else
					<h3>Không có thông tin..</h3>
					@endif
				</div>
			</div>
		</div>

			<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Báo cáo bệnh nhân</div>
				<div class="panel-body">
				@if($patient->reports->count())
				<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
				   	 	<thead>
				        <tr>
				        	<th data-sortable="true">Mã</th>
				            <th data-sortable="true">Tên báo cáo</th>
					        <th data-sortable="true">Trạng thái</th>
					        <th data-sortable="true">Thao tác</th>
					    </tr>
					    </thead>
					    <tbody>
					   
					    @foreach( $patient->reports()->get() as $report)
					    <tr>
					    <td>{{$report->id}}</td>
					    <td>{{$report->report}}</td>
					   @if($report->status)
					    <td><span class="btn-sm btn-primary glyphicon glyphicon-ok">Xác nhận</span> </td>
					    @else
					    <td><span class="btn-sm btn-warning glyphicon glyphicon-refresh">Đang chờ </span> </td>
					    @endif
					   @if($report->report)
					    <td><a href="{{url('/reports/'.$report->report) }}" class="btn-sm btn-success" target="_blank"><span class=" glyphicon glyphicon-print">In</a></td>
					    @else
					    <td>Không phù hợp</td>
					    @endif
                       </tr>
					   @endforeach
					   
					    </tbody>
					</table>
					@else
					<h3>Không có thông tin..</h3>
					@endif
				</div>
			</div>
		</div>


</div>
</div>



<script>
        $(document).ready( function() {
            $('#doctorId').on('change', function() {
                var id = $('#doctorId').val();
                //ajax
              $('#available_time').load({!! json_encode(url('/days/')) !!}+'/'+id);
            });
             $( "#datepicker" ).datepicker();
                $('#datepicker').change(function(){
                	$("#datepicker").datepicker('hide')
                });
        });
    </script>


@endsection