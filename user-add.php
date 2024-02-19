<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    $taikhoans = include('database/showUsers.php');
    // var_dump($taikhoans)
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
            <div class="title">
                    <h1>Quản Lý Người Dùng</h1>
            </div>
            <div class="dashboard_content">
                <div class="row-add">
                    <div class="column-add column-5">
                        <div class="dashboard_content_main">
                        <div id="userAddFormContainer">
                            <form action="database/addUser.php" method="post" class="appForm">
                                <div class=appCoverInput>
                                    <label for="">Mã tài khoản</label><br>
                                    <input class="appFormInput" type="text" name="maTaiKhoan" id="maTaiKhoan">
                                </div>
                                <div class=appCoverInput>
                                    <label for="">Mật khẩu</label><br>
                                    <input class="appFormInput" type="password" name="matKhau" id="matKhau">
                                </div>
                                <div class=appCoverInput>
                                    <label for="">Tên tài khoản</label><br>
                                    <input class="appFormInput"type="text" name="tenTaiKhoan" id="tenTaiKhoan">
                                </div>
                                
                                <button class="appBtn" type="submit"><i class="fa fa-plus"> Thêm tài khoản</i></button>
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
                    <div class="column-add column-7">
                        <h2>Tất cả người dùng</h2>
                        <div class="user">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã tài khoản</th>
                                        <th>Mật khẩu</th>
                                        <th>Tên tài khoản</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($taikhoans as $index => $tk) { ?>
                                        <tr>
                                            <td><?php echo $index + 1 ?></td>
                                            <td><?php echo $tk['maTaiKhoan'] ?></td>
                                            <td><?php echo $tk['matKhau'] ?></td>
                                            <td><?php echo $tk['tenTaiKhoan'] ?></td>
                                            <td><?php echo $tk['trangThai'] ?></td>
                                            <td>
                                                <button id="updateBtn" class="btn btn-primary" 
                                                data-maTaiKhoan="<?php echo $tk['maTaiKhoan']?>" 
                                                data-matKhau="<?php echo $tk['matKhau']?>" 
                                                data-tenTaiKhoan="<?php echo $tk['tenTaiKhoan']?>" ><i class="fa fa-pencil">sửa</i></button>
                                                 <!-- Modal Bootstrap -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin Tài Khoản</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form để nhập thông tin mới -->
                                                                <form id="updateForm">
                                                                    <div class="form-group">
                                                                        <label for="UmaTaiKhoan">Mã Tài Khoản:</label>
                                                                        <input type="text" class="form-control" id="UmaTaiKhoan" placeholder="Nhập mã tài khoản" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UmatKhau">Mật Khẩu:</label>
                                                                        <input type="text" class="form-control" id="UmatKhau" placeholder="Nhập mật khẩu">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UtenTaiKhoan">Tên Tài Khoản:</label>
                                                                        <input type="text" class="form-control" id="UtenTaiKhoan" placeholder="Nhập tên tài khoản">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UtrangThai">Trạng Thái:</label>
                                                                        <select class="form-control" id="UtrangThai">
                                                                            <option value="Đang hoạt động">Đang hoạt động</option>
                                                                            <option value="Tạm khóa">Tạm khóa</option>
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

                                                <button id="deleteUser" class="btn btn-danger"data-maTaiKhoan="<?php echo $tk['maTaiKhoan']?>"><i class="fa fa-trash">Xóa</i></button>
                                            </td>
                                            
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($taikhoans) ?> Users</p>
                            
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
        var maTaiKhoan = $(this).attr('data-maTaiKhoan');
        // Kiểm tra nếu người dùng chắc chắn muốn xóa
        var isConfirmed = confirm('Bạn có chắc chắn muốn xóa?');

        if (isConfirmed && maTaiKhoan) {
            // Thực hiện Ajax request khi người dùng nhấp vào nút xóa
            var xhr = new XMLHttpRequest();
            var url = 'database/deleteUser.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server
            var data = 'maTaiKhoan=' + encodeURIComponent(maTaiKhoan);

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
            var maTaiKhoan = $(this).attr('data-maTaiKhoan');
            var matKhau = $(this).attr('data-matKhau');
            var tenTaiKhoan = $(this).attr('data-tenTaiKhoan');

            // Đặt giá trị vào input trong modal
            $('#UmaTaiKhoan').val(maTaiKhoan);
            $('#UmatKhau').val(matKhau);
            $('#UtenTaiKhoan').val(tenTaiKhoan);

            // Hiển thị modal
            $('#myModal').modal('show');
        });

        // Lắng nghe sự kiện click cho nút "Cập Nhật"
        $(document).on('click', '#updateUserBtn', function() {
            // Lấy dữ liệu từ các input trong modal
            var updatedMaTaiKhoan = $('#UmaTaiKhoan').val();
            var updatedMatKhau = $('#UmatKhau').val();
            var updatedTenTaiKhoan = $('#UtenTaiKhoan').val();
            var updateTrangThai = $('#UtrangThai').val();
            if(updatedMaTaiKhoan)
            {
                var xhr = new XMLHttpRequest();
                var url = 'database/updateUsers.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server 
                var data = 'maTaiKhoan=' + encodeURIComponent(updatedMaTaiKhoan) +
                   '&matKhau=' + encodeURIComponent(updatedMatKhau) +
                   '&tenTaiKhoan=' + encodeURIComponent(updatedTenTaiKhoan) +
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
