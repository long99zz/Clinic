@extends('layouts.app')

@section('content')
<div class="col-lg-12 main">            
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Thông tin kết luận bệnh</li>
        </ol>
    </div><br><!--/.row-->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Thông tin kết luận bệnh</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mã:</strong> {{ $disease->id }}<br>
                            <strong>Bệnh nhân:</strong> {{ $disease->patient->last_name }} {{ $disease->patient->middle_name }} {{ $disease->patient->first_name }}<br>
                            <strong>Bác sĩ:</strong> {{ $disease->doctor->employee->last_name }} {{ $disease->doctor->employee->middle_name }} {{ $disease->doctor->employee->first_name }}<br>
                            <strong>Thân nhiệt:</strong> {{ $disease->temperature }}<br>
                            <strong>Nhịp tim:</strong> {{ $disease->pulse_rate }}<br>
                            <strong>Nhịp thở:</strong> {{ $disease->respiration_rate }}<br>
                            <strong>Huyết áp:</strong> {{ $disease->blood_pressure }}<br>
                            <strong>Kết luận bệnh:</strong> {{ $disease->description }}<br>
                            <strong>Thời gian:</strong> {{ $disease->created_at }}<br>
                        </div>
                    </div>
                    <hr>
                    <div class="print-section">
                        <a href="{{ route('diseases.edit', $disease->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                        <form action="{{ route('diseases.destroy', $disease->id) }}" method="POST" style="display:inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                        <button id="printButton" class="btn btn-secondary">In</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
