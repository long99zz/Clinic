@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li class="active"><a href="/employee">Nhân sự</a></li>
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
                    {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Bảng nhân sự
					<a class="btn btn-success pull-right" data-toggle="modal" href="{{route('employee.create')}}"><span class="glyphicon glyphicon-plus"></span>Thêm nhân sự</a></div>
					<div class="panel-body">
						<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						    <thead>
				        <tr>
				            <th data-sortable="true">Mã nhân sự</th>
					        <th data-sortable="true">Tên</th>
					        <th data-sortable="true">Phân loại</th>
					        <th data-sortable="true">Số điện thoại</th>
					        <th data-sortable="true">Ngày làm việc</th>
					        <th data-sortable="true">Giờ làm</th>
					        <th data-sortable="true">Giờ nghỉ</th>
					        <th data-sortable="true">Thao tác</th>
						    </tr>
					    </thead>
					    <tbody>
				    	@foreach($employees as $employee)
				        <tr>
				            <td>{{ $employee->id}}</td>
				            <td>{{$employee->last_name}} {{$employee->middle_name}} {{$employee->first_name}}</td>
							<td>{{$employee->type}}</td>
				           	<td>{{$employee->phone}}</td>
				           	<td>{{$employee->working_day}}</td>
				    		<td>{{$employee->in_time}}</td>
				    		<td>{{$employee->out_time}}</td>
				            <td>
				             <a class="btn btn-sm btn-primary glyphicon glyphicon-eye-open" href="{{ route('employee.show',$employee->id) }}"></a>
				            
				        </tr>
				    @endforeach
				    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->
<script type="text/javascript">
$(document).ready(function() {
  $(".select").select2();
});
</script>
@endsection