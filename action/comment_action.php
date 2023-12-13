<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comment']) && isset($_POST['pname']) && isset($_POST['star'])) {
        $comment = $_POST['comment'];
        $receivedPname = $_POST['pname'];
        $starRating = $_POST['star'];
        include '../connect.php';
        $escapedPname = $conn->real_escape_string($receivedPname);
        // Find the pid from the product table based on pname
        $pidQuery = "SELECT pid FROM product WHERE pname = '$escapedPname'";
        $pidResult = $conn->query($pidQuery);
        if ($pidResult->num_rows > 0) {
            $row = $pidResult->fetch_assoc();
            $pid = $row['pid'];
            // Insert the comment into the comment table with the corresponding pid
            $insertCommentQuery = "INSERT INTO comment (pid, content, star) VALUES ('$pid', '$comment', '$starRating')";
            if ($conn->query($insertCommentQuery) === TRUE) {
                // Comment was successfully added
                header("Location: previous_page.php"); // Redirect to the previous page after submitting the comment
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid data.";
    }
}
?>
