<?php
session_start();
include '../connect.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION["error_message"] = "Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!";
    header("Location: ../dashboard/login.php");
    exit();
}

// Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên mid đã đăng nhập
$username = $_SESSION['TenDangNhap1'];
$sqlUserInfo = "SELECT * FROM member WHERE username = '$username'";
$resultUserInfo = mysqli_query($conn, $sqlUserInfo);

if (mysqli_num_rows($resultUserInfo) > 0) {
    $rowUserInfo = mysqli_fetch_assoc($resultUserInfo);
    // Lấy thông tin người dùng
    $mid = $rowUserInfo['mid'];
    $mname = $rowUserInfo['mname'];
    $mphone = $rowUserInfo['mphone'];
    $madd = $rowUserInfo['madd'];
    $memail = $rowUserInfo['memail'];
    // Bạn có thể lấy các thông tin khác tương tự và sử dụng chúng ở bước sau
}

// Lấy thông tin sản phẩm từ URL của cart.php
$productName = $_GET['pname']; // Tên sản phẩm
// Lấy các thông tin sản phẩm khác nếu cần thiết

mysqli_close($conn);
?>
<html>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="../../css/find.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/bill1.css">
</head>
<body>
  <div class="header__height"></div>
      <div class="header__background">
          <div class="header grid wide">
              <div class="row">
                  <!-- Logo Icon -->
                  <div class="header__logo__wrapper">
                      <div class="header__logo">
                      </div>
                      <span class="header__logo__line__1st"></span>
                      <span class="header__logo__line__2nd"></span>
                      <span class="header__logo__line__3rd"></span>
                  </div>
                  <!-- Logo Image -->
                  <div class="header__logo__img">
                      <a href="../../pages/dashboard/home.php"><img src="../assets/logo/logo.png" alt=""></a>
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
                                      $("#search-box").css("background", "#FFF url(../assets/icon/loadicon.png) no-repeat 165px");
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
                                  <a href="../detail/cart_detail.php" class="header__navbar__item__link">
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
      </div>
  </div>
  <div class="container">
    <h1>THÔNG TIN THANH TOÁN</h1>
    <?php
    if (isset($_GET['pname']) && isset($_GET['pprice']) && isset($_GET['pimage'])) {
        echo '<div class="item">';
        echo "<img src='../assets/images1/" . $_GET['pimage'] . "' alt='điện thoại " . $_GET['pname'] . "'>";
        echo '<div class="item-info">';
        echo '<div class="item-name">' . $_GET['pname'] . '</div>';
        echo '<div class="item-price">' . $_GET['pprice'] . ' đ</div>';
        echo '<div class="item-quantity">';
        echo 'Số lượng: <input type="number" id="quantity" name="quantity" value="1" min="1">';
        echo '<button onclick="decrement()">-</button>';
        echo '<button onclick="increment()">+</button>';
        echo '</div>';
        echo '</div>'; // Kết thúc div 'item-info'
        echo '</div>'; // Kết thúc div 'item'
    } else {
        echo '<p>Không có thông tin sản phẩm.</p>';
    }
    ?>
  <script>
    function increment() {
      document.getElementById("quantity").stepUp(1);
    }
    function decrement() {  
      document.getElementById("quantity").stepDown(1);
    }
  </script>
    <form action="payment_aciton.php" method="GET">
      <?php
        echo '<div class="form-group">';
        echo '    <label for="name">HỌ VÀ TÊN</label>';
        echo '    <input type="text" id="name" name="name" placeholder="Nhập họ và tên" required value="' . $mname . '">';
        echo '</div>';
        
        echo '<div class="form-group">';
        echo '    <label for="phone">SỐ ĐIỆN THOẠI</label>';
        echo '    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required value="' . $mphone . '">';
        echo '</div>';
        
        echo '<div class="form-group">';
        echo '    <label for="email">EMAIL</label>';
        echo '    <input type="email" id="email" name="email" placeholder="Nhập email" required value="' . $memail . '">';
        echo '</div>';
      ?>
      <div class="form-group">
        <label for="delivery">THÔNG TIN NHẬN HÀNG</label>
        <select id="delivery" name="delivery" required>
          <option value="">Chọn phương thức thanh toán</option>
          <option value="store">Chuyển khoản</option>
          <option value="home">Thanh toán khi nhận hàng</option>
        </select>
      </div>
      <!-- <div class="form-group">
        <label for="city">Thành Phố</label>
        <select id="city" name="city" required>
          <option value="">Chọn thành phố</option>
          <option value="Hà Nội">Hà Nội</option>
          <option value="Hồ Chí Minh">Hồ Chí Minh</option>
          <option value="Đà Nẵng">Đà Nẵng</option>
          <option value="Hải Phòng">Hải Phòng</option>
          <option value="Cần Thơ">Cần Thơ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="district">Quận</label>
        <select id="district" name="district" required>
          <option value="">Chọn quận</option>
          <option value="Thanh Xuân">Thanh Xuân</option>
          <option value="Hoàn Kiếm">Hoàn Kiếm</option>
          <option value="Ba Đình">Ba Đình</option>
          <option value="Đống Đa">Đống Đa</option>
          <option value="Hai Bà Trưng">Hai Bà Trưng</option>
        </select>
      </div> -->
      <div class="form-group">
        <label for="address">ĐỊA CHỈ NHẬN HÀNG</label>
        <input type="text" id="address" name="address" placeholder="Nhập địa chỉ nhận hàng" required>
      </div>
      <?php
      if (isset($_GET['pprice'])) {
          echo '<div class="total">';
          echo '<div class="total-label">Tổng tiền tạm tính:</div>';
          echo '<div class="total-price" id="total-price">' . number_format($_GET['pprice']) . '₫</div>';
          echo '</div>';
      } else {
          echo '<p>Không có thông tin sản phẩm.</p>';
      }
      ?>
      <script>
        function increment() {
          var quantityField = document.getElementById("quantity");
          quantityField.stepUp(1);
          calculateTotal(); // Gọi hàm tính tổng tiền sau khi cập nhật số lượng
        }
        function decrement() {  
          var quantityField = document.getElementById("quantity");
          quantityField.stepDown(1);
          calculateTotal(); // Gọi hàm tính tổng tiền sau khi cập nhật số lượng
        }

        function calculateTotal() {
          var quantity = document.getElementById("quantity").value;
          var price = <?php echo isset($_GET['pprice']) ? $_GET['pprice'] : 0; ?>;

          // Tính tổng tiền tạm tính
          var totalPrice = quantity * price;

          // Hiển thị tổng tiền tạm tính
          document.getElementById("total-price").textContent = totalPrice.toLocaleString() + '₫';
        }
      </script>
      <button type="submit" class="button">Tiếp tục</button>
    </form>
  </div>
</body>
</html>
