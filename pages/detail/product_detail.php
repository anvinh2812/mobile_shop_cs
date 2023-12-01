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
        <title>Product Details - <?php echo $row['pname']; ?></title>
    </head>

    <body>
        <div class="header__height"></div>
        <div class="header grid wide">
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
                <!-- Submenu modal -->
                <div class="header__location__submenu__modal"></div>
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
                            <?php
                            // Giả sử $loggedIn là biến lưu trữ trạng thái đăng nhập (true hoặc false)
                            $loggedIn = true; // Thay đổi giá trị này tùy theo logic của bạn

                            if ($loggedIn) {
                                // Nếu đã đăng nhập, thay đổi nội dung thành tên người dùng
                                $username = "Tên người dùng"; // Thay bằng tên người dùng thực tế
                                echo '
                                    <div class="header__navbar__item__wrapper">
                                        <a href="profile.php" class="header__navbar__item__link">
                                            <div class="header__navbar__item__link__icon__wrapper__last">
                                                <i class="far fa-user-circle"></i>
                                            </div>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>' . $username . '</p>
                                            </div>
                                        </a>
                                    </div>';
                            } else {
                                // Nếu chưa đăng nhập, hiển thị nút đăng nhập
                                echo '
                                    <div class="header__navbar__item__wrapper">
                                        <a href="login.php" class="header__navbar__item__link">
                                            <div class="header__navbar__item__link__icon__wrapper__last">
                                                <i class="far fa-user-circle"></i>
                                            </div>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Đăng nhập</p>
                                            </div>
                                        </a>
                                    </div>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chitietSanpham">  
            <h1><?php echo $pname; ?></h1>
            <div class="rowdetail group">
                <div class="picture">
                    <?php
                        include('../connect.php');

                        // Lấy giá trị của 'pname' từ trang web khác (giả sử là biến $receivedPname)
                        $receivedPname = $_GET['pname']; // Biến này chứa 'pname' từ URL hoặc dữ liệu nhận được từ trang web khác

                        // Escape các giá trị để tránh các vấn đề bảo mật
                        $escapedPname = $conn->real_escape_string($receivedPname);

                        $sql = "SELECT pimage FROM product WHERE pname = '$escapedPname'"; // Thực hiện truy vấn dựa trên 'pname'
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Lấy URL của hình ảnh từ kết quả truy vấn
                            $row = $result->fetch_assoc();
                            // Hiển thị hình ảnh trong thẻ <img>
                            echo '<img src="../assets/images/' . $row["pimage"] . '" alt="">';
                        } else {
                            echo "Không có dữ liệu";
                        }

                        // Đóng kết nối với cơ sở dữ liệu
                        $conn->close();
                    ?>

                </div>
                <div class="price_sale">
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
                        echo '<div class="area_price">';
                        // Hiển thị giá sản phẩm
                        echo 'Giá sản phẩm ' . $escapedPname . ' là: ' . $productPrice;
                        echo '</div>';
                    } else {
                        echo "Không có thông tin sản phẩm";
                    }
                    // Đóng kết nối với cơ sở dữ liệu
                    $conn->close();
                    ?>
                </div>
            
                <div class="info_product">
                    <?php
                    include('../connect.php');

                    // Truy vấn thông tin từ bảng 'attribute' dựa trên 'pid' (giả sử 'pid' là 1)
                    $sql = "SELECT * FROM attribute WHERE pid = 1"; // Thay 'pid' thành giá trị tương ứng nếu cần
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<h2>Thông số kỹ thuật</h2>';
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
            </div>
            </div>
        </div>
    </body>
</html>