<!-- Edit Modal -->
<div class="modal fade" id="editPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width: 75%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Sửa bệnh nhân</h4>
      </div>
      {!! Form::model($patient, ['enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['patient.update', $patient->id]]) !!}
      <div class="modal-body">
      <div class="row">
		<div class=" col-md-4 form-group">
			<label>Họ:</label>
		 	{!! Form::text('last_name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Tên đệm:</label>
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
			<label>Điện thoại:</label>
		 	{!! Form::input('number','phone' ,null, array('class' => 'form-control')) !!}
		</div>
		 <div class=" col-md-4 form-group">
	        <label>Giới tính:</label>
	        <select name="gender" class="form-control" required>
	        <option value="Nam">Nam</option>
	        <option value="Nữ">Nữ</option>
	        <option value="Khác">Khác</option>
	        </select>
	    </div>
	     <!-- <div class=" col-md-4 form-group">
	        <label>Marital Status:</label>
	        <select name="marital_status" class="form-control">
	        @if($patient->marital_status)
	        <option value="{{$patient->marital_status}}">{{$patient->marital_status}}</option>
	        @else
	        <option></option>
	        @endif
	        <option value="married">Married</option>
	        <option value="single">Single</option>
	        <option value="other">Other</option>
	        </select>
	    </div> -->
	      <div class=" col-md-4 form-group">
	        <label>Nhóm máu:</label>
	        <select name="blood_group" class="form-control">
	        @if($patient->blood_group)
	        <option value="{{$patient->blood_group}}">{{$patient->blood_group}}</option>
	        @else
	        <option value="">Select</option>
	        @endif
	        <option>A+</option>
	        <option>A-</option>
	        <option>B+</option>
	        <option>B-</option>
	        <option>AB+</option>
	        <option>AB-</option>
	        <option>O+</option>
	        <option>O-</option>
	        </select>
	    </div>
		<div class=" col-md-4 form-group">
			<label>Ngày sinh:</label>
			{!! Form::text('birth_date', null, array('class' => 'form-control datepicker1' , 'id'=>'nepaliDate5')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Tuổi:</label>
		 	{!! Form::input('number','age' ,null, array('class' => 'form-control','required'=>'required')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Tên người thân:</label>
		 	{!! Form::text('relative_name', null, array('class' => 'form-control')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Điện thoại người thân:</label>
		 	{!! Form::input('number','relative_phone' ,null, array('class' => 'form-control')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Tỉnh(Thành phố):</label>:</label>
		 	{!! Form::text('country', '', array('class' => 'form-control')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Huyện(Quận):</label>
		 	{!! Form::text('district', '', array('class' => 'form-control')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Xã(Phường):</label>
		 	{!! Form::text('state', '', array('class' => 'form-control')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Địa chỉ:</label>
			{!! Form::textarea('location', null, array('class' => 'form-control','required'=>'required','size' => '5x3')) !!}
		</div>
		
		<div class=" col-md-4 form-group">
			<label>Nghề nghiệp:</label>
			{!! Form::textarea('occupation', null, array('class' => 'form-control', 'size' => '5x3')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Miêu tả:</label>
			{!! Form::textarea('description', null, array('class' => 'form-control', 'size' => '5x3')) !!}
		</div>
		<div class=" col-md-4 form-group">
			<label>Tiền sử bệnh:</label>
			{!! Form::textarea('anamnesis', null, array('class' => 'form-control', 'size' => '5x3')) !!}
		</div>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
          <button class="btn btn-danger" type="reset">Đặt lại</button>
           <button class="btn btn-success" type="submit">Lưu</button>
           {{Form::close()}}
     @permission('patient.destroy')
    {!! Form::open(['method' => 'DELETE','route' => ['patient.destroy', $patient->id],'id' =>'deleteConfirm','style'=>'display:inline','class'=>'pull-left']) !!}
     <button type="submit" name="" class="btn  btn-danger"><span class="glyphicon glyphicon-remove"></span> Xoá</button>
   
    {!! Form::close() !!}
     
     @endpermission
    </div>
    
  </div>
</div>
</div>
</div>
