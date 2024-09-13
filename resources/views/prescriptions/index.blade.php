@extends('layouts.app')

@section('content')
<div class="col-md-12 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Đơn thuốc</li>
			<li>Danh sách đơn thuốc</li>
		</ol>
	</div><br><!--/.row-->

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
				<div class="panel-heading">Danh Sách Đơn Thuốc<a class="btn btn-success pull-right" href="{{ route('prescriptions.add') }}"><span class="glyphicon glyphicon-plus"></span> Thêm đơn thuốc</a></div>
				<div class="panel-body">
					<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Mã Đơn Thuốc</th>
								<th>Bệnh Nhân</th>
								<th>Bác Sĩ</th>
								<th>Thao Tác</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($prescriptions as $prescription)
								<tr>
									<td>{{ $prescription->id }}</td>
									<td>{{ $prescription->patient->last_name }} {{ $prescription->patient->middle_name }} {{ $prescription->patient->first_name }}</td>
									<td>{{ $prescription->doctor->employee->last_name }} {{ $prescription->doctor->employee->middle_name }} {{ $prescription->doctor->employee->first_name }}</td>
									<td>
										<a href="{{ route('prescriptions.show', $prescription->id) }}" class="btn btn-info">Xem</a>
										<a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-primary">Sửa</a>
										<form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" style="display:inline-block;">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-danger">Xóa</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->	
</div><!--/.main-->

@endsection
