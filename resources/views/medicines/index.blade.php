@extends('layouts.app')
@section('content')
@include('medicines.add')
@include('medicines.edit')
@include('medicines.js')
<div class="col-lg-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li>Danh sách thuốc</li>
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
			<div class="panel-heading">Bảng danh sách thuốc<a class="btn btn-success pull-right" data-toggle="modal" href="#addMedicine"><span class="glyphicon glyphicon-plus"></span>Thêm thuốc</a></div>
			<div class="panel-body">
			@if($medicines->count())
				<table id="example" class="table table-bordered table-striped table-condensed" cellspacing="0" width="100%">
			    	<thead>
				        <tr>
			            	<th data-sortable="true">Mã</th>
					        <th data-sortable="true">Tên thuốc</th>
					        <th data-sortable="true">Đơn vị</th>
					        <th data-sortable="true">Đơn giá</th>
					        <th data-sortable="true">Thao tác</th>
				        </tr>
					</thead>
					<tbody>
					@foreach($medicines as $key => $medicine)
				    	<tr>
				    	<td>{{$medicine->id}}</td>
				    	<td>{{$medicine->medicine_name}}</td>
				    	<td>{{$medicine->unit}}</td>
				    	<td>{{$medicine->unit_price}}</td>
						
				    	<td><button class="edit-medicine btn btn-primary" data-id="{{$medicine->id}}" data-name="{{$medicine->medicine_name}}" data-unit="{{$medicine->unit}}" data-unit_price="{{$medicine->unit_price}}"><span class="glyphicon glyphicon-edit"></span> Sửa</button>
                    	@permission('medicine.delete')
				        <button class="delete-modal btn btn-danger" data-info="{{$medicine->id}}" id="deleteConfirm"><span class="glyphicon glyphicon-trash"></span> Xoá</button>
				        @endpermission
				        </td>
				    	</tr>
				    @endforeach
					</tbody>
				</table>
			@else
				<h3 align="center">Không tìm thấy danh sách thuốc</h3>
			@endif
			</div>
		</div>
	</div>
</div><!--/.row-->	
</div><!--/.main-->

<script>
    $(document).on('click', '.edit-medicine', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var unit = $(this).data('unit');
        var unit_price = $(this).data('unit_price');

        $('#editMedicine #id').val(id);
        $('#editMedicine #name').val(name);
        $('#editMedicine #unit').val(unit);
        $('#editMedicine #unit_price').val(unit_price);

        $('#editMedicine').modal('show');
    });
</script>

@endsection
