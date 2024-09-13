@extends('layouts.app')
@section('content')
<div class="col-sm-12  main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Báo cáo hoá đơn</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if ($error = Session::get('errors'))        
<div class="alert alert-danger">
            <ul>
               
                <li>{{ $error }}</li>
           
            </ul>
        </div>
    @endif
    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					
						Báo cáo dịch vụ
					
					<div class="pull-right">Báo cáo từ: {{$total['starting_date']}}/{{$total['ending_date']}}</div></div>
					<div class="panel-body">
					<div class="row">
					<form action="{{route('account.service')}}" method="GET">
						<div class="col-md-3">
							<select name="service_id" class="form-control">
								<option value="">Chọn dịch vụ:</option>
								@foreach($services as $service)
									<option value="{{$service->id}}">{{$service->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<input type="text" class="datepicker form-control" placeholder="Từ ngày" name="starting_date" data-date-end-date="0d" >
						</div>

						<div class="col-md-3">
							<input type="text" class="datepicker1 form-control" placeholder="Đến ngày" name="ending_date" data-date-end-date="0d" >
						</div>
						<div class="col-md-3">
							<button class="btn btn-danger"><span class="glyphicon glyphicon-search"></span>Tìm kiếm</button>
						</div>
					</form>
					</div>
					</div>
					<div class="panel-footer">

					<table id="dataPrint" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Mã hoá đơn</th>
								<th>Tên dịch vụ</th>
								<th>Giá trị</th>
								<th>Date</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th><b>Tổng:</b></th>
								<th></th>
								<th><b>${{$total['total']}}<b></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
						
						<tbody>
						@foreach($invoices as $invoice)
						<tr>
							<td>{{$invoice->invoice->invoice_no}}</td>
							<td>{{$invoice->service_name}}</td>
							<td>${{number_format($invoice->amount, 2)}}</td>
							<!-- <td>{{$invoice->invoice->user->name}}</td> -->
							<td>{{$invoice->created_at}}</td>
						</tr>
						@endforeach

						<!-- <tr>
							<td><b>Total:</b></td>
							<td></td>
							<td>${{number_format($total['total'])}}</b></td>
							<td></td>
							<td></td>
						</tr> -->
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">


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