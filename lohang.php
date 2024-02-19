<?php
    include_once("database/input_lohang.php");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css "> -->
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
            <div class="dashboard_content">
                <div class="row-add">
                    <div class="column-add column-5">
                    <div class="dashboard_content_main">
                    <h1>Mã phiếu nhập kho : <?php echo $maPhieuNhapKho;?></h1>
                        <div id="userAddFormContainer">
                            
                            <form action="<?php echo $_SERVER['PHP_SELF'] . "?maPhieuNhapKho=$maPhieuNhapKho"; ?>" method="post" class="appForm">
                                <div class=appCoverInput>
                                    <label for="maNguyenVatLieu">Mã Nguyên Vật Liệu:</label>
                                    <select class="appFormInput" name="maNguyenVatLieu" id="maNguyenVatLieu">
                                        <?php include_once('database/showNVLcode.php')?>
                                    </select>
                                </div>
                                
                                <div class=appCoverInput>
                                    <label for="maNguyenVatLieu">Ngày sản xuất:</label>
                                    <input type="date" name="ngaySanXuat" class="appFormInput">
                                </div>
                                <div class=appCoverInput>
                                    <label for="maNguyenVatLieu">Hạn sử dụng:</label>
                                    <input type="date" name="hanSuDung" class="appFormInput">
                                </div>
                                <div class=appCoverInput>
                                    <label for="soLuong">Số Lượng:</label>
                                    <input type="number" name="soLuong" class="appFormInput" required>
                                </div>
                                <div class=appCoverInput>
                                    <label for="donViTinh">Đơn Vị Tính:</label>
                                    <input type="text" name="donViTinh" class="appFormInput" required>
                                </div>
                                <button class="appBtn" type="submit"><i class="fa fa-plus"> Xác nhận</i></button>
                                <button class="appBtnReset" type="reset"><i class="fa fa-refresh"> Đặt lại</i></button>
                            </form>
                           
                        </div>

                   
                        </div>

                   
                        </div>
                    </div>
                    <div class="column-add column-7">
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<script src="js/script.js"></script>
</body>
</html>