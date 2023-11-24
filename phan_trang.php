<!DOCTYPE html>
<html>
<head>
    <title>Phân trang AJAX</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="productList">
        <!-- Nội dung sản phẩm được tải ở đây -->
        <!-- Sẽ được cập nhật bằng AJAX -->
    </div>
    <div class="pagination">
        <!-- Các nút phân trang -->
        <div class="so_trang">
            <!-- Các liên kết trang được tạo ở đây -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Bắt sự kiện click cho các liên kết phân trang
            $(".so_trang a").on("click", function(e) {
                e.preventDefault();

                var page = $(this).attr("href");

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: "home.php",
                    type: "POST",
                    data: { page: page },
                    success: function(data) {
                        $("#productList").html(data);
                    },
                    error: function() {
                        alert("Error occurred while processing.");
                    }
                });
            });
        });
    </script>
</body>
</html>
