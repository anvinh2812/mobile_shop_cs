<?php
session_start();
include 'connect.php';

if (isset($_GET['pname'])) {
    $name = $_GET['pname'];
    
    // Escape the product name to prevent SQL injection
    $escapedName = mysqli_real_escape_string($conn, $name);
    
    // Perform the deletion query based on the product name (pname)
    $deleteQuery = "DELETE FROM cart WHERE pname = '$escapedName'";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    if ($deleteResult) {
        // Redirect back to the cart page after successful deletion
        header("Location: ../pages/dashboard/cart.php");
        exit();
    } else {
        // Handle deletion failure
        echo "Failed to delete the product. Please try again.";
    }
} else {
    // Handle missing product name
    echo "Product name not provided. Cannot delete the product.";
}

// Close the database connection
mysqli_close($conn);
?>
