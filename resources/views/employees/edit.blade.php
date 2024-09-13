@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li class="active"><a href="{{route('employee.index')}}"> Nhân sự</a></li>
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
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Sửa thông tin nhân sự
					<a class="btn btn-primary pull-right" href="{{route('employee.index')}}"><span class="glyphicon glyphicon"></span>Quay lại</a></div>
					<div class="panel-body">
          			
      				<div class="container">
	     {!! Form::model($employee, ['enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['employee.update', $employee->id]]) !!}
	     <div class="container">
	      <div class="row">
	      	<div class=" col-md-4 form-group">
				<label>Họ:</label>
			 	{!! Form::text('last_name', null, array('class' => 'form-control', 'required'=>'required')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Têm đệm:</label>
			 	{!! Form::text('middle_name', null, array('class' => 'form-control')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Tên:</label>
			 	{!! Form::text('first_name', null, array('class' => 'form-control', 'required'=>'required')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Email:</label>
			 	{!! Form::email('email', null, array('class' => 'form-control')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Số điện thoại:</label>
			 	{!! Form::input('number','phone' ,null, array('class' => 'form-control', 'required'=>'required')) !!}
			</div>
				<div class=" col-md-4 form-group">
				<label>Phân loại:</label>
			 	<select class="form-control" name="type" required >
			 	
			 	<option>{{$employee->type}}</option>
			 	<option>Bác sĩ</option>
				<option>Tiếp tân</option>
				<option>Dược sĩ</option>
				<option>Kế toán</option>
				<option>Khác</option>
			 	</select>
			</div>
			<div class=" col-md-4 form-group">
				<label>Địa chỉ:</label>
				{!! Form::textarea('address', null, array('class' => 'form-control', 'size' => '5x3' ,'required'=>'required')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Trình độ:</label>
				{!! Form::textarea('education', null, array('class' => 'form-control', 'size' => '5x3')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Mô tả:</label>
				{!! Form::textarea('description', null, array('class' => 'form-control', 'size' => '5x3')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Chứng chỉ:</label>
				{!! Form::textarea('certificate', null, array('class' => 'form-control', 'size' => '5x3')) !!}
			</div>
			<!-- <div class=" col-md-4 form-group">
				<label>Speciality:</label>
				{!! Form::textarea('speciality', null, array('class' => 'form-control', 'size' => '5x3')) !!}
			</div> -->
		    <div class=" col-md-4 form-group">
				<label>Giờ làm:</label>
			 	{!! Form::text('in_time', null, array('class' => 'form-control timepicker' , 'required'=>'required')) !!}
			</div>
			<div class=" col-md-4 form-group">
				<label>Giờ nghỉ:</label>
			 	{!! Form::text('out_time', null, array('class' => 'form-control timepicker', 'required'=>'required')) !!}
			</div>
			<div class="row"> 
<			<div class=" col-md-6 form-group">
		        <label>Ngày làm việc:</label>
		        <select class="col-md-4" id="working_day" name="working_day[]" multiple="multiple">
		        <option value="Chủ Nhật">Chủ Nhật</option>
		        <option value="Thứ Hai">Thứ Hai</option>
		        <option value="Thứ Ba">Thứ Ba</option>
		        <option value="Thứ Tư">Thứ Tư</option>
		        <option value="Thứ Năm">Thứ Năm</option>
		        <option value="Thứ Sáu">Thứ Sáu</option>
		        <option value="Thứ Bảy">Thứ Bảy</option>   
		        </select>
		    </div>
			<!-- <div class=" col-md-6 form-group">
		        <label>Chuyên khoa:</label>
		        <select name="department_id" class="form-control" required >
		        <option value="{{$employee->department_id}}">{{$employee->department->name}}</option>
		            @foreach($departments as $department)
		                <option value="{{$department->id}}">{{ $department->name}}</option>
		            @endforeach
		        </select>
		    </div> -->
			</div>
			
			
	      </div>
	    <div class="modal-footer">
	    <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
	        <button class="btn btn-success" type="submit">Lưu</button>
	        {{Form::close()}}
	    <a class="btn btn-danger pull-left" id="delete_employee"><span class="glyphicon glyphicon-remove "></span>Xoá</a>
	        
	    </div>
	    
	  </div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<div class="modal fade" id="employee_delete"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Xoá nhân sự</h4>
      </div>
       {!! Form::open(['method' => 'DELETE','route' => ['employee.destroy', $employee->id]]) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Bạn có muốn xoá nhân sự này không?</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Không</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-remove'></span> Có</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
<script type="text/javascript">
	$('#working_day').ready(function(){
		$('#working_day').select2();
	})
	$('#delete_employee').click(function()
	{
		$('#employee_delete').modal('show');
		$('#editEmployee').modal('hide');
	})
</script>
@stop
