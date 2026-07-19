@extends('layouts.app')
@section('title','Danh sách sinh viên (DB)')
@section('content')
<h2>Danh sách sinh viên – Nguồn: CSDL (Eloquent)</h2>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Tuổi</th>
            <th>Giới tính</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $s)
        <tr>

            <td>{{ $loop->iteration + ($students->currentPage()-1)*$students->perPage() }}</td>
            <td>{{ $s->name }}</td>
            <td @class(['text-danger'=> $s->age >= 18, 'text-primary' => $s->age < 18])>
                    {{ $s->age }}
            </td>

            <td>{{ $s->gender }}</td>
            <td>{{ $s->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div style="margin-top:12px">
    {{ $students->links() }}
</div>
@endsection