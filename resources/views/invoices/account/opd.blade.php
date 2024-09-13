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
					
						Báo cáo khám 
						
					
					<div class="pull-right">Báo cáo từ ngày: {{$total['starting_date']}}/{{$total['ending_date']}}</div></div>
					<div class="panel-body">
					<div class="row">
					<form action="{{route('account.opd')}}" method="GET">
						<div class="col-md-3">
							<select name="doctor_id" class="form-control">
								<option value="">Chọn bác sĩ:</option>
								@foreach($doctors as $doctor)
									<option value="{{$doctor->id}}">{{$doctor->employee->last_name}} {{$doctor->employee->middle_name}} {{$doctor->employee->first_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<input type="text" class="datepicker form-control" placeholder="From Date" name="starting_date" data-date-end-date="0d" >
						</div>

						<div class="col-md-3">
							<input type="text" class="datepicker1 form-control" placeholder="To Date" name="ending_date" data-date-end-date="0d" >
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
								<th>Tên </th>
								<!-- <th>Phí khám</th> -->
								<th>Phí khám</th>
								<!-- <th>User</th> -->
								<th>Ngày</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th colspan="2"><b>Tổng:</b></th>
								<!-- <th><b>${{$total["doctor_fee"]}}<b></th> -->
								<th><b>${{$total['opd_charge']}}</th>
								<th></th>
								<th></th>

							</tr>
						</tfoot>
						
						<tbody>
						@foreach($invoices as $invoice)
						<tr>
							<td>{{$invoice->invoice->invoice_no}}</td>
							<td>{{$invoice->opd_name}}</td>
							<!-- <td>${{$invoice->doctor_fee}}</td> -->
							<td>${{$invoice->opd_charge}}</td>
							<!-- <td>{{$invoice->invoice->user->name}}</td> -->
							<td>{{$invoice->created_at}}</td>
						</tr>
						@endforeach

						<!-- <tr>
							<td><b>Tổng:</b></td>
							<td></td>
							<!-- <td>${{$total['doctor_fee']}}</b></td> -->
							<!-- <td>${{$total['opd_charge']}}</b></td>
							<td></td>
							<td></td> -->
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