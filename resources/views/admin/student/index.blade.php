@extends('layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')
    <h1>Danh sách sinh viên</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Ngày sinh</th>
                <!-- <th>Khóa học</th> -->
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <!-- <td>
                        <ul>
                            @foreach ($student->courses as $course)
                                <li>{{ $course->name }} - {{ $course->description }}</li>
                            @endforeach
                        </ul>
                    </td> -->
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('student.create') }}" class="btn btn-primary">Thêm sinh viên</a>
@endsection
