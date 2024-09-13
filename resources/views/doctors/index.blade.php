@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Phí khám</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
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
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Bảng phí khám</div>
					<div class="panel-body">
						<table class="table table-bordered table-condensed">
						    <thead>
						    <tr>
						        <th>Mã</th>
						        <th>Tên</th>
								<th>Trình độ</th>
						        <th>Số điện thoại</th>
						        <th>Phí khám</th>
						       
						        <th>Thao tác</th>

						    </tr>
						    </thead>
						     <tbody>
				    	@foreach($doctors as $doctor)
				        <tr >
				            <td>{{ $doctor->id}}</td>
				            <td>{{ $doctor->employee->last_name}} {{$doctor->employee->middle_name}} {{$doctor->employee->first_name}}</td>
							<td>{{ $doctor->employee->education}}</td>
				            <td>{{ $doctor->employee->phone}}</td>
				            <td>{{$doctor->opd_charge}}</td>
				           
				    		
				            <td>
				            <a class="btn-sm btn-primary" href="{{ route('doctor.show',$doctor->id) }}"> <span class= "glyphicon glyphicon-eye-open"></span> Xem </a>  
						    </td>
				        </tr>
				    @endforeach
				    </tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Thêm phí khám</div>
					<div class="panel-body">
					 {!! Form::open(array('route' => 'doctor.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
					 <div class="form-group">
				      	<label>Chọn bác sĩ:</label>
				      	<select name="employee_id" class="form-control" required>
				      	<option></option>
				      	@foreach($employees as $employee)      	
				      	<option value="{{$employee->id}}">{{$employee->last_name}} {{$employee->middle_name}} {{$employee->first_name}}</option>
				      	@endforeach
				      	</select>
				    </div>
					<!-- <div class=" form-group">
							<label>Doctor Charge:</label>
						 	<input type="number" name="fee" class="form-control" required="">
					</div> -->
					<div class=" form-group">
							<label>Phí khám:</label>
							<input type="number" name="opd_charge" class="form-control" required="">
					</div>
					<div class="form-group">
			    	<label for="with_tax">Có thuế</label>
			    	<input type="checkbox" name="with_tax" id="with_tax" >
			    </div>
      				</div>
      			<div class="panel-footer">
				
           		<button class="btn btn-success" type="submit"><span class='glyphicon glyphicon-plus'></span>Thêm</button>
           		<button class="btn btn-danger pull-right" type="reset">Đặt lại</button>
           		</div>
           		{!! Form::close()!!}
				</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->
<script type="text/javascript">
	$('#edit_doctor').click(function()
	{
		$('.add').hide();
		$('.edit').show();

	});
</script>

@endsection