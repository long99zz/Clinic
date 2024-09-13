<div class="modal fade" id="addAppointment"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width: 50%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Thêm lịch hẹn</h4>
      </div>
      {!! Form::open(array('route' => 'appointment.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
      <div class="modal-body">
      <div class="row">
      <div class="col-md-6 form-group">
	        <label>Bệnh nhân:</label>
	        <select name="patient_id" class="form-control select2" style="width:100%" required>
	        <option></option>
	            @foreach($patients as $patient)
	                <option value="{{$patient->id}}">ID:{{$setting->patient_prefix}}{{$patient->id}} {{ $patient->last_name}} {{ $patient->middle_name}} {{ $patient->first_name}}</option>
	            @endforeach
	        </select>
	    </div>
	     <div class=" col-md-6 form-group">
	        <label>Bác sĩ:</label>
	        <select name="doctor_id" class="form-control" id="doctor_select">
	        <option></option>
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
			<input type="text" name="appointment_date" class="form-control datepicker1"  data-date-start-date="0d">
		</div>
		</div>
      	<div class=" col-md-6 form-group">
			<label>Tên:</label>
		 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		
		<div class=" col-md-6 form-group"></div>
		
		<div class=" col-md-6 form-group">
			<label>Mô tả:</label>
		 	{!! Form::text('description', null, array('class' => 'form-control')) !!}
		</div>
		
      </div>
    <div class="modal-footer">
          <button class="btn btn-danger" type="reset">Đặt lại</button>
           <button class="btn btn-success" type="submit">Lưu</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
</div>
 <script>
        $(document).ready( function() {
            $('#doctor_select').on('change', function() {
                var id = $('#doctor_select').val();
                //ajax
              $('#available_time').load({!! json_encode(url('/days/')) !!}+'/'+id);
            });
                
        
        });
</script>

