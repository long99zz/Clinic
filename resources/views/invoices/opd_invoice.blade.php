@extends('layouts.app')
@section('content')

<div class="col-lg-12 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Hoá đơn đăng ký khám</li>
		</ol>
	</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
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
                <div class="panel-heading"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Hoá đơn</div>
            <div class="panel-body">
				<div class="row">
					<div class="col-md-8">
						<!-- services -->
						
						<div class="row">
						{{Form::open(array('route'=>'opd.store', 'method'=>'post', 'class'=>'form-group'))}}

						<div class="col-md-6 form-group">
							<label>Bác sĩ</label>
							<select class="form-control select" name="doctor_id" id="doctor_id">
							<option>Chọn bác sĩ:</option>
							@foreach($doctors as $doctor)
			  				<option value="{{$doctor->id}}">{{$doctor->employee->last_name}} {{$doctor->employee->middle_name}} {{$doctor->employee->first_name}}</option>
			 		 		@endforeach
			 		 		</select>
	 		 			</div>
	 		 			<div class="col-md-6 form-group">
							<label>Bệnh nhân</label>
							<select class="form-control select" name="patient_id" id="patient_id" required>
							<option>Chọn bệnh nhân:</option>
							@foreach($patients as $patient)
	  						<option value="{{$patient->id}}">ID: {{$patient->id}}. {{$patient->last_name}} {{$patient->middle_name}} {{$patient->first_name}}</option>
	 		 				@endforeach
	 		 				</select>
	 		 			</div>
	 		 			
	 		 			<div class=" col-md-3 form-group">
								<label>Hình thức thanh toán</label>
								<select name="payment_type" class="form-control">
									<option>Tiền mặt</option>
									<option>Chi phiếu</option>
									<option>Thẻ </option>
								</select>
							</div>
							<div class=" col-md-3 form-group">
							<label>Mã hoá đơn:</label>
	                        <input type="text" class="form-control" name="invoice_no" value="{{$setting->invoice_prefix}}{{$invoice_no}}" readonly>
	                        </div>
	                        <div id="payment" style="display: none;">
	                       
		                        <div class="col-md-3 form-group">
								<label>Giảm giá :</label>
								<input type="number" name="discount"  placeholder="" class="form-control" id="discount"><br>
								</div>
								
		                        <div class="col-md-3 form-group">
								<label>Thanh toán:</label>
								<input type="number" name="cash"  placeholder="" class="form-control" id="cash" required><br>
								</div>
							</div>

							<input type="submit" id="submit" class="hidden">
							<div class="col-md-12 form-group" id="comment" style="display: none;">
								<input type="textarea" class="form-control" name="comment" placeholder="Comment..." >
							</div>
		 		 			{{Form::close()}}		

		 		 		</div>
		 		 		<div class="row">
	 		 			<div class="col-md-12">
	 		 			<div id="bill"></div>
	 		 			
	 		 			</div></div>
	 		 			</div>
	 		 			<div class="col-md-4">

							<h3 class='text-center'>Thanh toán</h3>
							<p>--------------------------------------------------------------------</p>
							<div class="row">
							<div class="col-md-6" id="calculateBtn" style="display: none">
	                            <button class="btn btn-primary" id="calculate"><span class="glyphicon glyphicon-ok"></span>Tính</button> <br><br>
	                            <span id="msg"></span><br>
		                        
                            </div>
                            <br>
                            <div class="col-md-12">
								<div id="tender"></div>
							</div>

		 		 			
		 		 			<div class="col-md-12" id="complete" style="display: none;">
		 		 			<p>--------------------------------------------------------------------</p>
		 		 				<button class="btn btn-success" id="complete">Hoàn thành</button>
		 		 				<a href="{{url('opd')}}" class="btn btn-default">Đặt lại</a>
		 		 				
		 		 			</div>	
						</div>
 		 			</div>
	 			</div>
 			</div>
 			
		</div>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function() {
  	$(".select").select2();

  	$('#doctor_id').on('change', function() {
            var doctor_id = $('#doctor_id').val();
            //$('#payment').hide();
            $('#tender').hide();
         	$('#complete').hide();
         	$('#comment').hide();
        	// $('#calculateBtn').hide();
			//$('#patient_id :selected').attr('selected', false);
            $('#bill').load({!! json_encode(url('/invoice/opd')) !!}+'/'+doctor_id);
            });

  	$('#patient_id').on('change', function(){
	    	var patient_id = $('#patient_id').val();
	    	$('#payment').show();
	    	$('#calculateBtn').show();
	    	//$('#patient').load({!! json_encode(url('/invoice/patient'))!!}+'/'+patient_id);

	    	
	    	
	    });
  	$('#complete').on('click', '#complete', function() 
			{
				$('#submit').click();

			});

    $('#calculate').click(function(){
       	$('#tender').hide();
        $('#complete').hide();
        var cash = $('#cash').val();
        var discount = $('#discount').val();
        var sub_total = $('#opd_charge').val();
        var tax = $('#tax_percent').val();
        if(sub_total.length)
        {
       
        if(cash > 0)
        {
        	if(discount)
        	{
    			$('.total_field').hide();
        	}

        	var total = sub_total - discount;
        	var tax_amount = total * tax /100;
        	var total_amount = total + tax_amount;
        	var tender_amount = cash - total_amount;
        	
    		if(tender_amount < 0)
    		{
    			$('#msg').show();
    			$("#msg").html("<div style='color:red;margin-bottom: 20px;'><span class='btn-sm alert-danger'>Thanh toán chưa đủ</span></div>");
    		}
    		else
    		{
    		$('#msg').hide();
        	$('#complete').show();
    		$('#comment').show();
    		$('#tender').html('<strong>Tổng phụ: '+ sub_total +'</strong><br><strong>Giảm giá:'+ discount + '</strong><br><b>------------------------------</b><br><strong>Trước thuế:' + total+'</strong><br><strong>Thuế('+ tax+'%): '+ tax_amount +'</strong><br><b>-----------------------------<b><br><strong>Tổng thu: '+ total_amount +'</strong><br><strong>Thanh toán: ' + cash + '</strong><br><strong>Hoàn lại:' + tender_amount+ '</strong>');
    		$('#tender').show();
    		}  
    	}
        else
        {
        	$('#msg').show();
        	$("#msg").html("<div style='color:red;margin-bottom: 20px;'><span class='btn-sm alert-danger'>Điền số tiền</span></div>");

        }
    }
    else
    {
    	$('#msg').show();
    	$("#msg").html("<div style='color:red;margin-bottom: 20px;'><span class='btn-sm alert-danger'>Chọn bác sĩ trước...</span></div>");

    }

});
   });
</script>

@endsection