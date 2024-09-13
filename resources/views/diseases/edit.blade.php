@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa kết luận bệnh</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('diseases.update', $disease->id) }}" method="POST">
        <div class="form-group">
            <label for="patient_id">Bệnh nhân:</label>
            <select class="form-control" id="patient_id" name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $patient->id == $disease->patient_id ? 'selected' : '' }}>
                        {{ $patient->last_name }} {{ $patient->middle_name}} {{ $patient->first_name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Bác sĩ:</label>
            <select class="form-control" id="doctor_id" name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $doctor->id == $disease->doctor_id ? 'selected' : '' }}>
                        {{ $doctor->employee->last_name }} {{ $doctor->employee->middle_name }} {{ $doctor->employee->first_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="temperature">Thân nhiệt:</label>
            <input type="text" class="form-control" id="temperature" name="temperature" value="{{ $disease->temperature }}">
        </div>
        <div class="form-group">
            <label for="pulse_rate">Nhịp tim:</label>
            <input type="text" class="form-control" id="pulse_rate" name="pulse_rate" value="{{ $disease->pulse_rate }}">
        </div>
        <div class="form-group">
            <label for="respiration_rate">Nhịp thở:</label>
            <input type="text" class="form-control" id="respiration_rate" name="respiration_rate" value="{{ $disease->respiration_rate }}">
        </div>
        <div class="form-group">
            <label for="blood_pressure">Huyết áp:</label>
            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" value="{{ $disease->blood_pressure }}">
        </div>
        <div class="form-group">
            <label for="description">Kết luận bệnh:</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $disease->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('diseases.index') }}" class="btn btn-default">Hủy</a>
    </form>
</div>
@endsection
