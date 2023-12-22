<?php
include 'connect.php';

if (isset($_GET['oid'])) {
    $oid = $_GET['oid'];

    $updateQuery = "UPDATE orders SET ostatus = 'đã xác nhận' WHERE oid = $oid";

    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        header("Location: ../pages/admin/admin_ql_order.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.";
    }
} else {
    echo "Không tìm thấy đơn hàng để xác nhận.";
}

mysqli_close($conn);
?>
