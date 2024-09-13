<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
<style type="text/css">
	#print {
		
    margin: auto;
    width: 70%;
    border: 3px solid green;
    padding: 10px;
}
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
</style>
<div id="print">
	<div class="row">
	<div class="col-md-12"  align="center">
	<h3>{{$setting->name}}</h3>
			<strong>{{$setting->address}}</strong>
			<address>Điện thoại: {{$setting->contact}}</address>
	</div>
	<div class="col-md-6">
			<strong>Mã bệnh nhân: </strong>{{ $setting->patient_prefix}}{{$invoices->patient->id}}<br>
			<strong>Tên bênhj nhân: </strong>{{$invoices->patient->first_name}} {{$invoices->patient->last_name}}<br>
			<strong>Tuổi:</strong>{{ $invoices->patient->age}}<br>
			<strong>Giới tính:</strong>{{$invoices->patient->gender}}<br>
			<strong>Thanh toán:</strong> {{$invoices->payment_type}}<br>
	</div>
	<div class="col-md-6" align="right" >
			<strong>Ngày: </strong>{{$invoices->created_at}}<br>
			<strong>Mã hoá đơn:</strong>{{$invoices->invoice_no}}<br><br>
			<!-- <b>Duplicate Invoice</b> -->
	</div>
	
<br><br>
<div class="col-md-12">
	<table class="table">
		<thead>
			<tr>	
				<th>S.N.</th>
				<th>Particular</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; ?>
		@if($invoices->services)
		@foreach($invoices->serviceSales()->get() as $sales)
		<tr>
				<td>{{$i++}}</td>
				<td>{{$sales->service_name}}</td>
				<td>${{number_format($sales->amount, 2)}}</td>
			</tr>
		@endforeach
		@elseif($invoices->opd)
		@foreach($invoices->opd_sales()->get() as $sales)
		<tr>
				<td>{{$i++}}</td>
				<td>{{$sales->opd_name}}</td>
				<td>${{number_format($sales->opd_charge,2)}}</td>
			</tr>
		@endforeach
		@else
		@foreach($invoices->packageSales()->get() as $sales)
		<tr>
			<td>{{$i++}}</td>
			<td>{{$sales->package->name}}</td>
			<td>${{number_format($sales->package_price, 2)}}</td>
		</tr>
		@endforeach
		@endif
			<tr>
				<td></td><td></td><td><strong>Tổng phụ: </strong> {{$invoices->sub_total}}</td>
			</tr>

			<tr>
				<td></td><td></td><td><strong>Giảm giá: </strong> {{$invoices->discount}}</td>
			</tr>
			<tr>
				<td></td><td></td><td><strong>Thuế({{$setting->tax_percent}}%): </strong>{{$invoices->tax_amount}}</td>
			</tr>
			<tr>
				<td></td><td></td><td><strong>Tổng: </strong>{{$invoices->total_amount}}</td>
			</tr>
		</tbody>
		
	</table>
	</div>
		<div class="col-md-6">
			<strong>Người lập:</strong>{{ $invoices->user->name}}<br>
			{{date('Y-m-d')}}
		</div>
		<div class="col-md-6" align="right">
			<strong>Thanh toán:</strong> {{ $invoices->cash}}<br>
			----------------------------<br>
			<strong>Trả lại:</strong>  {{ $invoices->return}}<br>	
		</div><br>
		<div class="col-md-12">{{$setting->invoice_message}}</div>
	</div>
</div>
<br>
		<div align="center">
		<a href="{{url('/')}}" class="btn btn-primary" type='button' id='printbtn' onclick="Function()"><span class="glyphicon glyphicon-print"></span> In</a>
		</div>


<script>
function Function()
{
    window.print(); 
    window.focus();


}
</script>