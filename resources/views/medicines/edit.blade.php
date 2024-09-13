<div class="modal fade" id="editMedicine" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Cập nhật thuốc</h4>
      </div>
      {!! Form::open(['route' => 'medicine.updated', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="form-group">
	        <label>Tên thuốc:</label>
	        {!! Form::text('medicine_name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'name']) !!}
	    </div>
	    <div class="form-group">
	        <label>Đơn vị:</label>
	       <input type="text" name="unit" placeholder="" class="form-control" id="unit" required><br>
	    </div>
        <div class="form-group">
	        <label>Đơn giá:</label>
	       <input type="number" name="unit_price" placeholder="" class="form-control" id="unit_price" required><br>
	    </div>
		
    <div class="modal-footer">
          <button class="btn btn-danger" type="reset">Đặt lại</button>
           <button class="btn btn-success" type="submit">Lưu</button>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>
</div>
