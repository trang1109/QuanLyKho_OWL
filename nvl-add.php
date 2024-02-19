<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    $nvls = include('database/showNVL.php');
    // var_dump($tainvlans)
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

    <!-- Thêm thư viện Bootstrap Dialog -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.min.js"></script>


</head>
<body>
    <div id="dashboardMainContainer">
    <?php include('partials/if-main.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php')?>
            <div class="title">
                <h1>Quản lý Nguyên Vật Liệu</h1>
            </div>
            <div class="dashboard_content">
                <div class="row-add">
                    <div class="column-add column-5">
                        <div class="dashboard_content_main">
                        <div id="userAddFormContainer">
                            <form action="database/addNVL.php" method="post" class="appForm">
                                <div class="appCoverInput">
                                    <label for="tenNguyenVatLieu">Tên nguyên vật liệu</label><br>
                                    <input class="appFormInput" type="text" name="tenNguyenVatLieu" id="tenNguyenVatLieu">
                                </div>
                                <div class="appCoverInput">
                                    <label for="soLuong">Số lượng</label><br>
                                    <input class="appFormInput" type="number" name="soLuong" id="soLuong">
                                </div>
                                <div class="appCoverInput">
                                    <label for="donViTinh">Đơn vị tính</label><br>
                                    <select class="appFormInput" name="donViTinh" id="donViTinh">
                                        <option value="kg">kg</option>
                                        <option value="tấn">tấn</option>
                                    </select>
                                </div>

                                <button class="appBtn" type="submit"><i class="fa fa-plus"> Thêm Nguyên Vật Liệu</i></button>
                                <button class="appBtnReset" type="reset"><i class="fa fa-refresh"> Đặt lại</i></button>
                            </form>

                            <?php 
                                if(isset($_SESSION['response']))
                                {
                                    $response_message = $_SESSION['response']['message'];
                                    $is_success = $_SESSION['response']['success'];
                            ?>

                                <div class="responseMessage">
                                    <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                    <p class="responseMessageText">
                                        <?php echo $response_message ?>
                                    </p>
                                        
                                    </p>
                                    
                                </div>
                            <?php unset($_SESSION['response']); } ?>
                        </div>

                   
                        </div>
                    </div>
                    <h2>Tất cả nguyên vật liệu</h2>
                    <div class="column-add column-7">
                        <div class="user">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã NVL</th>
                                        <th>Tên NVL</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị tính</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nvls as $index => $nvl) { ?>
                                        <tr>
                                            <td><?php echo $nvl['maNguyenVatLieu'] ?></td>
                                            <td><?php echo $nvl['tenNguyenVatLieu'] ?></td>
                                            <td><?php echo $nvl['soLuong'] ?></td>
                                            <td><?php echo $nvl['donViTinh'] ?></td>
                                            <td><?php echo $nvl['trangThai'] ?></td>
                                            <td>
                                            <button id="updateBtn" class="btn btn-primary" 
                                                data-maNguyenVatLieu="<?php echo $nvl['maNguyenVatLieu']?>" 
                                                data-tenNguyenVatLieu="<?php echo $nvl['tenNguyenVatLieu']?>" 
                                                data-soLuong="<?php echo $nvl['soLuong']?>"
                                                data-donViTinh="<?php echo $nvl['donViTinh']?>"
                                                data-trangThai="<?php echo $nvl['trangThai']?>" ><i class="fa fa-pencil">Sửa</i></button>
                                                 <!-- Modal Bootstrap -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin Nguyên Vật Liệu</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form để nhập thông tin mới -->
                                                                <form id="updateForm">
                                                                    <div class="form-group">
                                                                        <label for="UmaNguyenVatLieu">Mã nguyên vật liệu:</label>
                                                                        <input type="text" class="form-control" id="UmaNguyenVatLieu" placeholder="Nhập mã nguyên vật liệu" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UtenNguyenVatLieu">Tên nguyên vật liệu:</label>
                                                                        <input type="text" class="form-control" id="UtenNguyenVatLieu" placeholder="Nhập tên nguyên vật liệu" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UsoLuong">Số lượng</label>
                                                                        <input type="text" class="form-control" id="UsoLuong" placeholder="Nhập" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UdonViTinh">Đơn vị tính:</label>
                                                                        <select class="appFormInput" name="UdonViTinh" id="UdonViTinh">
                                                                            <option value="kg">kg</option>
                                                                            <option value="tấn">tấn</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UtrangThai">Trạng Thái:</label>
                                                                        <select class="form-control" id="UtrangThai">
                                                                            <option value="Đang sử dụng">Đang sử dụng</option>
                                                                            <option value="Dừng hoạt động">Ngưng sử dụng</option>
                                                                            <!-- Add more options as needed -->
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

                                                <button id="deletenvl" class="btn btn-danger" data-maNguyenVatLieu="<?php echo $nvl['maNguyenVatLieu']?>"><i class="fa fa-trash">Xóa</i></button>
                                            </td>
                                            
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($nvls);?> nguyên vật liệu</p>
                            
                        </div>
                        
                    </div>
                
            </div>
        </div>
    </div>
<script src="js/script.js"></script>
<!-- <script src="js/jquery-3.6.1.min.js"></script> -->
<script>
    // Sử dụng jQuery để lắng nghe sự kiện click cho nút xóa
    $(document).on('click', '#deletenvl', function(e) {
        e.preventDefault();
        // Lấy mã tài nvlản từ thuộc tính data
        var maNguyenVatLieu = $(this).attr('data-maNguyenVatLieu'); // Sử dụng data() thay vì attr()
        // console.log(maNguyenVatLieu)
        // Kiểm tra nếu người dùng chắc chắn muốn xóa
        var isConfirmed = confirm('Bạn có chắc chắn muốn xóa?');

        if (isConfirmed && maNguyenVatLieu) {
            // Thực hiện Ajax request khi người dùng nhấp vào nút xóa
            var xhr = new XMLHttpRequest();
            var url = 'database/deletenvl.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server
            var data = 'maNguyenVatLieu=' + encodeURIComponent(maNguyenVatLieu); // Thêm dấu "=" và sửa thành "&"

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
            var maNguyenVatLieu = $(this).attr('data-maNguyenVatLieu');
            var tenNguyenVatLieu = $(this).attr('data-tenNguyenVatLieu');
            var soLuong = $(this).attr('data-soLuong');
            var donViTinh = $(this).attr('data-donViTinh');
            var trangThai = $(this).attr('data-trangThai');

            // Đặt giá trị vào input trong modal
            $('#UmaNguyenVatLieu').val(maNguyenVatLieu);
            $('#UtenNguyenVatLieu').val(tenNguyenVatLieu);
            $('#UsoLuong').val(soLuong);
            $('#UdonViTinh').val(donViTinh);
            $('#UtrangThai').val(trangThai);

            // Hiển thị modal
            $('#myModal').modal('show');
        });

        // Lắng nghe sự kiện click cho nút "Cập Nhật"
        $(document).on('click', '#updateUserBtn', function() {
            // Lấy dữ liệu từ các input trong modal
            var updatedmaNguyenVatLieu = $('#UmaNguyenVatLieu').val();
            var updatedtenNguyenVatLieu = $('#UtenNguyenVatLieu').val();
            var updatedsoLuong =$('#UsoLuong').val();
            var updateddonViTinh = $('#UdonViTinh').val();
            var updatedTrangThai = $('#UtrangThai').val();
           
            if(updatedmaNguyenVatLieu)
            {
                var xhr = new XMLHttpRequest();
                var url = 'database/updatenvl.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server 
                var data = 'maNguyenVatLieu=' + encodeURIComponent(updatedmaNguyenVatLieu) +
                   '&tenNguyenVatLieu=' + encodeURIComponent(updatedtenNguyenVatLieu) +
                   '&soLuong=' + encodeURIComponent(updatedsoLuong) +
                   '&donViTinh=' + encodeURIComponent(updateddonViTinh) +
                   '&trangThai=' + encodeURIComponent(updatedTrangThai);

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
