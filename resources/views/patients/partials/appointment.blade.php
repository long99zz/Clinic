
<div class="modal fade" id="addAppointment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Thêm lịch hẹn</h4>
      </div>
      {!! Form::open(array('route' => 'appointment.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
	    <div class="modal-body">
	    <div class="row">
	    <div class=" col-md-6 form-group">
	     <label>Bệnh nhân:</label>
	    <input type="text" value="{{$patient->last_name}} {{$patient->middle_name}} {{$patient->first_name}}" class="form-control" disabled="">
	    <input type="hidden" name="patient_id" value="{{$patient->id}}">
	    </div>
	     <div class=" col-md-6 form-group">
	        <label>Bác sĩ:</label>
	        <select name="doctor_id" class="form-control" required id="doctorId">
	        <option>Chọn bác sĩ</option>
	            @foreach($doctors as $doctor)
	                <option value="{{$doctor->id}}">{{ $doctor->employee->last_name}} {{ $doctor->employee->middle_name}} {{ $doctor->employee->first_name}}</option>
	            @endforeach
	        </select>
	    </div>
	    <div class=" col-md-6 form-group">
			<label>Giờ khám:</label>
			<div id="available_time">
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label>Ngày hẹn:</label>
			<input type="text" name="appointment_date" id="datepicker" class="form-control">
		</div>
		</div>
      	<div class=" col-md-6 form-group">
			<label>Tên:</label>
		 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		
		<div class=" col-md-6 form-group">
			<label>Mô tả:</label>
		 	{!! Form::text('description', null, array('class' => 'form-control')) !!}
		</div>
		
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
          <button class="btn btn-danger" type="reset">Đặt lại</button>
           <button class="btn btn-success" type="submit">Lưu</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
</div>

<!-- Edit Appointment modal -->
