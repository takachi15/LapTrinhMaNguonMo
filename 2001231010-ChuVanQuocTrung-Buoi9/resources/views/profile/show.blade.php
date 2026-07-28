<h2>Thông tin của: {{ $user->name }}</h2>
<p>Email: {{ $user->email }}</p>

<!-- Kiểm tra xem user có profile hay không trước khi hiển thị -->
@if($user->profile)
    <p>Địa chỉ: {{ $user->profile->address }}</p>
    <p>Số điện thoại: {{ $user->profile->phone }}</p>
@else
    <p>User này chưa cập nhật Profile.</p>
@endif