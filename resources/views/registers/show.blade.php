@extends('layouts.app')

@section('content')
<script type="text/javascript">
$(document).ready(function() {
  $(".select").select2();
  
  $("#printButton").click(function() {
    window.print();
  });
});
</script>
<style>
@media print {
    body * {
        visibility: hidden;
    }
    .print-section, .print-section * {
        visibility: visible;
    }
    .print-section {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        border: 1px solid black;
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }
    .print-section .header, .print-section .footer {
        text-align: center;
    }
    .print-section .title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin: 20px 0;
    }
    .print-section .info {
        margin: 20px 0;
    }
    .print-section .info p {
        margin: 5px 0;
    }
    .print-section .footer {
        margin-top: 50px;
    }
}
</style>
<div class="col-lg-12 main">            
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Thông tin phiếu đăng ký khám bệnh</li>
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
                <div class="panel-heading"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Thông tin phiếu đăng ký khám bệnh</div>
                <div class="panel-body">
                    <div class="print-section">
                        <div class="header">
                            <p>Phòng khám: XYZ</p>
                            <p>Địa chỉ: {{ $hospital->address }}</p>
                        </div>
                        <div class="title">PHIẾU ĐĂNG KÝ KHÁM BỆNH</div>
                        <div class="header">
                            <p>{{ $register->created_at->format('H:i') }}, ngày {{ $register->created_at->format('d') }} tháng {{ $register->created_at->format('m') }} năm {{ $register->created_at->format('Y') }}</p>
                        </div>
                        <div class="info">
                            <p><strong>Họ tên bệnh nhân:</strong> {{ $register->patient->last_name }} {{ $register->patient->middle_name }} {{ $register->patient->first_name }}</p>
                            <p><strong>Địa chỉ:</strong> {{$register->patient->location}}, {{$register->patient->state}}, {{$register->patient->district}}, {{$register->patient->country}}</p>
                            <p><strong>Giới tính:</strong> {{ $register->patient->gender }}</p>
                            <p><strong>Tuổi:</strong> {{ $register->patient->age }}</p>
                            <p><strong>Bác sĩ:</strong> {{ $register->doctor->employee->last_name }} {{ $register->doctor->employee->middle_name }} {{ $register->doctor->employee->first_name }}</p>
                        </div>
                        <div class="footer">
                        </div>
                    </div>
                    <a href="{{ route('register.index') }}" class="btn btn-default">Quay lại</a>
                    <a href="{{ route('register.edit', $register->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                    <form action="{{ route('register.destroy', $register->id) }}" method="POST" style="display:inline-block;">
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
@endsection
<script type="text/javascript">
$(document).ready(function() {
  $(".select").select2();
  
  $("#printButton").click(function() {
    window.print();
  });
  
  $("form[method='POST']").submit(function() {
    return confirm("Bạn có chắc chắn muốn xóa không?");
  });
});
</script>
