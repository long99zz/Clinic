@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo Đơn Thuốc</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ request()->route('patient_id') ? route('prescriptions.storeForPatient', ['patient_id' => request()->route('patient_id')]) : route('prescriptions.store') }}" method="POST">
        {{ csrf_field() }}

        @if (!request()->route('patient_id'))
        <div class="form-group">
            <label for="patient_id">Bệnh nhân</label>
            <select name="patient_id" id="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->last_name }} {{ $patient->middle_name }} {{ $patient->first_name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="form-group">
            <label for="doctor_id">Bác sĩ</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->employee->last_name }} {{ $doctor->employee->middle_name }} {{ $doctor->employee->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="medicines">Thuốc</label>
            <table class="table" id="medicines_table">
                <thead>
                    <tr>
                        <th>Tên thuốc</th>
                        <th>Số lượng</th>
                        <th>Mô tả</th>
                        <th><button type="button" class="btn btn-primary" id="add_medicine">Thêm thuốc</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="medicine_id[]" class="form-control">
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->medicine_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantity[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="description[]" class="form-control">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove_medicine">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Tạo đơn thuốc</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add_medicine').addEventListener('click', function() {
            var table = document.getElementById('medicines_table').getElementsByTagName('tbody')[0];
            var newRow = table.rows[0].cloneNode(true);

            newRow.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });

            table.appendChild(newRow);
        });

        document.getElementById('medicines_table').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove_medicine')) {
                var row = event.target.closest('tr');
                if (document.querySelectorAll('#medicines_table tbody tr').length > 1) {
                    row.remove();
                } else {
                    alert('Cần ít nhất một loại thuốc trong đơn thuốc.');
                }
            }
        });
    });
</script>
@endsection