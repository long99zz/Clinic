@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách đăng ký khám bệnh</h1>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">Danh sách đăng ký khám bệnh
            <a href="{{ route('register.create') }}" class="btn btn-primary pull-right">Thêm phiếu đăng ký khám</a>
        </div>
        <div class="panel-body">
            @if($registers->count())
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bệnh nhân</th>
                            <th>Bác sĩ</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registers as $register)
                            <tr>
                                <td>{{ $register->id }}</td>
                                <td>{{ $register->patient->last_name }} {{ $register->patient->middle_name }} {{ $register->patient->first_name }}</td>
                                <td>{{ $register->doctor->employee->last_name }} {{ $register->doctor->employee->middle_name }} {{ $register->doctor->employee->first_name }}</td>
                                <td>{{ $register->created_at }}</td>
                                <td>
                                    <a href="{{ route('register.show', $register->id) }}" class="btn btn-info">Chi tiết</a>
                                    <a href="{{ route('register.edit', $register->id) }}" class="btn btn-primary">Sửa</a>
                                    <form action="{{ route('register.destroy', $register->id) }}" method="POST" style="display: inline-block;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đăng ký này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 align="center">Không có đăng ký nào được tạo.</h3>
            @endif
        </div>
    </div>
</div>
@endsection
