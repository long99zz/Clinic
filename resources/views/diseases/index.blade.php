@extends('layouts.app')

@section('content')
<div class="col-lg-12 main">         
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Bệnh nhân</li>
            <li>Kết quả khám</li>
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
                <div class="panel-heading">Bảng kết quả khám
                    <a class="btn btn-success pull-right" href="{{ route('diseases.create') }}">
                        <span class="glyphicon glyphicon-plus"></span> Thêm kết quả khám
                    </a>
                </div>
                <div class="panel-body">
                    @if($diseases->count())
                        <table id="example" class="table table-bordered table-striped table-condensed" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th data-sortable="true">Mã</th>
                                    <th data-sortable="true">Tên bệnh nhân</th>
                                    <th data-sortable="true">Tên bác sĩ</th>
                                    <th data-sortable="true">Kết quả khám</th>
                                    <th data-sortable="true">Thời gian</th>
                                    <th data-sortable="true">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diseases as $key => $disease)
                                    <tr>
                                        <td>{{ $disease->id }}</td>
                                        <td>{{ $disease->patient->last_name }} {{ $disease->patient->middle_name }} {{ $disease->patient->first_name }}</td>
                                        <td>{{ $disease->doctor->employee->last_name }} {{ $disease->doctor->employee->middle_name }} {{ $disease->doctor->employee->first_name }}</td>
                                        <td>{{ $disease->description }}</td>
                                        <td>{{ $disease->created_at }}</td>
                                        <td>
                                            <a href="{{ route('diseases.edit', $disease->id) }}" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit"></span> Sửa
                                            </a>
                                            <form action="{{ route('diseases.destroy', $disease->id) }}" method="POST" style="display:inline-block;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span> Xoá
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3 align="center">Không tìm thấy kết quả khám</h3>
                    @endif
                </div>
            </div>
        </div>
    </div><!--/.row-->  
</div><!--/.main-->
@endsection
