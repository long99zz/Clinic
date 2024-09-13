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
					@if($user)
						Báo cáo của {{ucfirst($user->name )}} 
					@else Tất cả báo cáo hoá đơn @endif
					<div class="pull-right">Báo cáo từ: {{$total['starting_date']}}/{{$total['ending_date']}}</div></div>
					<div class="panel-body">
					<div class="row">
					<form action="{{route('search.invoice')}}" method="GET">
						<div class="col-md-3">
							<select name="user_id" class="form-control">
								<option value="">Chọn người dùng:</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
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
							<button class="btn btn-danger"><span class="glyphicon glyphicon-search"></span>Tìm báo cáo</button>
						</div>
					</form>
					</div>
					</div>
					<div class="panel-footer">

					<table id="dataPrint" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Mã hoá đơn</th>
								<th>Tổng phụ</th>
								<th>Giảm giá</th>
								<th>Thuế</th>
								<th>Tổng thu</th>
								<th>Người dùng</th>
								<th>Ngày lập</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th><b>Tổng:</b></th>
								<th>{{number_format($total['sub_total'], 2)}}</th>
								<th>{{$total['discount']}}</th>
								<th>{{number_format($total['tax_amount'], 2)}}</th>
								<th><b>{{number_format($total['total_amount'])}}<b></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
						
						<tbody>
						@foreach($invoices as $invoice)
						<tr>
							<td>{{$invoice->invoice_no}}</td>
							<td>{{number_format($invoice->sub_total, 2)}}</td>
							<td>{{$invoice->discount}}</td>
							<td>{{number_format($invoice->tax_amount, 2)}}</td>
							<td>{{number_format($invoice->total_amount, 2)}}</td>
							<td>{{$invoice->user->name}}</td>
							<td>{{$invoice->created_at}}</td>
						</tr>
						@endforeach

						<tr>
							<td><b>Total:</b></td>
							<td>{{number_format($total['sub_total'], 2)}}</td>
							<td>{{$total['discount']}}</td>
							<td>{{number_format($total['tax_amount'], 2)}}</td>
							<td>{{number_format($total['total_amount'])}}</b></td>
							<td></td>
							<td></td>
						</tr>
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