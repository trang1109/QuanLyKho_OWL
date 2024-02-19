<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
	//echo $name;
    $bbs = include('database/showBienBanKiemKe.php');
    // var_dump($bbs)
	//echo $name;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWL Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard_style.css">
    <link rel="icon" href="image/logo/icons8-the-flash-sign-100.png" type="image/x-icon" />
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- Thêm thư viện Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

   


</head>
<body>
    <div id="dashboardMainContainer">
    <?php include('partials/if-main.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php')?>
            <div class="dashboard_content">
                <div class="row-add">
                    
                    <div class="column-add column-7">
                        <h1>Danh sách biên bản kiểm kê</h1>
                        <div class="user">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Biên Bản </th>
                                        <th>Tên kho</th>
                                        <th>Mã lô hàng</th>
                                        <th>Tên nguyên vật liệu</th>
                                        <th>Mô tả kiểm kê</th>
                                        <th>Số lượng kiểm kê</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bbs as $index => $tk) { ?>
                                        <tr>
                                            <td><?php echo $index + 1 ?></td>
                                            <td><?php echo $tk['maBienBanKiemKe'] ?></td>
                                            <td><?php echo $tk['tenKho'] ?></td>
                                            <td><?php echo $tk['maLoHang'] ?></td>
                                            <td><?php echo $tk['tenNguyenVatLieu'] ?></td>
                                            <td><?php echo $tk['moTaKiemKe'] ?></td>
                                            <td><?php echo $tk['soLuongKiemKe'] ?></td>
                                            <td><?php echo $tk['trangThai'] ?></td>
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($bbs) ?> Biên bản kiểm kê</p>
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<script src="js/script.js"></script>
<!-- <script src="js/jquery-3.6.1.min.js"></script> -->
<script>
    function loadLoHangs() {
        var maKho = document.getElementById('maKho').value;
        console.log(maKho);
        // Sử dụng AJAX để gửi yêu cầu và nhận danh sách mã lô hàng
        // Sử dụng AJAX để gửi yêu cầu và nhận danh sách lohang
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Cập nhật nội dung bảng lohang
                document.getElementById('maLoHang').innerHTML = this.responseText;
            }
        };
        xhr.open('GET', 'database/get-lohangs.php?maKho=' + maKho, true);
        xhr.send();
    }
    function loadChiTiet() {
        var maLoHang = document.getElementById('maLoHang').value;
        console.log(maLoHang);
        // Sử dụng AJAX để gửi yêu cầu và nhận danh sách mã lô hàng
        // Sử dụng AJAX để gửi yêu cầu và nhận danh sách lohang
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Cập nhật nội dung bảng lohang
                document.getElementById('chiTietLoHang').innerHTML = this.responseText;
            }
        };
        xhr.open('GET', 'database/get-chitietlohangs.php?maLoHang=' + maLoHang, true);
        xhr.send();
    }
    // Sử dụng jQuery để lắng nghe sự kiện click cho nút xóa
    $(document).on('click', '#deleteUser', function(e) {
        e.preventDefault();
        // Lấy mã tài khoản từ thuộc tính data
        var mabb = $(this).attr('data-mabb');
        // Kiểm tra nếu người dùng chắc chắn muốn xóa
        var isConfirmed = confirm('Bạn có chắc chắn muốn xóa?');

        if (isConfirmed && mabb) {
            // Thực hiện Ajax request khi người dùng nhấp vào nút xóa
            var xhr = new XMLHttpRequest();
            var url = 'database/deleteUser.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server
            var data = 'mabb=' + encodeURIComponent(mabb);

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Xử lý phản hồi từ server
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message);
                    } else {
                        alert('Có lỗi xảy ra trong quá trình xử lý yêu cầu.');
                    }
                }
            };

            xhr.send(data);
        }
    });
    // Lắng nghe sự kiện click cho nút "Sửa"
    $(document).on('click', '#updateBtn', function() {
            // Lấy giá trị từ thuộc tính data-
            var mabb = $(this).attr('data-mabb');
            var matKhau = $(this).attr('data-matKhau');
            var tenbb = $(this).attr('data-tenbb');

            // Đặt giá trị vào input trong modal
            $('#Umabb').val(mabb);
            $('#UmatKhau').val(matKhau);
            $('#Utenbb').val(tenbb);

            // Hiển thị modal
            $('#myModal').modal('show');
        });

        // Lắng nghe sự kiện click cho nút "Cập Nhật"
        $(document).on('click', '#updateUserBtn', function() {
            // Lấy dữ liệu từ các input trong modal
            var updatedMabb = $('#Umabb').val();
            var updatedMatKhau = $('#UmatKhau').val();
            var updatedTenbb = $('#Utenbb').val();
            var updateTrangThai = $('#UtrangThai').val();
            if(updatedMabb)
            {
                var xhr = new XMLHttpRequest();
                var url = 'database/updateUsers.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server 
                var data = 'mabb=' + encodeURIComponent(updatedMabb) +
                   '&matKhau=' + encodeURIComponent(updatedMatKhau) +
                   '&tenbb=' + encodeURIComponent(updatedTenbb) +
                   '&trangThai=' + encodeURIComponent(updateTrangThai);

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // Xử lý phản hồi từ server
                            var response = JSON.parse(xhr.responseText);
                            alert(response.message);
                            // Đóng modal sau khi cập nhật thành công
                            $('#myModal').modal('hide');
                        } else {
                            alert('Có lỗi xảy ra trong quá trình xử lý yêu cầu.');
                        }
                    }
                };

                xhr.send(data);
            }
        });
</script>
</body>
</html>
