<?php
session_start();
require_once("../connect.php");

if (!isset($_GET['pname'])) {
    echo "Product name not found!";
} else {
    $pname = $_GET['pname'];
    $sql = "SELECT a.*, b.cname FROM product a, categories b WHERE a.cid = b.cid AND a.pname = '$pname'";
    $result = $conn->query($sql) or die($conn->error);
}
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
    <title>Product Details - <?php echo $row['pname']; ?></title>
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
                                        <p>Tra cứu</p>
                                        <p>đơn hàng</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="header__navbar__item">
                            <div class="header__navbar__item__wrapper">
                                <a href="cart.php" class="header__navbar__item__link">
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
    <div class="product_detail">
    <?php
        if (isset($_GET['pname'])) {
            $phoneName = $_GET['pname'];
            echo '<h1 style =>' . $phoneName . '</h1>';
        }
    ?>

        <div class="product_detail_row">
            <div class="product_detail_container">
                <div class="product_detail_picture">
                    <?php
                    include('../connect.php');
                    $receivedPname = $_GET['pname'];
                    $escapedPname = $conn->real_escape_string($receivedPname);
                    $sql = "SELECT * FROM product WHERE pname = '$escapedPname'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $pname = $row['pname'];
                        echo '<img src="../assets/images/' . $row["pimage"] . '" alt="điện thoại ' . $row["pname"] . '">';
                    } else {
                        echo "Không có dữ liệu";
                    }
                    $conn->close();
                    ?>
                </div>
                <div class="product_detail_info_product">
                    <h2>Thông số kỹ thuật</h2>
                    <?php
                        if (isset($_GET['pname'])) {
                            include('../connect.php');

                            // Lấy pname từ URL
                            $receivedPname = $conn->real_escape_string($_GET['pname']);

                            // Truy vấn pid từ bảng product
                            $pidQuery = "SELECT pid FROM product WHERE pname = '$receivedPname'";
                            $pidResult = $conn->query($pidQuery);

                            if ($pidResult->num_rows > 0) {
                                $row = $pidResult->fetch_assoc();
                                $pid = $row['pid'];

                                // Truy vấn thông số từ bảng attribute dựa trên pid
                                $sql = "SELECT * FROM attribute WHERE pid = $pid";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<ul class="info">';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<li>';
                                        echo '<p>' . $row['aname'] . ':' . '</p>';
                                        echo '<div>' . $row['avalue'] . '</div>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo "Không có thông tin sản phẩm";
                                }
                            } else {
                                echo "Không tìm thấy sản phẩm";
                            }
                            $conn->close();
                        }
                    ?>

                </div>
            </div>
            <div class="product_detail_payment">
                <h2 style="margin-top: 9%;">Thanh toán</h2>
                <?php
                include('../connect.php');
                $receivedPname = $_GET['pname'];
                $escapedPname = $conn->real_escape_string($receivedPname);
                $sql = "SELECT pprice FROM product WHERE pname = '$escapedPname'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Sửa lại thứ tự của các thẻ div để mục giá tiền nằm bên trên nút thanh toán
                    echo '<div class="payment_price">';
                    echo '<p>Giá: ' . $row['pprice'] . '</p>';
                    echo '</div>';

                } else {
                    echo "Không có thông tin sản phẩm";
                }
                
                $conn->close();
                ?>
                <div class="payment_buttons">
                    <button type="button">Mua ngay</button>
                    <button type="button">Thêm vào giỏ hàng</button> 
                </div>
            </div>

        </div>
        <hr>
        <div class="comment-area">
    <form action="comment_action.php" method="POST" class="guibinhluan">
        <textarea name="comment" placeholder="Type your comment here..."></textarea>
        <button type="submit">Gửi</button>
    </form>
</div>
    <div class="container_comment">
        <!-- Hiển thị bình luận đã có -->
        <?php
            if (isset($_GET['pname'])) {
                include '../connect.php';
                $receivedPname = $conn->real_escape_string($_GET['pname']);

                // Tìm pid từ bảng product dựa trên pname
                $pidQuery = "SELECT pid FROM product WHERE pname = '$receivedPname'";
                $pidResult = $conn->query($pidQuery);

                if ($pidResult->num_rows > 0) {
                    $row = $pidResult->fetch_assoc();
                    $pid = $row['pid'];
                    // Tiếp tục thực hiện truy vấn để lấy dữ liệu từ bảng comment với pid đã có
                    $commentQuery = "SELECT * FROM comment WHERE pid = $pid";
                    $commentResult = $conn->query($commentQuery);

                    if ($commentResult->num_rows > 0) {
                        while ($comment = $commentResult->fetch_assoc()) {
                            $mid = $comment['mid'];

                            // Truy vấn để lấy mname từ members table dựa trên mid
                            $memberQuery = "SELECT mname FROM member WHERE mid = $mid";
                            $memberResult = $conn->query($memberQuery);

                            if ($memberResult->num_rows > 0) {
                                $member = $memberResult->fetch_assoc();
                                $mname = $member['mname'];

                                echo '<div class="comment">
                                            <i class="fa fa-user-circle"></i>
                                            <h4>' . $mname . '<span>';
                                echo '</span></h4>
                                            <p>' . $comment['content'] . '</p>
                                            <span class="time">' . $comment['comdate'] . '</span>
                                        </div>';
                            } else {
                                echo "Không tìm thấy thông tin thành viên.";
                            }
                        }
                        echo '</div>';
                    } else {
                        echo "Chưa có bình luận nào cho sản phẩm này.";
                    }
                } else {
                    echo "Không tìm thấy sản phẩm.";
                }
            }
        ?>

    </div>
</div>

    </div>
</body>

</html>