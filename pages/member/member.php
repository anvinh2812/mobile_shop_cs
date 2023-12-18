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
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../action/javascript.js">
    <link rel="stylesheet" href="../../css/product_detail.css">
    <link rel="stylesheet" href="../../css/dropbox.css">
    <link rel="stylesheet" href="../../action/dropbox.js">
    <title>Trang thành viên</title>
    <style>
        /* Định dạng các khối chứa */
        #container {
            display: flex;
            height: 100vh;
        }
        #sidebar {
            width: 20%;
            background-color: #f0f0f0;
        }
        #content {
            width: 80%;
            padding: 20px;
        }
        /* Định dạng menu bên trái */
        #sidebar ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        #sidebar li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        #sidebar li:hover {
            background-color: #eee;
        }
        #sidebar li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
        }
        #sidebar li img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        /* Định dạng nội dung chính */
        #content h1 {
            font-size: 24px;
            margin: 0;
        }
        #content p {
            font-size: 16px;
            margin: 10px 0;
        }
        #content span {
            font-weight: bold;
        }
        /* Định dạng các tab lọc */
        #content nav {
            margin: 20px 0;
        }
        #content nav ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
        }
        #content nav li {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #content nav li:hover {
            background-color: #eee;
        }
        #content nav li a {
            text-decoration: none;
            color: #333;
        }
        /* Định dạng khối thông báo */
        #content div {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 300px;
        }
        #content div img {
            width: 100px;
            height: 100px;
        }
        #content div p {
            font-size: 18px;
            color: #999;
        }
    </style>
</head>
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
                                        <p>Lịch sử</p>
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
    <div id="container">
        <div id="sidebar">
            <ul>
                <li><a href="#"><img src="history.png" alt="History">Lịch sử mua hàng</a></li>
                <li><a href="#"><img src="warranty.png" alt="Warranty">Tra cứu bảo hành</a></li>
                <li><a href="#"><img src="offer.png" alt="Offer">Ưu đãi của bạn</a></li>
                <li><a href="#"><img src="goods.png" alt="Goods">Hàng thành viên</a></li>
                <li><a href="#"><img src="account.png" alt="Account">Tài khoản của bạn</a></li>
                <li><a href="#"><img src="support.png" alt="Support">Hỗ trợ</a></li>
                <li><a href="#"><img src="feedback.png" alt="Feedback">Góp ý - Phản hồi</a></li>
                <li><a href="#"><img src="logout.png" alt="Logout">Thoát tài khoản</a></li>
            </ul>
        </div>
        <div id="content">
            <h1>Vhn1F11uv</h1>
            <p><span>0</span> đơn hàng</p>
            <p><span>0d</span> Tổng tiền tích lũy</p>
            <nav>
                <ul>
                    <li><a href="#" onclick="showAll()">Tất cả</a></li>
                    <li><a href="#" onclick="showConfirmed()">Chờ xác nhận</a></li>
                    <li><a href="#" onclick="showReceived()">Đã xác nhận</a></li>
                    <li><a href="#" onclick="showTransported()">Đang vận chuyển</a></li>
                    <li><a href="#" onclick="showDelivered()">Đã giao hàng</a></li>
                    <li><a href="#" onclick="showCancelled()">Đã hủy</a></li>
                </ul>
            </nav>
            <div>
                <img src="no-order.png" alt="No order">
                <p>Không có đơn hàng nào thỏa mãn</p>
            </div>
        </div>
    </div>
</body>
</html>
