<?php
session_start();
include('connect.php');

if (isset($_GET['pname'])) {
    $receivedPname = $_GET['pname'];
    $escapedPname = $conn->real_escape_string($receivedPname);

    // Retrieve the maximum code from the cart table
    $maxCodeQuery = "SELECT MAX(code) AS maxCode FROM cart";
    $maxCodeResult = $conn->query($maxCodeQuery);
    
    if ($maxCodeResult && $maxCodeResult->num_rows > 0) {
        $row = $maxCodeResult->fetch_assoc();
        $currentMaxCode = intval($row['maxCode']);

        // Increment the current maximum code by 1 for the new product
        $newCode = $currentMaxCode + 1;

        // Retrieve product details based on the received product name
        $sql = "SELECT * FROM product WHERE pname = '$escapedPname'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Extract necessary product details
            $productName = $escapedPname; // Use the sanitized product name
            $productNewPrice = $row['pnewprice'];
            $productOldPrice = $row['poldprice'];
            $productImage = $row['pimage'];

            // Prepare an INSERT query to add the selected product to the cart table
            $insertQuery = "INSERT INTO cart (code, pname, pnewprice, poldprice, pimage) VALUES ('$newCode', '$productName', '$productNewPrice', '$productOldPrice', '$productImage')";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
                // Thêm sản phẩm thành công - Hiển thị thông báo thành công
                echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng.');</script>";
                header("Location: ../pages/dashboard/cart.php");
                exit();

            } else {
                // Xử lý khi thêm sản phẩm không thành công - Hiển thị thông báo lỗi
                echo "<script>alert('Không thể thêm sản phẩm vào giỏ hàng. Vui lòng thử lại sau.'); window.history.back();</script>";
                header("Location: ../pages/dashboard/cart.php");
                exit();

            }

        } else {
            echo "Không có thông tin sản phẩm"; // Product information not found
        }
    } else {
        echo "Failed to retrieve the current code. Please try again."; // Unable to retrieve the current code
    }
} else {
    echo "Product name not provided"; // Product name not received in the request
}

$conn->close();
?>
