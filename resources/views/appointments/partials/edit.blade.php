<div class="modal fade" id="editAppointment" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sửa lịch hẹn</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['route' => 'appointment.updated', 'method' => 'POST']) !!}
                    <input name="id" type="hidden" class="form-control" id="id">
                    <div class="col-md-4 form-group">
                        <label>Bệnh nhân:</label>
                        <select name="patient_id" class="form-control" id="patient_id">
                            <option></option>
                            @foreach($patients as $patient)
                                <option value="{{$patient->id}}">{{ $patient->last_name }} {{ $patient->middle_name }} {{ $patient->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Bác sĩ:</label>
                        <select name="doctor_id" class="form-control doctor_select" required id="doctor_id">
                            <option></option>
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{ $doctor->employee->last_name }} {{ $doctor->employee->middle_name }} {{ $doctor->employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Giờ khám:</label>
                        <div class="available_time">
                            <input type="text" name="time" class="form-control" id="time">
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Ngày hẹn:</label>
                        <input type="text" name="appointment_date" class="form-control datepicker1" data-date-start-date="0d" >
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Tên:</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'name']) !!}
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Mô tả:</label>
                        {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                    <button class="btn btn-danger" type="reset">Đặt lại</button>
                    <button class="btn btn-success" type="submit">Lưu</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.edit-appointment').on('click', function() {
            var appointment = $(this).data();
            console.log(appointment); // Thêm dòng này để kiểm tra dữ liệu

            $('#editAppointment #id').val(appointment.id);
            $('#editAppointment #name').val(appointment.name);
            $('#editAppointment #description').val(appointment.description);
            $('#editAppointment #time').val(appointment.time);
            $('#editAppointment #doctor_id').val(appointment.doctor_id);
            $('#editAppointment #patient_id').val(appointment.patient_id);
            $('#editAppointment #date').val(appointment.appointment_date);
            $('#editAppointment').modal('show');
        });

        $('.doctor_select').on('change', function() {
            var id = $(this).val();
            $('.available_time').load({!! json_encode(url('/days/')) !!} + '/' + id);
        });
    });
</script>
