<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    //get all nvl
    $nvl = include_once('database/showNVL.php');
    $nvl = json_encode($nvl);
    $pxks = include_once('database/showPhieuXuatKho.php');
    $count = include_once('database/countPhieuXuatKho.php');
    
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
                    <div class="column-add column-5">
                        <div class="dashboard_content_main">
                            <div id="userAddFormContainer">
                            <h1>Lập phiếu xuất kho nguyên vật liệu</h1>
                            <label for="nguyenVatLieu">Chọn Nguyên Vật Liệu cầu xuất kho:   </label>
                            <select id="nguyenVatLieu" onchange="loadLohang()">
                                <!-- Tùy chọn nguyên vật liệu sẽ được đổ vào đây từ PHP -->
                                <?php include('database/showNVLCode.php');?>
                            </select>
                            <br>
                            <br>
                            <table id="lohangTable">
                                <thead>
                                    <tr>
                                        <th>Mã lô hàng</th>
                                        <th>Tên nguyên vật liệu</th>
                                        <th>Số lượng tồn</th>
                                        <th>Đơn vị tính</th>
                                        <th>Ngày sản xuất</th>
                                        <th>Hạn sử dụng</th>
                                        <th>Kho</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="lohangTableBody">
                                    <!-- Dữ liệu được đổ vào đây -->
                                    
                                </tbody>
                            </table>
                              
                            <div id="userAddFormContainer">
                                <h1>Danh sách phiếu xuất kho nguyên vật liệu</h1>
                                <div class="user">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Mã phiếu xuất kho</th>
                                                <th>Ngày lập phiếu</th>
                                                <th>Mã lô hàng</th>
                                                <th>Tên nguyên vật liệu</th>
                                                <th>Số lượng xuất</th>
                                                <th>Đơn vị tính</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pxks as $index => $pxk){ ?>
                                                <tr>
                                                    
                                                    <td><?php echo $pxk['maPhieuXuatKho'] ?></td>
                                                    <td><?php echo $pxk['ngayLapPhieu'] ?></td>
                                                    <td><?php echo $pxk['maLoHang'] ?></td>
                                                    <td><?php echo $pxk['tenNguyenVatLieu'] ?></td>
                                                    <td><?php echo $pxk['soLuong'] ?></td>
                                                    <td><?php echo $pxk['donViTinh'] ?></td>
                                                    
                                                </tr>
                                            <?php } ?>                   
                                        </tbody>
                                    </table>
                                    <p class="userCount"><?php echo count($count) ?> Phiếu xuất kho</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="column-add column-7">
                        
                </div>
                
            </div>
        </div>
    </div>
<script src="js/script.js"></script>
<!-- <script src="js/jquery-3.6.1.min.js"></script> -->
<script>
    // Hàm loadLohang được gọi khi chọn nguyên vật liệu
    function loadLohang() {
        var maNguyenVatLieu = document.getElementById('nguyenVatLieu').value;

        // Sử dụng AJAX để gửi yêu cầu và nhận danh sách lohang
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Cập nhật nội dung bảng lohang
                document.getElementById('lohangTableBody').innerHTML = this.responseText;
            }
        };
        xhr.open('GET', 'database/get-lohangNVL.php?maNguyenVatLieu=' + maNguyenVatLieu, true);
        xhr.send();
    }

    // Lắng nghe sự kiện click cho nút "Sửa"
    $(document).on('click', '#updateBtn', function() {
        // Lấy giá trị từ thuộc tính data-
        var maLoHang = $(this).attr('data-maLoHang');
        var tenNguyenVatLieu = $(this).attr('data-tenNguyenVatLieu');
        var soLuong = $(this).attr('data-soLuong');
        var donViTinh = $(this).attr('data-donViTinh');
        var maKho = $(this).attr('data-maKho');

        // Đặt giá trị vào input trong modal
        $('#UmaLoHang').val(maLoHang);
        $('#UmaNguyenVatLieu').val(tenNguyenVatLieu);
        $('#UsoLuong').val(soLuong);
        $('#UdonViTinh').val(donViTinh);
        $('#UmaKho').val(maKho);

        // Hiển thị modal
        $('#myModal').modal('show');
    });

    // Lắng nghe sự kiện click cho nút "Cập Nhật"
    $(document).on('click', '#updateUserBtn', function() {
        // Lấy dữ liệu từ các input trong modal
        var updatedmaLoHang = $('#UmaLoHang').val();
        var updatedsoLuongXuat = $('#UsoLuongXuat').val();
        
        if (updatedmaLoHang && updatedsoLuongXuat) {
            var xhr = new XMLHttpRequest();
            var url = 'database/save-phieuxuatkho.php';  // Đặt đường dẫn tới file PHP xử lý phía server
            var data = 'maLoHang=' + encodeURIComponent(updatedmaLoHang) +
                '&UsoLuongXuat=' + encodeURIComponent(updatedsoLuongXuat);

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Xử lý phản hồi từ server
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message);
                        // Đóng modal sau khi cập nhật thành công
                        $('#myModal').modal('hide');
                        // Tải lại danh sách lohang sau khi cập nhật
                        loadLohang();
                    } else {
                        alert('Có lỗi xảy ra trong quá trình xử lý yêu cầu.');
                    }
                }
            };

            xhr.send(data);
        } else {
            alert('Vui lòng điền đầy đủ thông tin.');
        }
    });
</script>

</body>
</html>
