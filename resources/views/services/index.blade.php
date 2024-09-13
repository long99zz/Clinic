@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li>Dịch vụ</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách dịch vụ<a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">Quay lại <span class="glyphicon glyphicon-share-alt"></span></a></div>
					<div class="panel-body">
						<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
				        <tr>
				            <th >ID</th>
				            <th >Dịch vụ</th>
				            <th>Đơn giá</th>
				            <th >Thao tác</th>
				            
				        </tr>
				    	</thead>
				    	<tbody>
				    	@foreach($services as $service)
				        <tr class="sevice{{$service->id}}">
				            <td>{{ $service->id}}</td>
				            <td>{{ $service->name}}</td>
				            <td>{{ $service->amount}}</td>
				           <td>
                           <button style="margin-right: 5px" class="btn-sm btn-info edit_service" data-info="{{$service->id}},{{$service->name}},{{$service->amount}}"><span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <button class="btn-sm btn-danger" id="delete_service"  data-id="{{$service->id}}"><span class="glyphicon glyphicon-remove "></span></button>
                            </td>
				        </tr>
				    	@endforeach
				    	</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4 add">
			<div class="panel panel-default">
				<div class="panel-heading">Thêm dịch vụ</div>
				<div class="panel-body">
				 {!! Form::open(array('route' => 'service.add','method'=>'POST')) !!}
				 <div class="form-group">
			<label>Tên dịch vụ:</label>
		 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		<div class="form-group">
			<label>Đơn giá:</label>
		 	{!! Form::text('amount' ,null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
	    <div class="form-group">
	    	<label for="with_tax">Thuế</label>
	    	<input type="checkbox" name="with_tax" id="with_tax" checked="">
	    </div>

		</div>
		<div class="panel-footer">
		
   		<button class="btn btn-success" type="submit"><span class='glyphicon glyphicon-plus'></span>Thêm</button>
   		<button class="btn pull-right" type="reset">Đặt lại</button>
   		</div>
   		{!! Form::close()!!}
   		</div>
				
		</div>

		<div class="col-md-4 edit" style="display: none">
		<div class="panel panel-default">
			<div class="panel-heading">Sửa</div>
			<div class="panel-body">
			{!! Form::open(array('route' => 'service.edit','method'=>'POST' )) !!}
			<input name="id" type="name" class="hidden form-control" id="id" >
			<div class="form-group">
				<label>Tên dịch vụ:</label>
		 		{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required', 'id'=>'name')) !!}
			</div>
			<div class="form-group">
				<label>Đơn giá:</label>
				<input type="text" name="amount" id="amount" required class="form-control">
			</div>

		    <div class="form-group">
		    	<label for="with_tax">Thuế</label>
		    	<input type="checkbox" name="with_tax" id="with_tax" checked="">
	    	</div>
			</div>
				<div class="panel-footer">
				<a class="btn btn-danger pull-right" id="cancel" >Huỷ</a>
           		<button class="btn btn-success" type="submit"><span class='glyphicon glyphicon-edit'></span>Sửa</button>
           		</div>
           		{!! Form::close()!!}
        </div>
				
		</div>

		</div><!--/.row-->	
</div><!--/.main-->
<div class="modal fade" id="user_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete Service</h4>
      </div>
      {!! Form::open(array('route' => 'service.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Bạn có muốn xoá dịch vụ này?</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Không</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-ok'></span> Có</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
<script type="text/javascript">
$('#cancel').click(function(){
	 	$('.edit').hide();
        $('.add').show();
})
	$(document).on('click', '.edit_service', function() {
        
        $('.add').hide();
        $('.edit').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);

        var amount = details[2];
        var tax = {{$setting->tax_percent/100}};
        var tax_amount = amount * tax;
        var total = parseFloat(amount) + parseFloat(tax_amount);
        total = total.toFixed();
        $('#amount').val(total);
    }

    $(document).on('click', '#delete_service', function() 
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#user_delete').modal('show');
    });
     $(document).ready(function() {
    $('#dataPrint').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy',
          'csv',
          'print' 
        ]
    } );
} );

</script>
@endsection