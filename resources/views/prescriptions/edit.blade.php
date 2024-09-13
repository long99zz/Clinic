@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa đơn thuốc</h1>
    
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Edit Prescription Form -->
    <div class="panel panel-default">
        <div class="panel-heading">Cập nhật thông tin đơn thuốc</div>
        <div class="panel-body">
            <form action="{{ route('prescription.update', $prescription->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group row">
                    <label for="patient_id" class="col-sm-2 col-form-label">Bệnh nhân</label>
                    <div class="col-sm-4">
                        <select name="patient_id" id="patient_id" class="form-control" required>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" @if($patient->id == $prescription->patient_id) selected @endif>{{ $patient->last_name }} {{ $patient->middle_name }} {{ $patient->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="doctor_id" class="col-sm-2 col-form-label">Bác sĩ</label>
                    <div class="col-sm-4">
                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if($doctor->id == $prescription->doctor_id) selected @endif>{{ $doctor->employee->last_name }} {{ $doctor->employee->middle_name }} {{ $doctor->employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h4>Thuốc</h4>
                <div id="medicine-section">
                    @foreach($prescription_details as $key => $prescription_details)
                    <div class="form-group row">
                        <label for="medicine_id" class="col-sm-2 col-form-label">Chọn thuốc</label>
                        <div class="col-sm-10">
                            <select name="medicine_id[]" class="form-control" required>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" @if($medicine->id == $prescription_details->medicine_id) selected @endif>{{ $medicine->medicine_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label">Số lượng</label
                                                <div class="col-sm-10">
                            <input type="number" name="quantity[]" class="form-control" value="{{ $prescription_details->quantity }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <input type="text" name="description[]" class="form-control" value="{{ $prescription_details->description }}">
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary" id="add-medicine">Thêm thuốc</button>
                
                <button type="submit" class="btn btn-primary mt-3">Cập nhật đơn thuốc</button>
            </form>
        </div>
    </div>
</div>

<!-- jQuery 3.1.1 -->
<!-- JavaScript to handle dynamic medicine addition/removal -->
<script>
$(document).ready(function() {
    $('#add-medicine').on('click', function() {
        var medicineSection = $('#medicine-section');
        var newMedicineItem = `
            <div class="form-group row">
                <label for="medicine_id" class="col-sm-2 col-form-label">Chọn thuốc</label>
                <div class="col-sm-10">
                    <select name="medicine_id[]" class="form-control" required>
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="quantity" class="col-sm-2 col-form-label">Số lượng</label>
                <div class="col-sm-10">
                    <input type="number" name="quantity[]" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                <div class="col-sm-10">
                    <input type="text" name="description[]" class="form-control">
                </div>
            </div>
        `;
        medicineSection.append(newMedicineItem);
    });
});
</script>
@endsection
