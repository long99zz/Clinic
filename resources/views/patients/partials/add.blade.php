<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:75%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Thêm bệnh nhân</h4>
      </div>
      {!! Form::open(array('route' => 'patient.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
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
            {!! Form::text('phone', null, array('class' => 'form-control')) !!}
        </div>
         <div class=" col-md-4 form-group">
            <label>Giới tính:</label>
            <select name="gender" class="form-control" required>
            <option>Nam</option>
            <option>Nữ</option>
            <option>Khác</option>
            </select>
        </div>
         <!-- <div class=" col-md-4 form-group">
            <label>Marital Status:</label>
            <select name="marital_status" class="form-control" required>
            <option>Married</option>
            <option>Single</option>
            <option>Other</option>
            </select> -->
        </div>
          <div class=" col-md-4 form-group">
            <label>Nhóm máu:</label>
            <select name="blood_group" class="form-control">
            <option value="">Chọn</option>
            <option>A+</></option>
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
            {!! Form::date('birth_date', null, array('class' => 'form-control')) !!}
        </div>
        <div class=" col-md-4 form-group">
            <label>Tuổi:</label>
            {!! Form::number('age', null, array('class' => 'form-control','required'=>'required')) !!}
        </div>
        <div class=" col-md-4 form-group">
            <label>Tên người thân:</label>
            {!! Form::text('relative_name', null, array('class' => 'form-control')) !!}
        </div>
        <div class=" col-md-4 form-group">
            <label>Điện thoại người thân:</label>
            {!! Form::text('relative_phone', null, array('class' => 'form-control')) !!}
        </div>
        <div class=" col-md-4 form-group">
            <label>Tỉnh(Thành phố):</label>
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
            {!! Form::textarea('location', '', array('class' => 'form-control','required'=>'required','size' => '5x3')) !!}
        </div>
        
        <div class=" col-md-4 form-group">
            <label>Nghề nghiệp:</label>
            {!! Form::textarea('occupation', null, array('class' => 'form-control', 'size' => '5x3')) !!}
        </div>

        <div class=" col-md-4 form-group">
            <label>Mô tả:</label>
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
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
</div>
