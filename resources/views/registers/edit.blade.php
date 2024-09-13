@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa đăng ký</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('register.update', $register->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="patient_id">Bệnh nhân:</label>
            <select class="form-control" id="patient_id" name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $patient->id == $register->patient_id ? 'selected' : '' }}>
                        {{ $patient->last_name }} {{ $patient->middle_name }} {{ $patient->first_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Bác sĩ:</label>
            <select class="form-control" id="doctor_id" name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $doctor->id == $register->doctor_id ? 'selected' : '' }}>
                        {{ $doctor->employee->last_name }} {{ $doctor->employee->middle_name }} {{ $doctor->employee->first_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $register->description }}">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
