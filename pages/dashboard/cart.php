
<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION["error_message"] = "Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!";
    header("Location: ../dashboard/login.php");
    exit();
}
$username = $_SESSION['TenDangNhap1'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    
    <link rel="stylesheet" href="../../css/toast.css">
    <link rel="stylesheet" href="../../css/home.css">
    <title>member</title>
</head>
    <style>
        /* CSS code để thiết kế giao diện */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .product {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid black;
        }
        .product img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            flex: 1;
            padding: 20px;
        }
        .product-name {
            font-size: 20px;
            font-weight: bold;
        }
        .product-price {
            font-size: 18px;
            color: green;
        }
        .product-button {
            display: block;
            background-color: blue;
            color: white;
            padding: 10px;
            margin-top: 10px;
            text-decoration: none;
            text-align: center;
        }
        .total {
            font-size: 24px;
            font-weight: bold;
            text-align: right;
        }
    </style>
<body>
<div class="header__height"></div>
        <div class="header">
            <div class="row">
                <!-- Logo Icon -->
                <div class="header__logo__wrapper ">
                    <div class="header__logo">
                    </div>
                    <span class="header__logo__line__1st"></span>
                    <span class="header__logo__line__2nd"></span>
                    <span class="header__logo__line__3rd"></span>
                </div>
                <!-- Logo Image -->
                <div v class="header__logo__img">
                    <a href="../dashboard/home.php"><img src="../assets/img/Desktop logo/1.png" alt=""></a>
                </div>
                <!-- Search bar -->
                <div class="header__search__bar">
                    <div class="header__search__bar__icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="header__search__bar__input">
                        <input type="text" id="search-box" placeholder="Bạn cần tìm gì?">
                        <div id="suggestion-box"></div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
                <script>
                    $(document).ready(function() {
                        // Lắng nghe sự kiện khi người dùng gõ vào #search-box
                        $("#search-box").keyup(function() {
                            // Thực hiện AJAX để tìm kiếm và hiển thị kết quả trong #suggestion-box
                            $.ajax({
                                type: "GET",
                                url: "../../action/readProduct.php",
                                data: 'keyword=' + $(this).val(),
                                beforeSend: function() {
                                    $("#search-box").css("background", "#FFF url(./assets/icon/loadicon.png) no-repeat 165px");
                                },
                                success: function(data) {
                                    $("#suggestion-box").show();
                                    $("#suggestion-box").html(data);
                                    $("#search-box").css("background", "#FFF");
                                }
                            });
                        });
                        // Lắng nghe sự kiện click trên toàn bộ document
                        $(document).click(function(event) {
                            // Kiểm tra xem sự kiện click có xảy ra trên #search-box hay không
                            if (!$(event.target).closest('#search-box').length) {
                                // Nếu không phải là #search-box hoặc bất kỳ phần tử con của nó
                                $("#suggestion-box").hide();
                            }
                        });

                        // Hàm để chọn một mục từ #suggestion-box
                        function selectCountry(val) {
                            $("#search-box").val(val);
                            $("#suggestion-box").hide();
                        }
                    });
                </script>
                <div class="header__search__bar__modal" style="display: none;"></div>
                <script>
                    var search__input = document.querySelector('.header__search__bar__input input');
                    var search__modal = document.querySelector('.header__search__bar__modal');
                    var list_cate = document.querySelector('.list_cate');
                    search__input.addEventListener('click', function(event) {
                        search__modal.style.display = 'block';
                        event.stopPropagation();
                    });

                    search__modal.addEventListener('click', function() {
                        search__modal.style.display = 'none';
                    });
                </script>
                <!-- Navbar list -->
                <div class="header__navbar">
                    <ul class="header__navbar__list">
                        <li class="header__navbar__item">
                            <div class="header__navbar__item__wrapper">
                                <a href="cart_detail.php" class="header__navbar__item__link">
                                    <i class="fas fa-shipping-fast"></i>
                                    <div class="header__navbar__item__link__desc__wrapper">
                                        <p>Tra cứu</p>
                                        <p>đơn hàng</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="header__navbar__item">
                            <div class="header__navbar__item__wrapper">
                                <a href="../dashboard/cart.php" class="header__navbar__item__link">
                                    <i class="ti-bag"></i>
                                    <div class="header__navbar__item__link__desc__wrapper">
                                        <p>Giỏ</p>
                                        <p>hàng</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="header__navbar__item">
                            <div class="header__navbar__item__wrapper">
                                <div class="header__navbar__item__link" onclick="toggleDropdown()">
                                    <div class="header__navbar__item__link__icon__wrapper__last">
                                        <i class="far fa-user-circle"></i>
                                    </div>
                                    <div class="header__navbar__item__link__desc__wrapper_last">
                                        <p id="username">
                                            <?php
                                            if (isset($_SESSION['TenDangNhap1'])) {
                                                echo $_SESSION['TenDangNhap1']; // Hiển thị tên người dùng từ session
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="dropdown" id="dropdown-smem">
                                    <div class="dropdown-content">
                                        <a href="../member/member.php">Trang cá nhân</a>
                                        <a href="logout.php">Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <style>
                            /* Ẩn dropdown content mặc định */
                            .dropdown-content {
                            display: none;
                            position: absolute;
                            background-color: #fff;
                            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                            z-index: 1;
                            color: #000; /* Màu chữ đen */
                            font-weight: bold; /* In đậm */
                        }

                        /* Hiển thị dropdown khi có class 'show' */
                        .dropdown-content.show {
                            display: block;
                        }
                        .dropdown-content a {
                            display: block;
                            width: 100%;
                            white-space: normal;
                            text-align: left;
                            padding: 8px 16px;
                            text-decoration: none;
                            color: #000; /* Màu chữ đen */
                            font-weight: bold; /* In đậm */
                            transition: background-color 0.3s ease; /* Hiệu ứng hover */
                        }

                        .dropdown-content a:hover {
                            background-color: #f0f0f0; /* Màu nền khi di chuột qua */
                        }
                        </style>

                        <script>
                            function toggleDropdown() {
                                var dropdown = document.querySelector("#dropdown-smem .dropdown-content");
                                dropdown.classList.toggle("show");
                            }

                            // Đóng dropdown nếu click ra ngoài dropdown
                            window.onclick = function(event) {
                                if (!event.target.closest('.header__navbar__item__wrapper')) {
                                    var dropdowns = document.querySelectorAll(".dropdown-content");
                                    dropdowns.forEach(function(dropdown) {
                                        if (dropdown.classList.contains('show')) {
                                            dropdown.classList.remove('show');
                                        }
                                    });
                                }
                            }
                        </script>

                    </ul>
                </div>
            </div>
        </div>
    <div class="container">
        <?php
            include '../connect.php';
            $sql = "SELECT * FROM cart";
            $result = mysqli_query($conn, $sql);
            // Kiểm tra kết quả truy vấn
            if (mysqli_num_rows($result) > 0) {
                // Khởi tạo biến tổng tiền
                $total = 0;
                // Lặp qua các dòng dữ liệu và hiển thị sản phẩm
                while($row = mysqli_fetch_assoc($result)) {
                    // Lấy thông tin sản phẩm từ dòng dữ liệu
                    $name = $row["pname"];
                    $price = $row["poldprice"];
                    $image = $row["pimage"];
                    // Cộng dồn giá tiền vào biến tổng tiền
                    $total += $price;
                    // Hiển thị sản phẩm bằng HTML
                    echo "<div class='product'>";
                    echo '<img src="../assets/images/' . $row["pimage"] . '" alt="điện thoại ' . $row["pname"] . '">';
                    echo "<div class='product-info'>";
                    echo "<div class='product-name'>$name</div>";
                    echo "<div class='product-price'>$price đ</div>";
                    echo "<a href='#' class='product-button'>Chọn gói</a>";
                    echo "<a href='../../action/delete_product_in_cart.php?pname=" . $row['pname'] . "' class='product-delete-button'>Xóa</a>";
                    echo "</div>";
                    echo "</div>";
                }
                // Hiển thị tổng tiền bằng HTML
                echo "<div class='total'>Tạm tính: $total đ</div>";
            } else {
                // Nếu không có dữ liệu, hiển thị thông báo
                echo "Không có sản phẩm nào trong giỏ hàng";
            }
            // Đóng kết nối
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
