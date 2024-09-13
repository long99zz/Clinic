<div class="modal fade" id="addDisease"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width: 50%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Thêm kết luận bệnh</h4>
      </div>
      {!! Form::open(array('route' => 'disease.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
      <div class="modal-body">
      <div class="row">
      <div class="col-md-6 form-group">
	        <label>Bệnh nhân:</label>
	         <input type="text" value=" {{$patient->last_name}} {{$patient->middle_name}} {{$patient->first_name}}" class="form-control" disabled="">
	        <input type="hidden" name="patient_id" value="{{$patient->id}}">
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
	    <div class="col-md-6 form-group">
                                <label>Thân nhiệt:</label>
                                {!! Form::text('temperature', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhịp tim:</label>
                                {!! Form::text('pulse_rate', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhịp thở:</label>
                                {!! Form::text('respiration_rate', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Huyết áp:</label>
                                {!! Form::text('blood_pressure', null, ['class' => 'form-control']) !!}
                            </div>
		<div class=" col-md-12 form-group">
			<label>Kết luận bệnh:</label>
		 	{!! Form::text('description', null, array('class' => 'form-control','size' => '5x3')) !!}
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
            });
                
        
        });
</script>

