<?php
session_start();
require_once("../connect.php");

// Check if the user clicked the logout link
if (isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}

$num_row = 3;
$page = (isset($_GET["page"]) && is_numeric($_GET["page"])) ? intval($_GET["page"]) : 1;
if ($page < 1) {
    $page = 1;
}

$categories_query = "SELECT DISTINCT cname FROM categories";
$categories_result = $conn->query($categories_query) or die($conn->error);

$filterCategory = isset($_GET['category']) ? $_GET['category'] : null;

$sql1 = "SELECT a.*, b.cname FROM product a
        JOIN categories b ON a.cid = b.cid";

if ($filterCategory) {
    $sql1 .= " WHERE b.cname = '" . $filterCategory . "'";
}

$sql = " ORDER BY b.cname, a.pcode LIMIT " . ($page - 1) * $num_row . ", " . $num_row;

$result = $conn->query($sql) or die($conn->error);

$groupedProducts = [];
while ($row = $result->fetch_assoc()) {
    $categoryName = $row['cname'];
    if (!isset($groupedProducts[$categoryName])) {
        $groupedProducts[$categoryName] = [];
    }
    $groupedProducts[$categoryName][] = $row;
}

$num_of_page = isset($num_of_page) ? $num_of_page : 1;
?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        #logout {
            float: right;
            margin: 10px;
        }

        #logout a {
            text-decoration: none;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #logout a:hover {
            background-color: #45a049;
        }

        #sidebar {
            float: left;
            width: 20%;
        }

        #content {
            float: right;
            width: 80%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>List a product</h1>

    <!-- Logout button -->
    <div id="logout">
        <a href="?logout=1">Logout</a>
    </div>

    <div id="sidebar">
        <h2>Categories</h2>
        <ul>
            <li><a href="product_view_page.php">All</a></li>
            <?php
            while ($category = $categories_result->fetch_assoc()) {
                $categoryName = $category['cname'];
                echo "<li><a href='product_view_page.php?category=$categoryName'>$categoryName</a></li>";
            }
            ?>
        </ul>
    </div>

    <div id="content">
        <?php
        if (empty($groupedProducts)) {
            echo "<p>No products found.</p>";
        } else {
            foreach ($groupedProducts as $categoryName => $products) {
                echo "<h2>$categoryName</h2>";
                echo "<table border='1' width='100%'>";
                echo "<tr>";
                echo "<th>Code</th>";
                echo "<th>Name</th>";
                echo "<th>Image</th>";
                echo "<th>Price</th>";
                echo "<th>Quantity</th>";
                echo "<th>Category</th>";
                echo "<th>Detail</th>";
                echo "</tr>";

                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $product["pcode"] . "</td>";
                    echo "<td>" . $product["pname"] . "</td>";
                    echo "<td><img src='" . $product["pimage"] . "' width='160px'></td>";
                    echo "<td>" . $product["pprice"] . "</td>";
                    echo "<td>" . $product["pquantity"] . "</td>";
                    echo "<td>" . $product["cname"] . "</td>";
                    echo "<td><a href='product_detail.php?pcode=" . $product["pcode"] . "'>Detail</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
        }

        echo "<center>";
        for ($i = 1; $i <= $num_of_page; $i++) {
            if ($i == $page) {
                echo " " . $i . " ";
            } else {
                echo " <a href='product_view_page.php?page=" . $i;
                if ($filterCategory) {
                    echo "&category=$filterCategory";
                }
                echo "'>" . $i . "</a> ";
            }
        }
        echo "</center>";
        ?>
    </div>
</body>
</html>
