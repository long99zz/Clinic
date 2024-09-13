@extends('layouts.app')
@section('content')
@include('appointments.partials.add')
@include('appointments.partials.edit')
@include('appointments.partials.js')
<div class="col-lg-12 main">            
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Bệnh nhân</li>
                <li>Lịch hẹn</li>
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
                    <div class="panel-heading">Bảng lịch hẹn<a class="btn btn-success pull-right" data-toggle="modal" href="#addAppointment"><span class="glyphicon glyphicon-plus"></span>Thêm lịch hẹn</a></div>
                    <div class="panel-body">
                    @if($appointments->count())
                        <table id="example" class="table table-bordered table-striped table-condensed" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th data-sortable="true">Mã</th>
                            <th data-sortable="true">Tên </th>
                            <th data-sortable="true">Tên bệnh nhân</th>
                            <th data-sortable="true">Tên bác sĩ</th>
                            <th data-sortable="true">Mô tả</th>
                            <th data-sortable="true">Thời gian</th>
                            <th>Ngày</th>
                            <th data-sortable="true">Trạng thái</th>
                            <th data-sortable="true">Thao tác</th>
                            </tr>
                        </thead>
                            <tbody>
    @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->id }}</td>
            <td>{{ $appointment->name }}</td>
            <td>{{ $appointment->patient->last_name }} {{ $appointment->patient->middle_name }} {{ $appointment->patient->first_name }}</td>
            <td>{{ $appointment->doctor->employee->last_name }} {{ $appointment->doctor->employee->middle_name }} {{ $appointment->doctor->employee->first_name }}</td>
            <td>{{ $appointment->description }}</td>
            <td>{{ $appointment->time }}</td>
            <td>{{ $appointment->appointment_date }}</td>
            <td>
                @if($appointment->status)
                    <a class="btn btn-sm btn-success" href="{{ route('appointment.edit', $appointment->id) }}">
                        <span class="glyphicon glyphicon-ok"></span> Xác nhận
                    </a>
                @else
                    <a class="btn btn-sm btn-warning" href="{{ route('appointment.edit', $appointment->id) }}">
                        <span class="glyphicon glyphicon-refresh"></span> Đang chờ
                    </a>
                @endif
            </td>
            <td>
                <button class="edit-appointment btn btn-primary" 
                        data-info="{{ $appointment->id }},{{ $appointment->name }},{{ $appointment->description }},{{ $appointment->time }},{{ $appointment->doctor_id }},{{ $appointment->patient_id }},{{ $appointment->appointment_date }}">
                    <span class="glyphicon glyphicon-edit"></span> Sửa
                </button>
                @permission('appointment.delete')
                <button class="delete-modal btn btn-danger" data-info="{{ $appointment->id }}">
                    <span class="glyphicon glyphicon-trash"></span> Xoá
                </button>
                @endpermission
            </td>
        </tr>
    @endforeach
</tbody>

                        </table>
                        @else
                        <h3 align="center">Không tìm thấy lịch hẹn</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div><!--/.row-->  
</div><!--/.main-->

<script>
$(document).ready(function(){
    // Delegated event handler for edit buttons
    $(document).on('click', '.edit-appointment', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var time = $(this).data('time');
        var doctor_id = $(this).data('doctor_id');
        var patient_id = $(this).data('patient_id');
        var appointment_date = $(this).data('appointment_date');
        
        // Populate the modal fields with the data attributes
        $('#editModal #appointment_id').val(id);
        $('#editModal #name').val(name);
        $('#editModal #description').val(description);
        $('#editModal #time').val(time);
        $('#editModal #doctor_id').val(doctor_id);
        $('#editModal #patient_id').val(patient_id);
        $('#editModal #appointment_date').val(appointment_date);
        
        // Show the modal
        $('#editModal').modal('show');
    });
});
</script>

@endsection