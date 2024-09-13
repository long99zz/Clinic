<div class="modal fade" id="addMedicine"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Thêm thuốc</h4>
      </div>
      {!! Form::open(array('route' => 'medicine.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
     <div class="modal-body">
        <div class="form-group col-md-8">
	        <label>Tên thuốc:</label>
	        <input type="text" name="medicine_name"  placeholder="" class="form-control" id="unit" required><br
	    </div>
	    <div class="form-group col-md-8">
	        <label>Đon vị:</label>
	     <input type="text" name="unit"  placeholder="" class="form-control" id="unit" required><br>
	    </div>
         <div class="form-group col-md-8">
	        <label>Đon giá:</label>
	         <input type="number" name="unit_price"  placeholder="" class="form-control" id="unit_price" required><br>
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
 <!-- <script>
        $(document).ready( function() {
            $('#doctor_select').on('change', function() {
                var id = $('#doctor_select').val();
                //ajax
            });
                
        
        });
</script> -->

