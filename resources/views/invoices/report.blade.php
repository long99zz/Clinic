@extends('layouts.app')
@section('content')
<div class="col-sm-12  main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Invoice Report</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if ($error = Session::get('error'))        
<div class="alert alert-danger">
            <ul>
               {{ $error }}
            </ul>
        </div>
    @endif
    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Tổng thu nhập</div>
					<div class="panel-body">
					<div class="row">
					<form action="{{route('search.invoice')}}" method="GET">
						<div class="col-md-3">
							<input type="text" class="datepicker form-control" placeholder="Từ ngày" name="starting_date" data-date-end-date="0d" >
						</div>

						<div class="col-md-3">
							<input type="text" class="datepicker1 form-control" placeholder="Đến ngày" name="ending_date" data-date-end-date="0d" >
						</div>
						<div class="col-md-3">
							<button class="btn btn-danger"><span class="glyphicon glyphicon-search"></span>Tìm hoá đơn</button>
						</div>
					</form>
					</div>
					</div>
					<div class="panel-footer">

					<table id="dataPrint" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Mã hoá đơn</th>
								<th>Thanh toán</th>
								<th>Tổng phụ</th>
								<th>Giảm giá</th>
								<th>Thuế</th>
								<th>Tổng thu</th>
								<th>Ngày</th>
								<th>Trả lại</th>
								
								<th>In lại</th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($invoices as $invoice)
							<tr>
							<td>{{$invoice->invoice_no}}</td>
							<td>{{$invoice->payment_type}}</td>
							<td>{{number_format($invoice->sub_total, 2)}}</td>
							<td>{{$invoice->discount}}</td>
							<td>{{number_format($invoice->tax_amount, 2)}}</td>
							<td>{{number_format($invoice->total_amount, 2)}}</td>
							<td>{{$invoice->created_at}}</td>
							@if ($invoice->invoiceReturns()->get()->count())
								@foreach($invoice->invoiceReturns()->get() as $return)
									<td>Return: ${{$return->return_amount}}</td>
								@endforeach
							@else
							<td><a class="btn btn-sm btn-primary invoiceReturn" data-return="{{$invoice->id}}, {{$invoice->invoice_no}}, {{number_format($invoice->total_amount)}}"><span class="glyphicon glyphicon-share-alt"></span>Hoá đơn trả lại</a>
							</td>
							@endif
							
							<td>
								<a href="{{route('invoice.duplicate', $invoice->id)}}" class=" btn-sm btn btn-primary">In lại hoá đơn</a>
							</td>
							
							</tr>
						@endforeach
						</tbody>
						<tr>
							<th>Tổng:</td>
							<th></th>
							<th>${{number_format($total['sub_total'], 2)}}</th>
							<th>${{$total['discount']}}</th>
							<th>${{number_format($total['tax_amount'], 2)}}</th>
							<th>${{number_format($total['total_amount'], 2)}}</th>
							
							<td>Complete</td>
						</tr>
						
						
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="modal fade" id="returnInvoice" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:50%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Trả lại hoá đơn</h4>
      </div>
      {!! Form::open(array('route' => 'invoice.return','method'=>'POST')) !!}
      <div class="modal-body">
      <div class="row">
      <input type="hidden" name="id" id="id">
	      	<div class="col-md-12 form-group">
	      	<label>Mã hoá đơn:</label>
	      		<input type="text" name="invoice_no" id="invoice_no" disabled="" class="form-control">
	      	</div>

	      	<div class="col-md-12 form-group">
	      		<label>Tổng giá trị($):</label>
	      		<input type="text" name="amount" id="amount" readonly="" class="form-control">
	      	</div>

	      	<div class="col-md-12 form-group">
      			<label>Số tiền trả lại:</label>
      			<input type="number" name="return_amount"  required="" class="form-control">
      		</div>

      		<div class="col-md-12 form-group">
      			<label>Lí do trả lại:</label>
      			<input type="text" name="reason"  required="" class="form-control">
      		</div>
      </div>
       <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
          <button class="btn btn-danger" type="reset">Đặt lại</button>
           <button class="btn btn-success" type="submit">Lưu</button>
    </div>
    {{Form::close()}}
  </div>
<script type="text/javascript">
	$(document).ready(function() {
    	$('.invoiceReturn').on('click', function() {
	        $('#returnInvoice').modal('show');
	        var stuff = $(this).data('return').split(',');
	        fillmodalData(stuff)
    	});
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#invoice_no').val(details[1]);
        $('#amount').val(details[2]);
    }

    $(document).ready(function() {
    $('#dataPrint').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        
        ]

    } );
} );

</script>
@endsection