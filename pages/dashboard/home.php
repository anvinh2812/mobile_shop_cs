<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // Lấy thông tin người dùng từ session nếu đã đăng nhập
    $username = $_SESSION['TenDangNhap1'];
    // Hiển thị thông tin người dùng hoặc thực hiện các hành động khác sau khi đăng nhập thành công
    echo "Xin chào, $username! Bạn đã đăng nhập thành công.";
    // ...
} else {
    echo '<script type="text/javascript">
                alert("Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
    //header("Location: ../pages/dashboard/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/toast.css">
    <link rel="stylesheet" href="../../action/javascript.js">

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
                    <a href="./home.php"><img src="../assets/img/Desktop logo/1.png" alt=""></a>
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
                                // Kiểm tra nếu đã đăng nhập
                                if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                                    $username = $_SESSION['TenDangNhap1']; // Lấy tên người dùng từ session
                                    echo '
                                    <li class="header__navbar__item">
                                        <div class="header__navbar__item__wrapper">
                                            <a href="logout.php" class="header__navbar__item__link">
                                                <div class="header__navbar__item__link__icon__wrapper__last">
                                                    <i class="far fa-user-circle"></i>
                                                </div>
                                                <div class="header__navbar__item__link__desc__wrapper">
                                                    <p>' . $username . '</p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>';
                                } else {
                                    // Nếu chưa đăng nhập, chuyển hướng đến trang login.php
                                    echo '
                                    <li class="header__navbar__item">
                                        <div class="header__navbar__item__wrapper">
                                            <a href="login.php" class="header__navbar__item__link">
                                                <div class="header__navbar__item__link__icon__wrapper__last">
                                                    <i class="far fa-user-circle"></i>
                                                </div>
                                                <div class="header__navbar__item__link__desc__wrapper">
                                                    <p>Đăng nhập</p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>';
                                }
                            ?>
                            
                        </li>
                            <div id="dropdown-smem" role="menu" class="dropdown-menu">
                                <div class="dropdown-content">
                                    <div class="dropdown-item custom-cursor-on-hover">
                                        <a href="https://cellphones.com.vn/smember">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16">
                                                <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                                            </svg>
                                            <span>&nbsp;Smember</span>
                                        </a>
                                    </div>
                                    <hr class="dropdown-divider">
                                    <div class="dropdown-item">
                                        <a href="#">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out-alt fa-w-16">
                                                <path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
                                            </svg>
                                            <span>&nbsp;Đăng xuất</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .dropdown-menu {
                                    display: none;
                                    /* Các thuộc tính CSS khác cho dropdown menu */
                                }

                                .dropdown-content {
                                    display: none;
                                    /* Các thuộc tính CSS khác cho dropdown content */
                                }

                                .dropdown-menu.show-dropdown {
                                    display: block;
                                }

                                .dropdown-menu.show-dropdown .dropdown-content {
                                    display: block;
                                }

                            </style>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                var dropdownMenu = document.getElementById('dropdown-smem');

                                dropdownMenu.addEventListener('click', function() {
                                    dropdownMenu.classList.toggle('show-dropdown');
                                });
                            });

                            </script>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Slide -->
        <div class="slide grid wide">
            <div class="row">
                <div class="c-2 tablet__slidebar">
                    <div class="slidebar">
                        <ul class="slidebar__list">
                            <?php
                            include '../connect.php';
                            $categoriesQuery = "SELECT cid, cname FROM categories";
                            $categoriesResult = $conn->query($categoriesQuery);
                            if ($categoriesResult->num_rows > 0) {
                                while ($category = $categoriesResult->fetch_assoc()) {
                                    echo '<li class="slidebar__item">';
                                    echo '<a href="../detail/categories_detail.php?cname=' . $category['cname'] . '" class="slidebar__item__link">';
                                    echo '<div class="slidebar__item__link__text__wrapper">';
                                    echo '<div class="slidebar__item__link__text__wrapper__icon__box">';
                                    echo '<i class="fas fa-cube"></i>';
                                    echo '</div>';
                                    echo '<p>' . $category['cname'] . '</p>';
                                    echo '</div>';
                                    echo '<div class="slidebar__item__link__icon__last__wrapper">';
                                    echo '<i class="ti-angle-right"></i>';
                                    echo '</div>';
                                    echo '</a>';
                                    $cid = $category['cid'];
                                    $productsQuery = "SELECT pid, pname FROM product WHERE cid = $cid";
                                    $productsResult = $conn->query($productsQuery);
                                    echo '<div class="slidebar__item__submenu">';
                                    echo '<ul class="slidebar__item__submenu__list">';
                                    while ($product = $productsResult->fetch_assoc()) {
                                        echo '<li class="slidebar__item__submenu__item">';
                                        echo '<a href="../detail/product_detail.php?pname=' . $product['pname'] . '" class="slidebar__item__submenu__item__link">';
                                        echo '<p>' . $product['pname'] . '</p>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            } else {
                                echo "Không có danh mục.";
                            }
                            $conn->close();
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="c-7 pc__slider__wrapper">
                    <div class="slider">
                        <div class="slider__top">
                            <div class="slider__top__next__btn">
                                <i class="fas fa-angle-right"></i>
                            </div>
                            <div class="slider__top__prev__btn">
                                <i class="fas fa-angle-left"></i>
                            </div>
                            <!-- PC -->
                            <div class="slider__top__wrapper" style="transform: translateX(-1369.96px);">
                                <img src="../assets/img/Slide/Slider/1.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/2.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/3.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/4.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/5.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/6.webp" alt="" class="slider__top__item">
                            </div>
                            <!-- End PC -->
                        </div>
                        <div class="slider__bottom">
                            <div class="slider__bottom__list">
                                <!-- 1st -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">Tháng thành viên</p>
                                        <p class="slider__bottom__item__link__text__2nd">Ưu đãi liên miên</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 2nd -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">Z FOLD3 | Z FLIP3 5G</p>
                                        <p class="slider__bottom__item__link__text__2nd">Ưu đãi cực lớn</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 3rd -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">XIAOMI 11T SERIES</p>
                                        <p class="slider__bottom__item__link__text__2nd">Đặt trước ưu đãi khủng</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 4th -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">ZENBOOK 12 OLED</p>
                                        <p class="slider__bottom__item__link__text__2nd">Giá tốt mua ngay</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 5th -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">Loa JBL CHARGE 5</p>
                                        <p class="slider__bottom__item__link__text__2nd">Mở bán giá tốt</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-3">
                    <div class="slide__ads__wrapper tablet__disable">
                        <a href=""><img src="../assets/img/Slide/Ads/1.webp" alt=""></a>
                    </div>
                    <div class="slide__ads__wrapper tablet__disable">
                        <a href=""><img src="../assets/img/Slide/Ads/2.webp" alt=""></a>
                    </div>
                    <div class="slide__ads__wrapper tablet__disable">
                        <a href=""><img src="../assets/img/Slide/Ads/3.webp" alt=""></a>
                    </div>
                </div>
            </div>
            <script>
                var NextBtn = document.querySelector('.slider__top__next__btn')
                var PrevtBtn = document.querySelector('.slider__top__prev__btn')
                var SlideWrapper = document.querySelector('.slider__top__wrapper')
                var l = 684.98
                var index = 0
                var positionX = 0
                // Automatic Slider
                var randomNumber
                setInterval(function() {
                    randomNumber = Math.floor(Math.random() * 5)
                    switch (randomNumber) {
                        case 0:
                            index = 0
                            break
                        case 1:
                            index = 1
                            positionX = -l
                            SlideWrapper.style = `transform: translateX(${positionX}px);`
                            break
                        case 2:
                            index = 2
                            positionX = -l * 2
                            SlideWrapper.style = `transform: translateX(${positionX}px);`
                            break
                        case 3:
                            index = 3
                            positionX = -l * 3
                            SlideWrapper.style = `transform: translateX(${positionX}px);`
                            break
                        case 4:
                            index = 4
                            positionX = -l * 4
                            SlideWrapper.style = `transform: translateX(${positionX}px);`
                            break
                        case 5:
                            index = 5
                            positionX = -l * 4
                            SlideWrapper.style = `transform: translateX(${positionX}px);`
                            break
                    }
                }, 5000)
                // Button Slider
                NextBtn.addEventListener('click', function() {
                    Handle(1)
                })
                PrevtBtn.addEventListener('click', function() {
                    Handle(-1)
                })

                function Handle($number) {
                    if ($number == 1) {
                        if (index >= 5) return
                        positionX = positionX - l
                        SlideWrapper.style = `transform: translateX(${positionX}px);`
                            ++index
                        console.log('index', index)
                    } else if ($number == -1) {
                        if (index <= 0) return
                        positionX = positionX + l
                        SlideWrapper.style = `transform: translateX(${positionX}px);`
                            --index
                    }
                }
            </script>
        </div>
        <!-- ADS -->
        <div class="web__ads gird wide">
            <div class="row">
                <div class="web__ads__box">
                    <a href="">
                        <img src="../assets/img/Web ads/1.webp" alt="" class="web__ads__box__pc__img">
                    </a>
                    <a href="">
                        <img src="../assets/Tablet img/slide ads.webp" alt="" class="web__ads__box__tablet__img">
                    </a>
                </div>
            </div>
        </div>
        <!-- flash__sale -->
        <div class="flash__sale grid wide">
            <div class="row">
                <div class="c-6">
                    <div class="flash__hot__sale">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="272.222" height="38.337" viewBox="0 0 272.222 38.337">
                            <defs>
                                <filter id="Path_1419" x="27.652" y="8.388" width="111.756" height="22.383" filterUnits="userSpaceOnUse">
                                    <feOffset dy="1" input="SourceAlpha"></feOffset>
                                    <feGaussianBlur stdDeviation="0.5" result="blur"></feGaussianBlur>
                                    <feFlood flood-opacity="0.502"></feFlood>
                                    <feComposite operator="in" in2="blur"></feComposite>
                                    <feComposite in="SourceGraphic"></feComposite>
                                </filter>
                                <filter id="Path_1420" x="140.854" y="1.116" width="131.369" height="29.655" filterUnits="userSpaceOnUse">
                                    <feOffset dy="1" input="SourceAlpha"></feOffset>
                                    <feGaussianBlur stdDeviation="0.5" result="blur-2"></feGaussianBlur>
                                    <feFlood flood-opacity="0.502"></feFlood>
                                    <feComposite operator="in" in2="blur-2"></feComposite>
                                    <feComposite in="SourceGraphic"></feComposite>
                                </filter>
                                <filter id="power" x="0" y="0" width="27.109" height="38.337" filterUnits="userSpaceOnUse">
                                    <feOffset dy="2" input="SourceAlpha"></feOffset>
                                    <feGaussianBlur stdDeviation="0.5" result="blur-3"></feGaussianBlur>
                                    <feFlood flood-opacity="0.502"></feFlood>
                                    <feComposite operator="in" in2="blur-3"></feComposite>
                                    <feComposite in="SourceGraphic"></feComposite>
                                </filter>
                            </defs>
                            <g id="Group_184" data-name="Group 184" transform="translate(-98.699 -620)">
                                <g id="Group_364" data-name="Group 364" transform="translate(-107 6)">
                                    <g id="Group_185" data-name="Group 185" transform="translate(134 10)">
                                        <g transform="matrix(1, 0, 0, 1, 71.7, 604)" filter="url(#Path_1419)">
                                            <path id="Path_1419-2" data-name="Path 1419" d="M-38.372,0h-4.309l1.514-7.583H-47.3L-48.814,0h-4.335l3.765-18.84h4.335l-1.579,7.893h6.133l1.579-7.893h4.309Zm18.917-7.725a10.532,10.532,0,0,1-3.06,5.868A8.045,8.045,0,0,1-28.176.272a6.224,6.224,0,0,1-5.059-2.31,6.5,6.5,0,0,1-1.229-5.687l.686-3.39a10.7,10.7,0,0,1,3-5.875,7.853,7.853,0,0,1,5.6-2.122,6.358,6.358,0,0,1,5.111,2.323,6.438,6.438,0,0,1,1.294,5.674Zm-3.623-3.416a4.488,4.488,0,0,0-.382-3.338,2.633,2.633,0,0,0-2.387-1.268,2.732,2.732,0,0,0-2.31,1.255,8.575,8.575,0,0,0-1.313,3.351l-.686,3.416a4.769,4.769,0,0,0,.3,3.377A2.513,2.513,0,0,0-27.5-3.093a2.876,2.876,0,0,0,2.355-1.281,8.122,8.122,0,0,0,1.385-3.351Zm19.461-4.335h-4.49L-11.2,0h-4.335l3.093-15.476h-4.451l.673-3.364H-2.944ZM4.975-4.7a1.83,1.83,0,0,0-.323-1.714A8.106,8.106,0,0,0,2.465-7.686,11.971,11.971,0,0,1-2.109-10.3a4,4,0,0,1-1.016-3.817A5.512,5.512,0,0,1-.621-17.8a8.742,8.742,0,0,1,4.846-1.307,6.476,6.476,0,0,1,4.6,1.553,4.163,4.163,0,0,1,1.08,4.218l-.039.078H5.661a2.018,2.018,0,0,0-.375-1.812,2.193,2.193,0,0,0-1.734-.673,2.63,2.63,0,0,0-1.5.472,1.79,1.79,0,0,0-.828,1.132,1.481,1.481,0,0,0,.4,1.572,12.773,12.773,0,0,0,2.769,1.352A9.4,9.4,0,0,1,8.482-8.7a4.479,4.479,0,0,1,.8,3.979A5.516,5.516,0,0,1,6.8-.983,8.885,8.885,0,0,1,1.947.272,8.1,8.1,0,0,1-2.885-1.145Q-4.872-2.562-4.212-5.5l.026-.078H.019q-.3,1.423.524,1.954a3.759,3.759,0,0,0,2.077.531,2.735,2.735,0,0,0,1.495-.459A1.79,1.79,0,0,0,4.975-4.7ZM20.166-3.662h-5.2L13.269,0H8.935L18.29-18.84h4.632L24.76,0H20.412ZM16.517-7.026h3.429l-.414-6.3-.078-.013ZM31.009-3.364h7.44L37.777,0H26l3.765-18.84H34.1ZM52.2-8.061H45.463l-.932,4.7h7.958L51.816,0H39.524l3.765-18.84H55.607l-.673,3.364H46.951l-.815,4.05h6.741Z" transform="translate(82.3 28)" fill="#fb4700"></path>
                                        </g>
                                        <path id="Path_1418" data-name="Path 1418" d="M-37.648,0h-4.228l1.485-7.439h-6.018L-47.893,0h-4.253l3.694-18.484H-44.2l-1.549,7.744h6.018l1.549-7.744h4.228Zm18.561-7.579a10.333,10.333,0,0,1-3,5.757A7.894,7.894,0,0,1-27.644.267,6.107,6.107,0,0,1-32.608-2a6.382,6.382,0,0,1-1.206-5.58l.673-3.326A10.494,10.494,0,0,1-30.2-16.669a7.7,7.7,0,0,1,5.5-2.082,6.238,6.238,0,0,1,5.015,2.279,6.316,6.316,0,0,1,1.27,5.567Zm-3.555-3.352a4.4,4.4,0,0,0-.375-3.275,2.583,2.583,0,0,0-2.342-1.244,2.68,2.68,0,0,0-2.266,1.231,8.413,8.413,0,0,0-1.289,3.288l-.673,3.352a4.679,4.679,0,0,0,.3,3.313,2.466,2.466,0,0,0,2.3,1.231,2.822,2.822,0,0,0,2.311-1.257,7.969,7.969,0,0,0,1.358-3.288Zm19.094-4.253H-7.954L-10.988,0h-4.253l3.034-15.184h-4.367l.66-3.3H-2.888ZM4.881-4.608a1.8,1.8,0,0,0-.317-1.682,7.953,7.953,0,0,0-2.146-1.25,11.745,11.745,0,0,1-4.488-2.564,3.923,3.923,0,0,1-1-3.745A5.408,5.408,0,0,1-.609-17.469a8.578,8.578,0,0,1,4.754-1.282,6.354,6.354,0,0,1,4.513,1.523,4.084,4.084,0,0,1,1.06,4.139l-.038.076H5.554a1.98,1.98,0,0,0-.368-1.777,2.151,2.151,0,0,0-1.7-.66,2.581,2.581,0,0,0-1.473.463A1.756,1.756,0,0,0,1.2-13.876a1.453,1.453,0,0,0,.394,1.542A12.532,12.532,0,0,0,4.31-11.007,9.226,9.226,0,0,1,8.322-8.538a4.394,4.394,0,0,1,.787,3.9A5.411,5.411,0,0,1,6.671-.965,8.717,8.717,0,0,1,1.911.267a7.952,7.952,0,0,1-4.742-1.39Q-4.78-2.514-4.132-5.4l.025-.076H.019q-.292,1.4.514,1.917a3.688,3.688,0,0,0,2.038.521,2.683,2.683,0,0,0,1.466-.451A1.756,1.756,0,0,0,4.881-4.608Zm14.9,1.016h-5.1L13.019,0H8.766l9.179-18.484H22.49L24.292,0H20.027Zm-3.58-3.3H19.57l-.406-6.183-.076-.013ZM30.424-3.3h7.3L37.064,0H25.511l3.694-18.484h4.253ZM51.219-7.909H44.6L43.691-3.3H51.5L50.838,0H38.778l3.694-18.484H54.558l-.66,3.3H46.065l-.8,3.974h6.614Z" transform="translate(154.5 631)" fill="#fedb00" stroke="#a71609" stroke-linecap="round" stroke-width="0.5"></path>
                                    </g>
                                    <g id="Group_363" data-name="Group 363" transform="translate(257 10)">
                                        <g transform="matrix(1, 0, 0, 1, -51.3, 604)" filter="url(#Path_1420)">
                                            <path id="Path_1420-2" data-name="Path 1420" d="M-48.782-6.612l.039.078a9.606,9.606,0,0,1-2.691,5.085A7.368,7.368,0,0,1-56.571.272a6.244,6.244,0,0,1-4.995-2.193,6.189,6.189,0,0,1-1.2-5.532l.789-3.934A10.413,10.413,0,0,1-59.114-17.1a7.381,7.381,0,0,1,5.273-2.012A6.4,6.4,0,0,1-48.9-17.248a5.918,5.918,0,0,1,1.3,5.059l-.026.065h-4.231a4.035,4.035,0,0,0-.233-2.717,2.286,2.286,0,0,0-2.135-.906,2.654,2.654,0,0,0-2.116,1.2,7.455,7.455,0,0,0-1.313,3.138l-.789,3.959a5.178,5.178,0,0,0,.123,3.228,2.023,2.023,0,0,0,2,1.132A2.754,2.754,0,0,0-54.2-3.959a5.8,5.8,0,0,0,1.216-2.653Zm19.2-12.228L-32.051-6.5a7.885,7.885,0,0,1-2.989,5.1A9.4,9.4,0,0,1-40.695.272a6.516,6.516,0,0,1-4.872-1.8A5.213,5.213,0,0,1-46.7-6.5l2.471-12.344h4.335L-42.364-6.5a3.245,3.245,0,0,0,.239,2.627,2.533,2.533,0,0,0,2.1.776,3.437,3.437,0,0,0,2.329-.841A4.378,4.378,0,0,0-36.386-6.5l2.471-12.344ZM-14.505-7.725a10.532,10.532,0,0,1-3.06,5.868A8.045,8.045,0,0,1-23.226.272a6.224,6.224,0,0,1-5.059-2.31,6.5,6.5,0,0,1-1.229-5.687l.686-3.39a10.7,10.7,0,0,1,3-5.875,7.853,7.853,0,0,1,5.6-2.122,6.358,6.358,0,0,1,5.111,2.323,6.438,6.438,0,0,1,1.294,5.674Zm-3.623-3.416a4.488,4.488,0,0,0-.382-3.338A2.633,2.633,0,0,0-20.9-15.747a2.732,2.732,0,0,0-2.31,1.255,8.575,8.575,0,0,0-1.313,3.351l-.686,3.416a4.769,4.769,0,0,0,.3,3.377,2.513,2.513,0,0,0,2.349,1.255A2.876,2.876,0,0,0-20.2-4.374a8.122,8.122,0,0,0,1.385-3.351Zm-2.29-12.81h3.558l3,3.241-.026.071h-3.74l-1.333-1.773L-21-20.638h-3.714l-.026-.084Zm8.281-2.433h3.688l.039.078-3.312,3.481-2.95-.006ZM-9.109,0h-4.309l3.765-18.84h4.309ZM15.527-15.476h-4.49L7.945,0H3.61L6.7-15.476H2.251l.673-3.364H16.2ZM32.439-18.84,29.968-6.5a7.885,7.885,0,0,1-2.989,5.1A9.4,9.4,0,0,1,21.324.272a6.516,6.516,0,0,1-4.872-1.8A5.213,5.213,0,0,1,15.32-6.5L17.792-18.84h4.335L19.655-6.5a3.245,3.245,0,0,0,.239,2.627,2.533,2.533,0,0,0,2.1.776,3.437,3.437,0,0,0,2.329-.841A4.378,4.378,0,0,0,25.633-6.5L28.1-18.84Zm8.6,15.178h-5.2L34.147,0H29.813l9.355-18.84H43.8L45.637,0H41.29ZM37.4-7.026h3.429l-.414-6.3-.078-.013Zm9.7-13.4-.039.084h-3.74L42-22.114l-2.07,1.773h-3.7l-.026-.084,4.322-3.228h3.545Zm-9.239-2.1H34.937L32.97-26.086h3.778ZM61.656,0H57.335L53.608-11.568l-.078.013L51.214,0H46.88l3.765-18.84H54.98L58.706-7.272l.078-.013L61.1-18.84h4.322Z" transform="translate(205.3 28)" fill="#fb4700"></path>
                                        </g>
                                        <path id="Path_1421" data-name="Path 1421" d="M-47.861-6.487l.038.076a9.425,9.425,0,0,1-2.641,4.989A7.229,7.229,0,0,1-55.5.267a6.126,6.126,0,0,1-4.9-2.152,6.072,6.072,0,0,1-1.181-5.427l.774-3.859A10.217,10.217,0,0,1-58-16.777a7.242,7.242,0,0,1,5.173-1.974,6.278,6.278,0,0,1,4.843,1.828,5.806,5.806,0,0,1,1.276,4.964l-.025.063h-4.151a3.959,3.959,0,0,0-.229-2.666,2.243,2.243,0,0,0-2.095-.889,2.6,2.6,0,0,0-2.076,1.174A7.314,7.314,0,0,0-56.57-11.2l-.774,3.885a5.081,5.081,0,0,0,.121,3.167,1.984,1.984,0,0,0,1.961,1.111,2.7,2.7,0,0,0,2.082-.851,5.7,5.7,0,0,0,1.193-2.6Zm18.84-12L-31.446-6.373a7.736,7.736,0,0,1-2.933,5.008A9.227,9.227,0,0,1-39.927.267,6.393,6.393,0,0,1-44.707-1.5a5.115,5.115,0,0,1-1.111-4.875l2.425-12.111h4.253L-41.564-6.373A3.184,3.184,0,0,0-41.33-3.8a2.485,2.485,0,0,0,2.063.762,3.372,3.372,0,0,0,2.285-.825A4.3,4.3,0,0,0-35.7-6.373l2.425-12.111Zm14.79,10.905a10.333,10.333,0,0,1-3,5.757A7.894,7.894,0,0,1-22.788.267,6.107,6.107,0,0,1-27.752-2a6.382,6.382,0,0,1-1.206-5.58l.673-3.326a10.494,10.494,0,0,1,2.945-5.764,7.7,7.7,0,0,1,5.5-2.082,6.238,6.238,0,0,1,5.015,2.279,6.316,6.316,0,0,1,1.27,5.567Zm-3.555-3.352a4.4,4.4,0,0,0-.375-3.275A2.583,2.583,0,0,0-20.5-15.45a2.68,2.68,0,0,0-2.266,1.231,8.413,8.413,0,0,0-1.289,3.288l-.673,3.352a4.679,4.679,0,0,0,.3,3.313,2.466,2.466,0,0,0,2.3,1.231,2.822,2.822,0,0,0,2.311-1.257,7.969,7.969,0,0,0,1.358-3.288ZM-20.033-23.5h3.491l2.945,3.18-.025.07h-3.669L-18.6-21.988-20.6-20.249h-3.644l-.025-.083Zm8.125-2.387H-8.29l.038.076-3.25,3.415L-14.4-22.4ZM-8.937,0h-4.228l3.694-18.484h4.228ZM15.234-15.184H10.829L7.795,0H3.542L6.576-15.184H2.209l.66-3.3H15.895Zm16.593-3.3L29.4-6.373A7.736,7.736,0,0,1,26.47-1.365,9.227,9.227,0,0,1,20.922.267,6.393,6.393,0,0,1,16.142-1.5a5.115,5.115,0,0,1-1.111-4.875l2.425-12.111h4.253L19.284-6.373A3.184,3.184,0,0,0,19.519-3.8a2.485,2.485,0,0,0,2.063.762,3.372,3.372,0,0,0,2.285-.825,4.3,4.3,0,0,0,1.282-2.514l2.425-12.111ZM40.27-3.593h-5.1L33.5,0H29.25l9.179-18.484h4.545L44.776,0H40.511Zm-3.58-3.3h3.364l-.406-6.183-.076-.013ZM46.211-20.04l-.038.083H42.5L41.209-21.7l-2.031,1.739H35.547l-.025-.083,4.24-3.167H43.24ZM37.146-22.1H34.277l-1.93-3.491h3.707ZM60.493,0h-4.24L52.6-11.35l-.076.013L50.248,0H46l3.694-18.484h4.253L57.6-7.135l.076-.013,2.272-11.337h4.24Z" transform="translate(154.5 631)" fill="#fedb00" stroke="#a71609" stroke-linecap="round" stroke-width="0.5"></path>
                                    </g>
                                </g>
                                <g transform="matrix(1, 0, 0, 1, 98.7, 620)" filter="url(#power)">
                                    <path id="power-2" data-name="power" d="M8.315,0,0,17H8.315L2.772,34l19.4-21.25H11.087L19.4,0Z" transform="translate(2.3 0.5)" fill="#fedb00" stroke="#f3a306" stroke-width="1"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="c-6 flash__sale__box__tablet">
                    <div class="coutdown">
                        <h1 class="coutdown__title">
                            Kết thúc sau
                        </h1>
                        <div class="time">
                            <h1 id="day">01</h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="hour">11</h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="minutes">59</h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="sec">22</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flash__sale__product__list__wrapper">
                <div class="flash__sale__product__list">
                    <?php
                    include '../connect.php';
                    $limit = 5;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start = ($page - 1) * $limit;
                    $sql = "SELECT COUNT(*) AS total FROM product"; // Truy vấn để đếm tổng số sản phẩm
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $total_records = $row['total']; // Tổng số sản phẩm


                    $sql = "SELECT * FROM product LIMIT $start, $limit";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="../detail/product_detail.php?pname=' . $row["pname"] . '">';
                            echo '<div class="flash__sale__product">';
                            echo '<div class="flash__sale__discount">';
                            echo '<p>' . $row["pprice"] . '</p>';
                            echo '</div>';
                            echo '<div class="flash__sale__product__img__wrapper">';
                            echo '<img src="../assets/img/Feature phone/' . $row["pimage"] . '" alt="">';
                            echo '</div>';
                            echo '<div class="flash__sale__product__desc">';
                            echo '<p class="flash__sale__product__desc__title__1st">' . $row["pname"] . '</p>';
                            echo '<div class="flash__sale__product__desc__price">';
                            echo '<div class="flash__sale__product__desc__price__new">';
                            echo '<p>' . $row["pprice"] . ' <span class="flash__sale__product__desc__price__unit__new">đ</span></p>';
                            echo '</div>';
                            echo '<div class="flash__sale__product__desc__price__old">';
                            echo '<p>' . $row["pprice"] . ' <span class="flash__sale__product__desc__price__unit__old">đ</span></p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>'; // Đóng thẻ a
                        }
                    } else {
                        echo "Không có sản phẩm.";
                    }
                    $total_pages = ceil($total_records / $limit); // Tính tổng số trang
                    $conn->close();
                    ?>
                </div>
            </div>
            <?php
            echo '<div class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a href="home.php?page=' . $i . '">' . $i . '</a> '; // Hiển thị các liên kết đến các trang
            }
            echo '</div>';
            ?>
            <style>
                .pagination {
                    display: flex;
                    justify-content: center;
                }

                .pagination a {
                    color: white;
                    font-weight: bold;
                    text-decoration: none;
                    /* Loại bỏ gạch chân */
                    padding: 5px 10px;
                    /* Khoảng cách giữa các trang */
                    margin: 0 3px;
                    /* Khoảng cách giữa các trang */
                }

                .pagination a:hover {
                    background-color: gray;
                    /* Màu nền khi di chuột qua */
                }
            </style>
        </div>
        <!-- hot__phone -->
        <div class="featured__phone grid wide">
            <div class="row featured__phone__gutter">
                <div class="c-3">
                    <div class="featured__phone__title">
                        <a href="" class="featured__phone__title__text">Điện thoại nổi bật nhất</a>
                    </div>
                </div>
                <div class="c-7">
                    <div class="featured__phone__related__tag">
                        <?php
                        include '../connect.php';

                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="featured__phone__related__tag">';
                                echo '<a href="?category=' . $row["cid"] . '" class="futured__phone__item">' . $row["cname"] . '</a>';
                                echo '</div>';
                            }
                        } else {
                            echo "Không có dữ liệu";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
                <!-- Product List -->
                <?php
                include '../connect.php';
                $productsPerPage = 5; // Số lượng sản phẩm trên mỗi trang
                $category_id = isset($_GET['category']) ? $_GET['category'] : 1; // 1 là ID của danh mục mặc định
                $page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
                // Tính tổng số sản phẩm theo từng danh mục
                $countSql = "SELECT COUNT(*) AS total FROM product";
                if ($category_id !== null) {
                    $countSql .= " WHERE cid = $category_id";
                }
                $countResult = $conn->query($countSql);
                $countRow = $countResult->fetch_assoc();
                $totalProducts = $countRow['total'];
                $totalPages = ceil($totalProducts / $productsPerPage); // Tính tổng số trang
                // Xây dựng câu truy vấn lấy dữ liệu sản phẩm theo từng trang và danh mục
                $start = ($page - 1) * $productsPerPage;
                $sql = "SELECT * FROM product";
                if ($category_id !== null) {
                    $sql .= " WHERE cid = $category_id";
                }
                $sql .= " ORDER BY phot ASC LIMIT $start, $productsPerPage";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="featured__phone__product__list">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="../detail/product_detail.php?pname=' . $row["pname"] . '">';
                        echo '<div class="featured__phone__product__item">';
                        // Hiển thị thông tin sản phẩm
                        echo '<div class="flash__sale__discount">';
                        echo '<p>' . $row['pprice'] . '</p>';
                        echo '</div>';
                        echo '<div class="featured__phone__product__img__wrapper">';
                        echo '<img src="../assets/img/Feature phone/' . $row['pimage'] . '">';
                        echo '</div>';
                        echo '<div class="featured__phone__product__desc">';
                        echo '<div class="featured__phone__product__desc__title">';
                        echo '<div class="featured__phone__product">';
                        echo $row['pname'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="featured__phone__product__desc__price">';
                        echo '<div class="featured__phone__product__desc__price__new">';
                        echo '<p>';
                        echo number_format($row['pprice'], 0, '', '.');
                        echo '<span class="featured__phone__product__desc__price__unit__new">đ</span>';
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';
                        // Các phần khác của sản phẩm
                        // ...
                        echo '</div>'; // Kết thúc featured__phone__product__desc
                        echo '</div>'; // Kết thúc featured__phone__product__item
                        echo '</a>';
                    }
                    echo '</div>'; // Kết thúc featured__phone__product__list
                } else {
                    echo "Không có sản phẩm.";
                }

                $conn->close();
                ?>

            </div>
            <?php
            echo '<div class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="home.php?page=' . $i . '&category=' . $category_id . '">' . $i . '</a> '; // Hiển thị các liên kết đến các trang
            }
            echo '</div>';
            ?>
            <style>
                .pagination {
                    display: flex;
                    justify-content: center;
                    background-color: bisque;
                }

                .pagination a {
                    color: white;
                    font-weight: bold;
                    text-decoration: none;
                    /* Loại bỏ gạch chân */
                    padding: 5px 10px;
                    /* Khoảng cách giữa các trang */
                    margin: 0 3px;
                    /* Khoảng cách giữa các trang */
                }

                .pagination a:hover {
                    background-color: gray;
                    /* Màu nền khi di chuột qua */
                }
            </style>
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
                    <img src="../assets/img/footer information/1.png" alt="">
                </div>
                <div class="footer__certification__img__wrapper">
                    <img src="../assets/img/footer information/2.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>

</html>