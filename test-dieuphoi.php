<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    $los = include_once('database/showLoHang.php');
    // $done = include_once('database/showLoHang-done.php');
    // var_dump($los)
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
        <?php include('partials/app-sidebar.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php')?>
            <div class="dashboard_content">
                <div class="row-add">
                    <div class="column-add column-5">
                    </div>
                    <div class="column-add column-7">
                        <h1>Danh sách lô hàng cần điều phối</h1>
                        <div class="user">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã lô hàng</th>
                                        <th>Tên nguyên vật liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị tính</th>
                                        <th>Ngày sản xuất</th>
                                        <th>Hạn sử dụng</th>
                                        <th>Mã phiếu nhập kho</th>
                                        <th>Ngày nhập</th>
                                        <th>Kho</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($los as $index => $row) { ?>
                                        <tr>
                                            <td><?php echo $row['maLoHang']  ?></td>
                                            <td><?php echo $row['tenNguyenVatLieu']  ?></td>
                                            <td><?php echo $row['soLuongNhap']  ?></td>
                                            <td><?php echo $row['donViTinh']  ?></td>
                                            <td><?php echo $row['ngaySanXuat']  ?></td>
                                            <td><?php echo $row['hanSuDung']  ?></td>
                                            <td><?php echo $row['maPhieuNhapKho']  ?></td>
                                            <td><?php echo $row['ngayLap']  ?></td>
                                            <td><?php echo $row['tenKho']  ?></td>
                                            <td>
                                            <button id="updateBtn" class="btn btn-primary" 
                                                data-maLohang="<?php echo $row['maLoHang']?>" 
                                                data-tenNguyenVatLieu="<?php echo $row['tenNguyenVatLieu']?>" 
                                                data-soLuong="<?php echo $row['soLuongNhap']?>" 
                                                data-donViTinh="<?php echo $row['donViTinh']?>"
                                                data-ngaySanXuat="<?php echo $row['ngaySanXuat']?>"
                                                data-hanSuDung="<?php echo $row['hanSuDung']?>"
                                                data-maPhieuNhapKho="<?php echo $row['maPhieuNhapKho']?>"
                                                data-ngayLap="<?php echo $row['ngayLap']?>"
                                                data-maKho="<?php echo $row['maKho']?>"><i class="fa fa-pencil">sửa</i></button>
                                                 <!-- Modal Bootstrap -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Điều phối lô hàng vào kho</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form để nhập thông tin mới -->
                                                                <form id="updateForm">
                                                                    <div class="form-group">
                                                                        <label for="UmaLoHang">Mã lô lô hàng:</label>
                                                                        <input type="text" class="form-control" id="UmaLoHang" placeholder="Nhập mã tài khoản" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UmaNguyenVatLieu">Tên nguyên vật liệu</label>
                                                                        <input type="text" class="form-control" id="UmaNguyenVatLieu" placeholder="Nhập mật khẩu"  readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UsoLuong">Số lượng</label>
                                                                        <input type="text" class="form-control" id="UsoLuong" placeholder="Nhập tên tài khoản"  readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UdonViTinh">Đơn vị tính</label>
                                                                        <input type="text" class="form-control" id="UdonViTinh" placeholder="Nhập tên tài khoản"  readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UmaKho">Mã kho:</label>
                                                                        <select class="appFormInput" name="UmaKho" id="UmaKho">
                                                                            <?php include_once('database/showKhoCode.php');?>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Nút cập nhật -->
                                                                <button type="button" class="btn btn-primary" id="updateUserBtn">Cập Nhật</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button id="deleteUser" class="btn btn-danger"data-maLoHang="<?php echo $row['maLoHang']?>"><i class="fa fa-trash">Xóa</i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($los) ?> Lô hàng nhập</p>
                            
                        </div>
                        
                    </div>
                    <div class="column-add column-7">
                        
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<script src="js/script.js"></script>
<!-- <script src="js/jquery-3.6.1.min.js"></script> -->
<script>
    // Sử dụng jQuery để lắng nghe sự kiện click cho nút xóa
    $(document).on('click', '#deleteUser', function(e) {
        e.preventDefault();
        // Lấy mã tài khoản từ thuộc tính data
        var maLoHang = $(this).attr('data-maLoHang');
        // Kiểm tra nếu người dùng chắc chắn muốn xóa
        var isConfirmed = confirm('Bạn có chắc chắn muốn xóa?');

        if (isConfirmed && maLoHang) {
            // Thực hiện Ajax request khi người dùng nhấp vào nút xóa
            var xhr = new XMLHttpRequest();
            var url = 'database/deleteUser.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server
            var data = 'maLoHang=' + encodeURIComponent(maLoHang);

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
            
            var updatedmaKho = $('#UmaKho').val();
            if(updatedmaLoHang)
            {
                var xhr = new XMLHttpRequest();
                var url = 'database/updatePhieuDieuPhoi.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server 
                var data = 'maLoHang=' + encodeURIComponent(updatedmaLoHang) +
                   '&maKho=' + encodeURIComponent(updatedmaKho);

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
