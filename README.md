# login-system-php

- Cách xử lí form (kiểm tra có tồn tại trong database không?) : 
- $sql = "SELECT * FROM `login` WHERE name = '$name' and password = '$password'";
- $result = mysqli_query($conn, $sql);
- $count = mysqli_num_rows($result) => lấy ra số cột ($count == 1) => tồn tại dữ liệu
- Đăng nhập (tồn tại dữ liệu) => tới trang chủ ngược lại báo lỗi
- Đăng kí (tồn tại dữ liệu) => báo lỗi ngược lại thì thêm dữ liệu vào database
- Trang chủ lấy dữ liệu truy vấn từ session thông qua database fetch ra giao diện

- Cách sử dụng $_SESSION => lưu password , name vào session => nếu có session thì dẫn tới trang chủ ngược lại phải login
- session_start(); => đặt ở đầu khi muốn dùng session
- set session : $_SESSION["name"];
- Log out => xóa session => session_unset() : xóa dữ liệu + session_destroy() : gỡ session

<a href="https://www.youtube.com/watch?v=JDn6OAMnJwQ" target="_blank">Link tutorial</a>
