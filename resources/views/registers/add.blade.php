@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm đăng ký mới</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('register.store') }}" method="POST">
        <div class="form-group">
            <label for="patient_id">Bệnh nhân:</label>
            <select class="form-control" id="patient_id" name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->last_name }} {{ $patient->middle_name }} {{ $patient->first_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Bác sĩ:</label>
            <select class="form-control" id="doctor_id" name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->employee->last_name }} {{ $doctor->employee->middle_name }} {{ $doctor->employee->first_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
