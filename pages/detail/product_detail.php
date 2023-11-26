<?php
session_start();
require_once("../connect.php");

if (!isset($_GET['pname'])) {
    echo "Product name not found!";
} else {
    $pname = $_GET['pname'];
    $sql = "SELECT a.*, b.cname FROM product a, categories b WHERE a.cid = b.cid AND a.pname = '$pname'";
    $result = $conn->query($sql) or die($conn->error);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
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
            <title>Product Details - <?php echo $row['pname']; ?></title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .detail__phone {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }

                .detail__phone__product__item {
                    display: flex;
                    align-items: center;
                    max-width: 800px;
                    margin: auto;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                }

                .detail__phone__product__img__wrapper {
                    flex: 1;
                    padding: 20px;
                }

                .detail__phone__product__img__wrapper img {
                    max-width: 100%;
                    height: auto;
                    display: block;
                }

                .detail__phone__product__desc {
                    flex: 1;
                    padding: 20px;
                }

                .detail__phone__product__desc h1 {
                    font-size: 24px;
                    margin-bottom: 10px;
                }

                .detail__phone__product__desc p {
                    margin-bottom: 8px;
                }

                /* ... Thêm CSS khác tùy thuộc vào cấu trúc của bạn ... */
            </style>
        </head>

        <body>
            <div class="main">
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
                <div class="detail__phone">
                    <div class="detail__phone__product__item">
                        <div class="detail__phone__product__img__wrapper">
                            <img src="images/<?php echo $row['pimage']; ?>" alt="<?php echo $row['pname']; ?>">
                        </div>
                        <div class="detail__phone__product__desc">
                            <h1><?php echo $row['pname']; ?></h1>
                            <p>Category: <?php echo $row['cname']; ?></p>
                            <p>Price: <?php echo $row['pprice']; ?> đ</p>
                            <p>Description: <?php echo $row['pdesc']; ?></p>
                            <!-- Các thông tin sản phẩm khác có thể thêm ở đây -->
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Product not found!";
    }
}
?>