<!-- resources/views/prescriptions/show.blade.php -->

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
            <li class="active">Thông tin đơn thuốc</li>
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
                <div class="panel-heading"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Thông tin đơn thuốc</div>
                <div class="panel-body">
                    <div class="print-section">
                        <div class="header">
                            <p>Phòng khám: XYZ</p>
                            <p>Địa chỉ: {{ $hospital->address }}</p>
                        </div>
                        <div class="title">ĐƠN THUỐC</div>
                        <div class="header">
                            <p>{{ $prescription->created_at->format('H:i') }}, ngày {{ $prescription->created_at->format('d') }} tháng {{ $prescription->created_at->format('m') }} năm {{ $prescription->created_at->format('Y') }}</p>
                        </div>
                        <div class="info row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Thông tin bệnh nhân</h3>
                                <p><strong>Họ tên bệnh nhân:</strong> {{ $prescription->patient->last_name }} {{ $prescription->patient->middle_name }} {{ $prescription->patient->first_name }}</p>
                                <p><strong>Tuổi:</strong> {{ $prescription->patient->age }}</p>
                                <p><strong>Giới tính:</strong> {{ $prescription->patient->gender }}</p>
                                <p><strong>Địa chỉ:</strong> {{$prescription->patient->location}}, {{$prescription->patient->state}}, {{$prescription->patient->district}}, {{$prescription->patient->country}}</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Thông tin đơn thuốc</h3>
                                <p><strong>Bác sĩ:</strong> {{ $prescription->doctor->employee->last_name }} {{ $prescription->doctor->employee->middle_name }} {{ $prescription->doctor->employee->first_name }}</p>
                                <p><strong>Ngày tạo:</strong> {{ $prescription->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3>Danh sách thuốc</h3>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Thuốc</th>
                                            <th>Số lượng</th>
                                            <th>Mô tả</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prescription_details as $prescription_detail)
                                            <tr>
                                                <td>{{ $prescription_detail->medicine->medicine_name }}</td>
                                                <td>{{ $prescription_detail->quantity }}</td>
                                                <td>{{ $prescription_detail->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="footer">
                        </div>
                    </div>
                    <a href="{{ route('prescriptions.index') }}" class="btn btn-default">Quay lại</a>
                    <a href="{{ route('prescription.edit', $prescription->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                    <form action="{{ route('prescription.destroy', $prescription->id) }}" method="POST" style="display:inline-block;">
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