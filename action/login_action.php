<?php
session_start();
require_once("../pages/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["txtTenDangNhap"];
    $password = $_POST["txtMatKhau"];

    // Xử lý chuỗi để tránh tấn công SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query kiểm tra thông tin đăng nhập trong bảng admin
    $admin_login_query = "SELECT * FROM admin WHERE Username = '$username' AND password = '$password'";
    $admin_login_result = mysqli_query($conn, $admin_login_query);

    // Query kiểm tra thông tin đăng nhập trong bảng member
    $member_login_query = "SELECT * FROM member WHERE Username = '$username' AND password = '$password'";
    $member_login_result = mysqli_query($conn, $member_login_query);

    if (!$admin_login_result || !$member_login_result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    // Kiểm tra thông tin đăng nhập có khớp với bảng admin
    if (mysqli_num_rows($admin_login_result) == 1) {
        // Đăng nhập thành công vào bảng admin
        $_SESSION["login"] = true;
        $_SESSION["TenDangNhap1"] = $username; // Lưu tên đăng nhập, có thể sửa đổi theo cột thích hợp
        $_SESSION["loi_dangnhap"] = "";

        header("Location: ../pages/admin/admin.php");
        exit();
    }
    // Kiểm tra thông tin đăng nhập có khớp với bảng member
    elseif (mysqli_num_rows($member_login_result) == 1) {
        // Đăng nhập thành công vào bảng member
        $_SESSION["login"] = true;
        $_SESSION["TenDangNhap1"] = $username; // Lưu tên đăng nhập, có thể sửa đổi theo cột thích hợp
        $_SESSION["loi_dangnhap"] = "";
        header("Location: ../pages/dashboard/home.php");
        exit();
    } else {
        // Đăng nhập thất bại
        $_SESSION["login"] = false;
        $_SESSION["TenDangNhap1"] = "";
        $_SESSION["loi_dangnhap"] = "Thông tin đăng nhập bị sai";

        echo '<script type="text/javascript">
                alert("Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    }
}
?>
