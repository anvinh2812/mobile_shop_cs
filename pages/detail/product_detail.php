<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../action/javascript.js">
    <title>Nhom 13</title>
</head>
<body>
    <div id="main">
        <!-- Header -->
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
                            <a href="home.php"><img src="../assets/img/Desktop logo/1.png" alt=""></a>
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
                            $(document).ready(function(){
                            // Lắng nghe sự kiện khi người dùng gõ vào #search-box
                            $("#search-box").keyup(function(){
                                // Thực hiện AJAX để tìm kiếm và hiển thị kết quả trong #suggestion-box
                                $.ajax({
                                    type: "GET",
                                    url: "action/readProduct.php",
                                    data: 'keyword=' + $(this).val(),
                                    beforeSend: function(){
                                        $("#search-box").css("background","#FFF url(./assets/icon/loadicon.png) no-repeat 165px");
                                    },
                                    success: function(data){
                                        $("#suggestion-box").show();
                                        $("#suggestion-box").html(data);
                                        $("#search-box").css("background","#FFF");
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
                        search__input.addEventListener('click', function(event){
                            search__modal.style.display = 'block';
                            event.stopPropagation();
                        });

                        search__modal.addEventListener('click', function(){
                            search__modal.style.display = 'none';
                        });

                        list_cate.addEventListener('mousedown', function(event) {
                            event.stopPropagation();
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
        <div class="footer__information__background">
            <div class="footer__information grid wide">
            <div class="row footer__information__row">
                <!-- 1st -->
                <div class="c-4">
                        <div class="footer__information__text__1st">
                            <a href="" class="footer__information__text__1st__a">Điện thoại</a>
                            <span>-</span>
                            <a href="" class="footer__information__text__1st__a">Black Friday 2021</a>
                        </div>
                        <div class="footer__information__text__2nd">
                                <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone 11</a>
                                <span>|</span>
                                <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone 12</a>
                                <span>|</span>
                                <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone 13</a>
                            </div>
                            <div class="footer__information__text__3rd">
                                <a href="" class="footer__information__text__3rd__a">Điện thoại Samsung Galaxy Z Fold 3</a>
                                <span>-</span>
                                <a href="" class="footer__information__text__3rd__a">Đồng hồ Apple Watch Series 7</a>
                            </div>
                </div>
                <!-- 2nd -->
                <div class="c-4">
                    <div class="footer__information__text__1st">
                        <br>
                    </div>
                    <div class="footer__information__text__2nd">
                        <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Samsung</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Oppo</a>
                    </div>
                    <div class="footer__information__text__3rd">
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Xiaomi</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Vivo</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại OnePlus</a>
                    </div>
                </div>
                <!-- 3rd -->
                <div class="c-4">
                    <div class="footer__information__text__1st">
                        <a href="" class="footer__information__text__1st__a">Máy tính laptop</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__1st__a">Smart home</a>
                    </div>
                    <div class="footer__information__text__2nd">
                        <a href="" class="footer__information__text__2nd__a">Laptop HP</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__2nd__a">Máy tính để bàn PC</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__2nd__a">Màn hình máy tính</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__2nd__a">Sim số đẹp</a>
                    </div>
                    <div class="footer__information__text__3rd">
                        <a href="" class="footer__information__text__3rd__a">Robot hút bụi</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__3rd__a">Camera</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__3rd__a">Camera hành trình</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__3rd__a">Camera hành trình Vietmap</a>
                    </div>
                </div>
            </div> 
            <div class="row footer__information__row__last">
                    <p>Công ty TNHH Thương mại và dịch vụ kỹ thuật DIỆU PHÚC - GPĐKKD: 0316172372 do sở KH &amp; ĐT TP. HCM cấp ngày 02/03/2020. Địa chỉ: 350-352 Võ Văn Kiệt, Phường Cô Giang, Quận 1, Thành phố Hồ Chí Minh, Việt Nam. Điện thoại: 028.7108.9666.</p>
                </div> 
                <div class="row footer__certification">
                    <div class="footer__certification__img__wrapper">
                        <img src="./assets/img/footer information/1.png" alt="">
                    </div>
                    <div class="footer__certification__img__wrapper">
                        <img src="./assets/img/footer information/2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
</body>
</html>