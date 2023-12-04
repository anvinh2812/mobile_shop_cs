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
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../action/javascript.js">
        <link rel="stylesheet" href="../../css/chitietsanpham.css">
        <link rel="stylesheet" href="../../css/dropbox.css">
        <link rel="stylesheet" href="../../action/dropbox.js">
        <title>Product Details - <?php echo $row['pname']; ?></title>
    </head>
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
                <div class="header__logo__img">
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
                                <a href="" class="header__navbar__item__link">
                                    <i class="fas fa-phone-alt"></i>
                                    <div class="header__navbar__item__link__desc__wrapper">
                                        <p>Gọi mua hàng</p>
                                        <p>1800.2097</p>
                                    </div>
                                </a>
                            </div>
                        </li>
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="product_detail">  
            <h1><?php echo $pname; ?></h1>
            <div class="row_product_detail">
                <div class="row_product_picture">
                    <?php
                        include('../connect.php');
                        // Lấy giá trị của 'pname' từ trang web khác (giả sử là biến $receivedPname)
                        $receivedPname = $_GET['pname']; // Biến này chứa 'pname' từ URL hoặc dữ liệu nhận được từ trang web khác
                        // Escape các giá trị để tránh các vấn đề bảo mật
                        $escapedPname = $conn->real_escape_string($receivedPname);
                        $sql = "SELECT * FROM product WHERE pname = '$escapedPname'"; // Thực hiện truy vấn dựa trên 'pname'
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Lấy URL của hình ảnh từ kết quả truy vấn
                            $row = $result->fetch_assoc();
                            $pname = $row['pname'];
                            // Hiển thị hình ảnh trong thẻ <img>
                            echo '<img src="../assets/images/' . $row["pimage"] . '" alt="điện thoại ' . $row["pname"] . '">';
                        } else {
                            echo "Không có dữ liệu";
                        }
                        // Đóng kết nối với cơ sở dữ liệu
                        $conn->close();
                    ?>
                </div>
                <div class="row_product_price">
                    <div class="row_product_area_price">
                    <?php
                    include('../connect.php');

                    // Nhận giá trị 'pname' từ trang web hoặc dữ liệu được chuyển đến từ nơi khác
                    $receivedPname = $_GET['pname']; // Giả sử 'pname' được truyền qua tham số URL

                    // Escape giá trị 'pname' để tránh các vấn đề bảo mật
                    $escapedPname = $conn->real_escape_string($receivedPname);

                    // Truy vấn để lấy giá sản phẩm từ bảng 'products' dựa trên 'pname'
                    $sql = "SELECT pprice FROM product WHERE pname = '$escapedPname'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $productPrice = $row['pprice'];
                       // echo '<div class="area_price">';
                        // Hiển thị giá sản phẩm
                        echo 'Giá sản phẩm ' . $escapedPname . ' là: ' . $productPrice;
                        //echo '</div>';
                    } else {
                        echo "Không có thông tin sản phẩm";
                    }
                    // Đóng kết nối với cơ sở dữ liệu
                    $conn->close();
                    ?>
                    </div>
                </div>
                <div class="info_product">
                    <h2>Thông số kỹ thuật</h2>
                    <?php
                    include('../connect.php');

                    // Truy vấn thông tin từ bảng 'attribute' dựa trên 'pid' (giả sử 'pid' là 1)
                    $sql = "SELECT * FROM attribute WHERE pid = 1"; // Thay 'pid' thành giá trị tương ứng nếu cần
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {   
                        echo '<ul class="info">';
                        // Hiển thị thông tin từ bảng 'attribute'
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>';
                            echo '<p>' . $row['aname'] . '</p>';
                            echo '<div>' . $row['avalue'] . '</div>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo "Không có thông tin sản phẩm";
                    }
                    // Đóng kết nối với cơ sở dữ liệu
                    $conn->close();
                    ?>
            </div>
        </div>
        <hr>
            <div class="comment-area">
                <div class="guiBinhLuan">
                    <div class="stars">
                        <form action="">
                            <input class="star star-5" id="star-5" value="5" type="radio" name="star">
                            <label class="star star-5 custom-cursor-default-hover" for="star-5" title="Tuyệt vời"></label>

                            <input class="star star-4" id="star-4" value="4" type="radio" name="star">
                            <label class="star star-4 custom-cursor-default-hover" for="star-4" title="Tốt"></label>

                            <input class="star star-3" id="star-3" value="3" type="radio" name="star">
                            <label class="star star-3" for="star-3" title="Tạm"></label>

                            <input class="star star-2" id="star-2" value="2" type="radio" name="star">
                            <label class="star star-2" for="star-2" title="Khá"></label>

                            <input class="star star-1" id="star-1" value="1" type="radio" name="star">
                            <label class="star star-1" for="star-1" title="Tệ"></label>
                        </form>
                    </div>
                    <textarea maxlength="250" id="inpBinhLuan" placeholder="Viết suy nghĩ của bạn vào đây..."></textarea>
                    <input id="btnBinhLuan" type="button" onclick="checkGuiBinhLuan()" value="GỬI BÌNH LUẬN">
                </div>
                <div class="container_comment">
                    <?php
                    if (isset($_GET['pname'])) {
                        include '../connect.php';
                        $receivedPname = $_GET['pname'];

                        $escapedPname = $conn->real_escape_string($receivedPname);

                        // Tìm pid từ bảng product dựa trên pname
                        $pidQuery = "SELECT pid FROM product WHERE pname = '$escapedPname'";
                        $pidResult = $conn->query($pidQuery);

                        if ($pidResult->num_rows > 0) {
                            $row = $pidResult->fetch_assoc();
                            $pid = $row['pid'];
                            // Tiếp tục thực hiện truy vấn để lấy dữ liệu từ bảng comment với pid đã có
                            $commentQuery = "SELECT * FROM comment WHERE pid = $pid";
                            $commentResult = $conn->query($commentQuery);

                            if ($commentResult->num_rows > 0) {
                                while ($comment = $commentResult->fetch_assoc()) {
                                    echo '<div class="comment">
                                            <i class="fa fa-user-circle"></i>
                                            <h4>' . $comment['mid'] . '<span>';
                                    echo '</span></h4>
                                            <p>' . $comment['content'] . '</p>
                                            <span class="time">' . $comment['comdate'] . '</span>
                                        </div>';
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