<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $odate = date("Y-m-d H:i:s");
    $ototal = $_POST['sellPrice'];
    $ostatus = "chờ xác nhận";
    $mid = $_POST['mid'];
    $pid = $_POST['pid'];
    $quantity = $_POST['finalQuantity'];
    $sellPrice = $_POST['sellPrice'];
    $paymentmethod = $_POST['paymentmethod'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $delivery = $_POST['delivery'];
    $address = $_POST['address'];
    
    // Kiểm tra xem pid có tồn tại trong bảng product hay không
    $sql_check_pid = "SELECT pid FROM product WHERE pid = '$pid'";
    $result_check_pid = $conn->query($sql_check_pid);

    if ($result_check_pid->num_rows > 0) {
        $sql_orders = "INSERT INTO orders (odate, ototal, ostatus, mid, pid) VALUES ('$odate', '$ototal', '$ostatus', '$mid', '$pid')";
        if ($conn->query($sql_orders) !== TRUE) {
            echo "Error: " . $sql_orders . "<br>" . $conn->error;
        } else {
            $last_inserted_id = $conn->insert_id;

            $sql_orderdetail = "INSERT INTO orderdetail (oid, pid, quantity, sellPrice, paymentmethod) VALUES ('$last_inserted_id', '$pid', '$quantity', '$sellPrice', '$paymentmethod')";
            if ($conn->query($sql_orderdetail) !== TRUE) {
                echo "Error: " . $sql_orderdetail . "<br>" . $conn->error;
            } else {
                // Thêm thành công, xử lý tiếp hoặc điều hướng người dùng đến trang khác
                $conn->close();
                header("Location: ../pages/dashboard/history.php");
                exit();
            }
        }
    } else {
        echo "Không tìm thấy pid trong bảng product.";
    }
}
?>
