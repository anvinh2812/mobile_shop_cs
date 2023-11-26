<?php
session_start();
require_once("../pages/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Xử lý chuỗi để tránh tấn công SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Kiểm tra xem tên người dùng hoặc email đã tồn tại trong CSDL
    $check_query = "SELECT * FROM member WHERE username = '$username' OR memail = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check_result) > 0) {
        // Người dùng hoặc email đã tồn tại, hiển thị thông báo và chuyển hướng về trang đăng ký
        $_SESSION["registration_error"] = "username hoặc Email đã tồn tại.";
        echo '<script type="text/javascript">
                alert("Tên người dùng hoặc Email đã tồn tại!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    } else {
        // Thêm người dùng mới vào CSDL
        $insert_query = "INSERT INTO member (username, memail, password) VALUES ('$username', '$email', '$password')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            die("Lỗi truy vấn: " . mysqli_error($conn));
        }

        // Đăng ký thành công, chuyển hướng về trang đăng nhập và hiển thị thông báo
        echo '<script type="text/javascript">
                alert("Đăng ký thành công!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    }
}
?>
