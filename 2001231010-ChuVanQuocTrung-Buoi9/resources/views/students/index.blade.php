<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Sinh viên</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Danh sách sinh viên và các môn học đã đăng ký</h2>
    <table>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Môn học</th>
        </tr>
        @foreach($students as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->email }}</td>
            <td>
                @foreach($s->courses as $c)
                    <span>{{ $c->title }}</span>@if(!$loop->last), @endif
                @endforeach
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>