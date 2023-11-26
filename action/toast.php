<?php
// Lấy thông tin từ URL
$title = isset($_GET['title']) ? $_GET['title'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'info'; // Nếu không có type, sử dụng 'info' mặc định

// Tạo toast message HTML dựa trên thông tin nhận được
$toastHTML = '
    <div class="toast toast--' . $type . '">
        <div class="toast__icon">
            <!-- Icon ở đây -->
        </div>
        <div class="toast__body">
            <h3 class="toast__title">' . $title . '</h3>
            <p class="toast__msg">' . $message . '</p>
        </div>
        <div class="toast__close">
            <!-- Nút đóng ở đây -->
        </div>
    </div>';

// Xuất thông báo về login_action.php
echo $toastHTML;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        display: flex;
        flex-direction: column;
        font-family: system-ui, sans-serif;
        background-color: #f4f4f5;
    }
    body>div {
        margin: auto;
    }
    /* ====== Toast message ======== */
    #toast {
        position: fixed;
        top: 32px;
        right: 32px;
        z-index: 999999;
    }

    .toast {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 2px;
        padding: 20px 0;
        min-width: 400px;
        max-width: 450px;
        border-left: 4px solid;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.08);
        transition: all linear 0.3s;
    }
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(calc(100% + 32px));
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    @keyframes fadeOut {
        to {
            opacity: 0;
        }
    }
    .toast--success {
        border-color: #47d864;
    }

    .toast--success .toast__icon {
        color: #47d864;
    }

    .toast--info {
        border-color: #2f86eb;
    }

    .toast--info .toast__icon {
        color: #2f86eb;
    }

    .toast--warning {
        border-color: #ffc021;
    }

    .toast--warning .toast__icon {
        color: #ffc021;
    }

    .toast--error {
        border-color: #ff623d;
    }

    .toast--error .toast__icon {
        color: #ff623d;
    }

    .toast+.toast {
        margin-top: 24px;
    }

    .toast__icon {
        font-size: 24px;
    }

    .toast__icon,
    .toast__close {
        padding: 0 16px;
    }

    .toast__body {
        flex-grow: 1;
    }

    .toast__title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .toast__msg {
        font-size: 14px;
        color: #888;
        margin-top: 6px;
        line-height: 1.5;
    }

    .toast__close {
        font-size: 20px;
        color: rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }
    </style>
</head>
<body>
    <div id="toast">
        <div class="toast toast--success">
            <div class="toast__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">Thành Công</h3>
                <p class="toast__msg">Đăng Nhập Thành Công</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        </div>

        <div class="toast toast--error">
            <div class="toast__icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">Lỗi</h3>
                <p class="toast__msg">Đã xảy ra lỗi khi thực hiện hành động này.</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        </div>

        <div class="toast toast--info">
            <div class="toast__icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">Thông tin</h3>
                <p class="toast__msg">Thông tin cần được hiển thị ở đây.</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
    <script>
        // Toast function
function toast({ title = "", message = "", type = "info", duration = 3000 }) {
  const main = document.getElementById("toast");
  if (main) {
    const toast = document.createElement("div");

    // Auto remove toast
    const autoRemoveId = setTimeout(function () {
      main.removeChild(toast);
    }, duration + 1000);

    // Remove toast when clicked
    toast.onclick = function (e) {
      if (e.target.closest(".toast__close")) {
        main.removeChild(toast);
        clearTimeout(autoRemoveId);
      }
    };

    const icons = {
      success: "fas fa-check-circle",
      info: "fas fa-info-circle",
      warning: "fas fa-exclamation-circle",
      error: "fas fa-exclamation-circle"
    };
    const icon = icons[type];
    const delay = (duration / 1000).toFixed(2);

    toast.classList.add("toast", `toast--${type}`);
    toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;

    toast.innerHTML = `
                    <div class="toast__icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="toast__body">
                        <h3 class="toast__title">${title}</h3>
                        <p class="toast__msg">${message}</p>
                    </div>
                    <div class="toast__close">
                        <i class="fas fa-times"></i>
                    </div>
                `;
    main.appendChild(toast);
  }
}

    </script>
</body>
</html>
