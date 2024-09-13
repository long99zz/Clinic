@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li>Gói khám</li>
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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Bảng gói khám<a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">
					Quay lại <span class="glyphicon glyphicon-share-alt"></span></a></div>
					<div class="panel-body">
					@if($packages->count())
						<table id="example" class="table table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
				        <tr>
				           <th>S.n</th>
						   <th>Tên gói khám</th>
						   <th>Xét nghiệm</th>
						   <th>Giá</th>
						   <th>Thao tác</th>
				            
				        </tr>
				    	</thead>
				    	<tbody>

						<?php $i=1;?>
						@foreach($packages as $package)

							<tr>
								<td>{{$i++}}</td>
								<td>{{$package->name}}</td>
								<td>
						    		@foreach($package->packageTests()->get() as $package_test)
						    			<li>{{$package_test->test->name}}<a class="btn-sm" id="test_delete" data-id="{{$package_test->id}}"><span class="glyphicon glyphicon-remove"></span></a></li>
						    		@endforeach
						    	</td> 
						    	<td>${{$package->price}}</td>	
								<td>
                           <button id="package_edit" class="btn-sm btn-info" data-edit="{{$package->id}}, {{$package->name}}, {{$package->description}}, {{$package->price}}, {{$package->status}}"><span class="glyphicon glyphicon-edit" ></span>
                            </button>

                             <button class="btn-sm btn-danger" data-package="{{$package->id}}" id="package_delete"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
							</tr>
						     </td>
				        </tr>
				    @endforeach
				    </tbody>
					</table>
					@endif

					</div>
				</div>
			</div>
			<div class="col-md-4 add">
			<div class="panel panel-default">
				<div class="panel-heading">Thêm gói khám</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'package.store','method'=>'POST')) !!}
			    <div class=" form-group">
					<label>Tên gói khám:</label>
				 	{!! Form::text('name', null, array('class' => 'form-control')) !!}
				</div>
				<div class="form-group">
					<label>Mô tả:</label>
					<input type="text" name="description" class="form-control">
				</div>
				<div class="form-group">
		      	<label>Chọn các xét nghiệm:</label>
			        <select name="test_id[]" class="form-control select" required style="width:100%" multiple="">
			        <option></option>
			            @foreach($tests as $test)
			                <option value="{{$test->id}}" data-name="{{$test->name}}">{{ $test->name}}</option>
			            @endforeach
			        </select>
			    </div>
			    <div class="form-group">
			    	<label>Price:</label>
			    	<input type="text" name="price" class="form-control" required="">
			    </div>
			     <div class="form-group">
	    	<label for="with_tax">Có thuế</label>
	    	<input type="checkbox" name="with_tax" id="with_tax" >
	    </div>
			    </div>
			    <div class="panel-footer">
				<button class="btn btn-success" type="submit"><span class='glyphicon glyphicon-edit'></span>Thêm</button>
				<button class="btn btn-default pull-right" type="reset">Đặt lại</button>
           		</div>
           		{!! Form::close()!!}
			</div>
		</div>
		<!-- Edit Test -->
		<div class="col-md-4 edit" style="display: none">
			<div class="panel panel-default">
				<div class="panel-heading">Sửa gói khám</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'package.edit','method'=>'POST' )) !!}
				
				<input name="id" type="name" class="hidden form-control" id="id" >
			    <div class=" form-group">
					<label>Tên gói khám:</label>
				 	{!! Form::text('name', null, array('class' => ' form-control',  'id'=>'name')) !!}
				</div>
				<div class="form-group">
					<label>Description:</label>
					<input type="text" name="description" class="form-control" id="description">
				</div>
			    <div class="form-group">
			    	<label>Giá:</label>
			    	<input type="text" name="price" class="form-control"  id="price">
			    </div>
			
				<div class="form-group">
				<label>Thêm các xét nghiệm:</label>
			        <select name="test_id[]" class="form-control select" style="width:100%"  multiple>
			       
			            @foreach($tests as $test)
			                <option value="{{$test->id}}" data-name="{{$test->name}}">{{ $test->name}}</option>
			            @endforeach
			        
			        </select>
			    </div> 
			     <div class="form-group">
			    	<label for="with_tax">Có thuế</label>
			    	<input type="checkbox" name="with_tax" id="with_tax" >
			    </div>
			    </div>
				<div class="panel-footer">
					<button class="btn btn-success" type="submit"><span class='glyphicon glyphicon-edit'></span>Sửa</button>
					<a class="btn btn-default pull-right" id="cancel">Huỷ</a>
           		</div>
           		
           		{!! Form::close()!!}
			</div>
		</div>
</div>
			
<div class="modal fade" id="delete"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Xoá xét nghiệm</h4>
      </div>
      {!! Form::open(array('route' => 'package.test.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Bạn có muón xoá xét nghiệm này?</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Khống</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-ok'></span> Có</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>

<div class="modal fade" id="deletePackage"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Xoá gói khám</h4>
      </div>
      {!! Form::open(array('route' => 'package.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="package_id">
      	<label>Bạn có muốn xoá gói khám này?</label>
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
});
  
 $(document).on('click', '#package_edit', function() {
 		
        var stuff = $(this).data('edit').split(',');
        fillmodalData(stuff)
        $('.add').hide();
        $('.edit').show();
        
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#description').val(details[2]);
        $('#price').val(details[3]);
        
    }
     $(document).on('click', '#test_delete', function() 
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#delete').modal('show');
    });

    $(document).on('click', '#package_delete', function() 
    {
    	var id = $(this).data('package');
    	$('#package_id').val(id);
    	$('#deletePackage').modal('show');
    });

</script>
@endsection
		
				    	