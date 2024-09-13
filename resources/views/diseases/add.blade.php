@extends('layouts.app')

@section('content')
<div class="col-lg-12 main">            
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Thêm kết luận bệnh</li>
        </ol>
    </div><br><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Thêm kết luận bệnh</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'diseases.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Bệnh nhân:</label>
                                <select name="patient_id" class="form-control select2" style="width:100%" required>
                                    <option></option>
                                    @foreach($patients as $patient)
                                        <option value="{{$patient->id}}">ID:{{$setting->patient_prefix}}{{$patient->id}} {{ $patient->last_name}} {{ $patient->middle_name}} {{ $patient->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bác sĩ:</label>
                                <select name="doctor_id" class="form-control" id="doctor_select" required>
                                    <option></option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{$doctor->id}}">{{ $doctor->employee->last_name}} {{ $doctor->employee->middle_name}} {{ $doctor->employee->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Thân nhiệt:</label>
                                {!! Form::text('temperature', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhịp tim:</label>
                                {!! Form::text('pulse_rate', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhịp thở:</label>
                                {!! Form::text('respiration_rate', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Huyết áp:</label>
                                {!! Form::text('blood_pressure', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Kết luận bệnh:</label>
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button class="btn btn-danger" type="reset">Đặt lại</button>
                                <button class="btn btn-success" type="submit">Lưu</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#doctor_select').select2(); // Sử dụng plugin Select2 cho trường chọn bác sĩ
    });
</script>
@endsection
