<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

   <!-- Thư viện Bootstrap -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Thư viện Bootstrap Dialog -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.min.js"></script>

    <!-- Các tệp CSS và JavaScript khác của bạn -->
    <!-- ... -->
</head>
<body>

<button id="showDialogBtn" class="btn btn-primary">Hiển Thị Hộp Thoại</button>
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
                <!-- Thêm các trường để nhập thông tin mới -->
                <div class="form-group">
                    <label for="maTaiKhoan">Mã Tài Khoản:</label>
                    <input type="text" class="form-control" id="maTaiKhoan" placeholder="Nhập mã tài khoản">
                </div>
                <div class="form-group">
                    <label for="matKhau">Mật Khẩu:</label>
                    <input type="password" class="form-control" id="matKhau" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="tenTaiKhoan">Tên Tài Khoản:</label>
                    <input type="text" class="form-control" id="tenTaiKhoan" placeholder="Nhập tên tài khoản">
                </div>
            </div>
            <div class="modal-footer">
                <!-- Thêm nút cập nhật -->
                <button type="button" class="btn btn-primary" onclick="updateAccount()">Cập Nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#showDialogBtn').on('click', function() {
            $('#myModal').modal('show');
           
        });
    });
</script>


</body>
</html>
