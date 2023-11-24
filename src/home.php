<?php
    session_start();
	require_once("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="./assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">

    <title>Nhom 13</title>
</head>
<body>
    <div id="main">
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
                            <a href=""><img src="./assets/img/Desktop logo/1.png" alt=""></a>
                        </div>      
                                <!-- Submenu Location Store -->
                                <div class="header__location__submenu">
                                    <ul class="header__location__submenu__list">
                                        <li class="header__location__submenu__item">
                                            <a href="" class="header__location__submenu__item__link">
                                                <i class="fas fa-map-marker-alt header__location__submenu__item__link__icon"></i>
                                                <p class="header__location__submenu__item__link__text">&ensp;Hồ Chí Minh</p>
                                            </a>
                                        </li>
                                        <li class="header__location__submenu__item">
                                            <a href="" class="header__location__submenu__item__link">
                                                <i class="fas fa-map-marker-alt header__location__submenu__item__link__icon"></i>
                                                <p class="header__location__submenu__item__link__text">&ensp;Hà Nội</p>
                                            </a>
                                        </li>
                                        <li class="header__location__submenu__item">
                                            <a href="" class="header__location__submenu__item__link">
                                                <i class="fas fa-map-marker-alt header__location__submenu__item__link__icon"></i>
                                                <p class="header__location__submenu__item__link__text">&ensp;Bình Dương</p>
                                            </a>
                                        </li>
                                        <li class="header__location__submenu__item">
                                            <a href="" class="header__location__submenu__item__link">
                                                <i class="fas fa-map-marker-alt header__location__submenu__item__link__icon"></i>
                                                <p class="header__location__submenu__item__link__text">&ensp;Hải Dương</p>
                                            </a>
                                        </li>
                                        <li class="header__location__submenu__item">
                                            <a href="" class="header__location__submenu__item__link">
                                                <i class="fas fa-map-marker-alt header__location__submenu__item__link__icon"></i>
                                                <p class="header__location__submenu__item__link__text">&ensp;Hải Phòng</p>
                                            </a>
                                        </li>
                                        <li class="header__location__submenu__item">
                                            <a href="" class="header__location__submenu__item__link">
                                                <i class="fas fa-map-marker-alt header__location__submenu__item__link__icon"></i>
                                                <p class="header__location__submenu__item__link__text">&ensp;Bắc Ninh</p>
                                            </a>
                                        </li>
                                    </ul>
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
                            $("#search-box").keyup(function(){
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
                        });
                        function selectCountry(val) {
                            $("#search-box").val(val);
                            $("#suggestion-box").hide();
                        }
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
                                        <a href="" class="header__navbar__item__link">
                                                <i class="ti-location-pin"></i>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Cửa hàng</p>
                                                <p>gần bạn</p> 
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <a href="" class="header__navbar__item__link">
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
                                        <a href="" class="header__navbar__item__link">
                                                <i class="ti-bag"></i>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Giỏ</p>
                                                <p>hàng</p> 
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper__last">
                                        <a href="" class="header__navbar__item__link">
                                            <div class="header__navbar__item__link__icon__wrapper__last">
                                                <i class="far fa-user-circle"></i>
                                            </div>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Smember</p> 
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
        </div>
        <!-- End header -->
        <!-- Slide -->  
        <div class="slide grid wide">
            <div class="row">
                    <div class="c-2 tablet__slidebar">
                        <div class="slidebar">
                            <ul class="slidebar__list">
                            <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                    <div class="slidebar__item__link__text__wrapper">
                                            <div class="slidebar__item__link__text__wrapper__icon__box">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <p>Điện thoại</p>
                                    </div>
                                    <div class="slidebar__item__link__icon__last__wrapper">
                                        <i class="ti-angle-right"></i>
                                    </div>
                                </a>
                                <!-- Subnav điện thoại -->
                                <div class="slidebar__item__submenu">
                                    <ul class="slidebar__item__submenu__list">
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Apple</p>  
                                                <i class="ti-angle-right"></i>                                              
                                                </a>
                                                <!-- Subnav Second Điện thoại-->
                                                <div class="slidebar__item__submenu__second">
                                                    <ul class="slidebar__item__submenu__list">
                                                        <li class="slidebar__item__submenu__item">
                                                            <a href="" class="slidebar__item__submenu__item__link">
                                                                <p>iPhone 12 Series</p>
                                                            </a>
                                                        </li>
                                                        <li class="slidebar__item__submenu__item">
                                                            <a href="" class="slidebar__item__submenu__item__link">
                                                                <p>iPhone 11 Series</p>
                                                            </a>
                                                        </li>
                                                        <li class="slidebar__item__submenu__item">
                                                            <a href="" class="slidebar__item__submenu__item__link">
                                                                <p>iPhone X | XR</p>
                                                            </a>
                                                        </li>
                                                        <li class="slidebar__item__submenu__item">
                                                            <a href="" class="slidebar__item__submenu__item__link">
                                                                <p>iPhone SE 2020</p>
                                                            </a>
                                                        </li>
                                                        <li class="slidebar__item__submenu__item">
                                                            <a href="" class="slidebar__item__submenu__item__link">
                                                                <p>iPhone 13 Series</p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Samsung</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Xiaomi</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>OPPO</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Nokia</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Realme</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Vsmart</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>ASUS</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Vivo</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>One Plus</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>POCO</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Nubia</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    </a><p><a href="" class="slidebar__item__submenu__item__link">Điện thoại phổ thông
                                                </a>
                                            </p></li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    </a><p><a href="" class="slidebar__item__submenu__item__link">Tin đồn - Mới ra
                                                </a>
                                            </p></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-laptop"></i>
                                                </div>                                       
                                                <p>Laptop,PC,Màn hình</p>                                            
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    <!-- Subnav laptop,pc-->
                                    </a><div class="slidebar__item__submenu"><a href="" class="slidebar__item__link">
                                    </a><ul class="slidebar__item__submenu__list"><a href="" class="slidebar__item__link">
                                        </a><li class="slidebar__item__submenu__item"><a href="" class="slidebar__item__link">
                                            </a><a href="" class="slidebar__item__submenu__item__link">
                                                <p>Mac</p>  
                                                <i class="ti-angle-right"></i>                                              
                                            </a>
                                            <!-- Subnav Second laptop,pc-->
                                            <div class="slidebar__item__submenu__second">
                                                <ul class="slidebar__item__submenu__list">
                                                    <li class="slidebar__item__submenu__item">
                                                        <a href="" class="slidebar__item__submenu__item__link">
                                                            <p>MacBook Air</p>
                                                        </a>
                                                    </li>
                                                    <li class="slidebar__item__submenu__item">
                                                        <a href="" class="slidebar__item__submenu__item__link">
                                                            <p>MacBook Pro</p>
                                                        </a>
                                                    </li>
                                                    <li class="slidebar__item__submenu__item">
                                                        <a href="" class="slidebar__item__submenu__item__link">
                                                            <p>Mac mini</p>
                                                        </a>
                                                    </li>
                                                    <li class="slidebar__item__submenu__item">
                                                        <a href="" class="slidebar__item__submenu__item__link">
                                                            <p>iMac</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>HP</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Dell</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Lenovo</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Microsoft Surface</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>ASUS</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Acer</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>LG</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Huawei</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>MSI</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Laptop Avita</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Gigabyte</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Máy tính để bàn</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Màn hình</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Máy in</p>
                                            </a>
                                        </li>
                                        <li class="slidebar__item__submenu__item">
                                            <a href="" class="slidebar__item__submenu__item__link">
                                                <p>Linh kiện Laptop</p>
                                            </a>
                                        </li>
                                    </ul>
                                    </div>
                                    
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-tablet-alt"></i>
                                                </div>                                       
                                                <p>Tablet</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                        <!-- Subnav Tablet-->
                                    </a><div class="slidebar__item__submenu"><a href="" class="slidebar__item__link">
                                        </a><ul class="slidebar__item__submenu__list"><a href="" class="slidebar__item__link">
                                            </a><li class="slidebar__item__submenu__item"><a href="" class="slidebar__item__link">
                                                </a><a href="" class="slidebar__item__submenu__item__link">
                                                    <p>iPad Pro</p>                                     
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>iPad 10.2</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>iPad Air</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>iPad mini</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Samsung</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Lenovo</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Xiaomi</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Kindle</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Máy đọc sách</p>
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
                                    
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-headphones-alt"></i>
                                                </div>                                       
                                                <p>Âm thanh</p>                                            
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                        <!-- Subnav Âm thanh-->
                                        </a><div class="slidebar__item__submenu"><a href="" class="slidebar__item__link">
                                            </a><ul class="slidebar__item__submenu__list"><a href="" class="slidebar__item__link">
                                                </a><li class="slidebar__item__submenu__item"><a href="" class="slidebar__item__link">
                                                    </a><a href="" class="slidebar__item__submenu__item__link">
                                                        <p>Loa</p>  
                                                        <i class="ti-angle-right"></i>                                              
                                                    </a>
                                                    <!-- Subnav Second Âm thanh-->
                                                    <div class="slidebar__item__submenu__second">
                                                        <ul class="slidebar__item__submenu__list">
                                                            <li class="slidebar__item__submenu__item">
                                                                <a href="" class="slidebar__item__submenu__item__link">
                                                                    <p>Loa Bluetooth</p>
                                                                </a>
                                                            </li>
                                                            <li class="slidebar__item__submenu__item">
                                                                <a href="" class="slidebar__item__submenu__item__link">
                                                                    <p>Loa Tivi | Soundbar</p>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="slidebar__item__submenu__item">
                                                    <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Tai nghe</p>  
                                                    <i class="ti-angle-right"></i>                                              
                                                    </a>
                                                    <!-- Subnav Second Âm thanh-->
                                                    <div class="slidebar__item__submenu__second">
                                                        <ul class="slidebar__item__submenu__list">
                                                            <li class="slidebar__item__submenu__item">
                                                                <a href="" class="slidebar__item__submenu__item__link">
                                                                    <p>Tai nghe Bluetooth</p>
                                                                </a>
                                                            </li>
                                                            <li class="slidebar__item__submenu__item">
                                                                <a href="" class="slidebar__item__submenu__item__link">
                                                                    <p>Tai nghe nhét tai</p>
                                                                </a>
                                                            </li>
                                                            <li class="slidebar__item__submenu__item">
                                                                <a href="" class="slidebar__item__submenu__item__link">
                                                                    <p>Tai nghe chụp tai</p>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                                    </div>
                                    
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="far fa-clock"></i>
                                                </div>                                       
                                                <p>Đồng hồ</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                        <!-- Subnav Đồng hồ-->
                                    </a><div class="slidebar__item__submenu"><a href="" class="slidebar__item__link">
                                        </a><ul class="slidebar__item__submenu__list"><a href="" class="slidebar__item__link">
                                            </a><li class="slidebar__item__submenu__item"><a href="" class="slidebar__item__link">
                                                </a><a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Apple Watch</p>                                            
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Samsung</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Garmin</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Xiaomi</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Amazfit</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Huawei</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>OPPO</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Hãng khác</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Vòng tay thông minh</p>
                                                </a>
                                            </li>
                                            <li class="slidebar__item__submenu__item">
                                                <a href="" class="slidebar__item__submenu__item__link">
                                                    <p>Đồng hồ định vị trẻ em</p>
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
                                    
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-home"></i>
                                                </div>                                       
                                                <p>Nhà thông minh</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="far fa-keyboard"></i>
                                                </div>                                       
                                                <p>Phụ kiện</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-sync"></i>
                                                </div>                                       
                                                <p>Thu cũ</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-cube"></i>
                                                </div>                                       
                                                <p>Hàng cũ</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-sim-card"></i>
                                                </div>                                       
                                                <p>Sim thẻ</p>
                                        </div>
                                        <div class="slidebar__item__link__icon__last__wrapper">
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="far fa-newspaper"></i>
                                                </div>                                       
                                                <p>Tin công nghệ</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="slidebar__item">
                                    <a href="" class="slidebar__item__link">
                                        <div class="slidebar__item__link__text__wrapper">
                                                <div class="slidebar__item__link__text__wrapper__icon__box">
                                                    <i class="fas fa-bullhorn"></i>
                                                </div>                                       
                                                <p>Khuyến mãi</p>
                                        </div>
                                    </a>
                                </li>
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
                                        <img src="./assets/img/Slide/Slider/1.webp" alt="" class="slider__top__item">
                                        <img src="./assets/img/Slide/Slider/2.webp" alt="" class="slider__top__item">
                                        <img src="./assets/img/Slide/Slider/3.webp" alt="" class="slider__top__item">
                                        <img src="./assets/img/Slide/Slider/4.webp" alt="" class="slider__top__item">
                                        <img src="./assets/img/Slide/Slider/5.webp" alt="" class="slider__top__item">
                                        <img src="./assets/img/Slide/Slider/6.webp" alt="" class="slider__top__item">                                
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
                        <a href=""><img src="./assets/img/Slide/Ads/1.webp" alt=""></a>
                        </div>
                        <div class="slide__ads__wrapper tablet__disable">
                            <a href=""><img src="./assets/img/Slide/Ads/2.webp" alt=""></a>
                        </div>
                        <div class="slide__ads__wrapper tablet__disable">
                            <a href=""><img src="./assets/img/Slide/Ads/3.webp" alt=""></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>