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
    $bbs = include('database/showBienBanKiemKe-no.php');
    $bbdone = include('database/showBienBanKiemKe-done.php');
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
                    <div class="column-add column-5">
                        
                    </div>
                    <div class="column-add column-7">
                        <h1>Danh sách biên bản kiểm kê chờ duyệt</h1>
                        <div class="user">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Biên Bản </th>
                                        <th>Mã tên kho</th>
                                        <th>Mã lô hàng</th>
                                        <th>Tên nguyên vật liệu</th>
                                        <th>Mô tả kiểm kê</th>
                                        <th>Số lượng kiểm kê</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
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
                                            <td>
                                                <button id="updateBtn" class="btn btn-primary" 
                                                data-maBienBanKiemKe="<?php echo $tk['maBienBanKiemKe']?>" 
                                                data-trangThai="<?php echo $tk['trangThai']?>" 
                                                ><i class="fa fa-pencil">Kiểm duyệt</i></button>
                                                 <!-- Modal Bootstrap -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Xử lý biên bản kiểm kê</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form để nhập thông tin mới -->
                                                                <form id="updateForm">
                                                                    <div class="form-group">
                                                                        <label for="UmaBienBanKiemKe">Mã biên bản kiểm kê</label>
                                                                        <input type="text" class="form-control" id="UmaBienBanKiemKe" placeholder="Nhập mã tài khoản" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UtrangThai">Trạng Thái:</label>
                                                                        <select class="form-control" id="UtrangThai">
                                                                            <option value="Chờ duyệt">Chờ duyệt</option>
                                                                            <option value="Không duyệt">Không duyệt</option>
                                                                            <option value="Đã duyệt">Đã duyệt</option>
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

                                            </td>
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($bbs) ?> Biên bản kiểm kê</p>
                            
                        </div>
                        <h1>Danh sách biên bản kiểm kê đã xử lý</h1>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bbdone as $index => $tk) { ?>
                                        <tr>
                                            <td><?php echo $index + 1 ?></td>
                                            <td><?php echo $tk['maBienBanKiemKe'] ?></td>
                                            <td><?php echo $tk['tenKho'] ?></td>
                                            <td><?php echo $tk['maLoHang'] ?></td>
                                            <td><?php echo $tk['tenNguyenVatLieu'] ?></td>
                                            <td><?php echo $tk['moTaKiemKe'] ?></td>
                                            <td><?php echo $tk['soLuongKiemKe'] ?></td>
                                            <td><?php echo $tk['trangThai'] ?></td>
                                            <td>
                                                <button id="updateBtn" class="btn btn-primary" 
                                                data-maBienBanKiemKe="<?php echo $tk['maBienBanKiemKe']?>" 
                                                data-trangThai="<?php echo $tk['trangThai']?>" 
                                                ><i class="fa fa-pencil">Kiểm duyệt</i></button>
                                                 <!-- Modal Bootstrap -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Xử lý biên bản kiểm kê</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form để nhập thông tin mới -->
                                                                <form id="updateForm">
                                                                    <div class="form-group">
                                                                        <label for="UmaBienBanKiemKe">Mã biên bản kiểm kê</label>
                                                                        <input type="text" class="form-control" id="UmaBienBanKiemKe" placeholder="Nhập mã tài khoản" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UtrangThai">Trạng Thái:</label>
                                                                        <select class="form-control" id="UtrangThai">
                                                                            <option value="Không duyệt">Không duyệt</option>
                                                                            <option value="Đã duyệt">Đã duyệt</option>
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

                                            </td>
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($bbdone) ?> Biên bản kiểm kê</p>
                            
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
    // Lắng nghe sự kiện click cho nút "Sửa"
    $(document).on('click', '#updateBtn', function() {
            // Lấy giá trị từ thuộc tính data-
            var maBienBanKiemKe = $(this).attr('data-maBienBanKiemKe');
            var trangThai = $(this).attr('data-trangThai');

            // Đặt giá trị vào input trong modal
            $('#UmaBienBanKiemKe').val(maBienBanKiemKe);
            $('#UtrangThai').val(trangThai);

            // Hiển thị modal
            $('#myModal').modal('show');
        });

        // Lắng nghe sự kiện click cho nút "Cập Nhật"
        $(document).on('click', '#updateUserBtn', function() {
            // Lấy dữ liệu từ các input trong modal
            var updatedMaBienBanKiemKe = $('#UmaBienBanKiemKe').val();
            var updatedtrangThai = $('#UtrangThai').val();
            if(updatedMaBienBanKiemKe)
            {
                var xhr = new XMLHttpRequest();
                var url = 'database/updateBienBanKiemKe.php';  // Thay đổi đường dẫn tới file PHP xử lý xóa trên server 
                var data = 'maBienBanKiemKe=' + encodeURIComponent(updatedMaBienBanKiemKe) +
                   '&trangThai=' + encodeURIComponent(updatedtrangThai);
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
