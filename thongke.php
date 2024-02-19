<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    $tps = include('database/showNVL.php');
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
    <script src="js/jquery-3.6.1.min.js"></script>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php include('partials/if-main.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php')?>
            <div class="title">
                    <h1>THỐNG KÊ HÀNG HÓA</h1>
            </div>
            <div class="dashboard_content">
                <h1>Thống kê nguyên vật liệu</h1>
            <!-- <input type="text" id="searchInput" placeholder="Nhập nguyên vật liệu">
            <button style="border: 0px 2px solid " onclick="searchProduct()"><i class="fa fa-search"></i> Search</button>
            <div id="searchResults"></div> -->
            <form action="" method="post" class="p-3">
                    <div class="input-group">
                        <!-- <input type="text" id="searchInput" placeholder="Nhập nguyên vật liệu" class="form-control form-control-lg rounded-0 border-info" autocomplete="off" required> -->
                        <div class="input-group-append">
                            <input onclick="searchProductNVLtop10()" value="Top 10 số lượng NVL" class="btn btn-info btn-lg rounded-0" >
                        </div>
                    </div>
                    <br>
                    <div id="searchResults"></div>
                    <h2>Lọc lô hàng nguyên vật liệu theo hạn sử dụng</h2>
                    <div class="input-group">
                        <div class="form-group" style="font-size: 18px;">
                            <label for="soLuongNhap">Ngày bắt đầu:</label>
                            <input type="date" id="searchInputDate1" placeholder="Nhập nguyên vật liệu" 
                            class=" form-control form-control-lg rounded-0 border-info" autocomplete="off" required>
                        
                        </div>
                        <div class="form-group "style="font-size: 18px;">
                            <label for="soLuongNhap">Ngày kết thúc:</label>
                            <input type="date" id="searchInputDate2" placeholder="Nhập nguyên vật liệu" 
                            class=" form-control form-control-lg rounded-0 border-info" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                             <!--  -->
                             
                        </div>
                            
                        <div class="input-group-append">
                            <input onclick="searchProductHSDNVL()" value="Xác nhận" class="btn btn-info btn-lg rounded-0" >
                        </div>
                    </div>
                    <br>
                    <div id="searchResultsDate1"></div>
            </form>
            </div>
            <!--  -->
            <div class="dashboard_content">
                <h1>Thống kê nguyên thành phẩm</h1>
            <!-- <input type="text" id="searchInput" placeholder="Nhập nguyên vật liệu">
            <button style="border: 0px 2px solid " onclick="searchProduct()"><i class="fa fa-search"></i> Search</button>
            <div id="searchResults"></div> -->
            
            <form action="" method="post">
                    <div class="input-group">
                        <!-- <input type="text" id="searchInput" placeholder="Nhập nguyên vật liệu" class="form-control form-control-lg rounded-0 border-info" autocomplete="off" required> -->
                        <div class="input-group-append">
                            <input onclick="searchProductTPtop10()" value="Top 10 số lượng TP" class="btn btn-info btn-lg rounded-0" >
                        </div>
                    </div>
                    <br>
                    <div id="searchResultsTP"></div>
                    <h2>Lọc lô hàng thành phẩm theo hạn sử dụng</h2>
                    <div class="input-group">
                        <div class="form-group" style="font-size: 18px;">
                            <label for="soLuongNhap">Ngày bắt đầu:</label>
                            <input type="date" id="searchInputHSD1" placeholder="Nhập nguyên vật liệu" 
                            class=" form-control form-control-lg rounded-0 border-info" autocomplete="off" required>
                        
                        </div>
                        <div class="form-group "style="font-size: 18px;">
                            <label for="soLuongNhap">Ngày kết thúc:</label>
                            <input type="date" id="searchInputHSD2" placeholder="Nhập nguyên vật liệu" 
                            class=" form-control form-control-lg rounded-0 border-info" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                             <!--  -->
                             
                        </div>
                            
                        <div class="input-group-append">
                            <input onclick="searchProductHSDTP()" value="Xác nhận" class="btn btn-info btn-lg rounded-0" >
                        </div>
                    </div>
                    <br>
                    <div id="searchResultsDate2"></div>
            </form>
            </div>
        </div>
            
    </div>
<script src="js/script.js"></script>
<script>
        function searchProductNVLtop10() {
            var searchValue = $("#searchInput").val();

            $.ajax({
                type: "POST",
                url: "database/searchNVLTop10.php",
                data: { searchValue: searchValue },
                success: function (response) {
                    $("#searchResults").html(response);
                }
            });
        }
        function searchProductTPtop10() {
            var searchValue = $("#searchInput").val();

            $.ajax({
                type: "POST",
                url: "database/searchProductTop10.php",
                data: { searchValue: searchValue },
                success: function (response) {
                    $("#searchResultsTP").html(response);
                }
            });
        }
        function searchProductHSDNVL() {
            var searchValue1 = $("#searchInputDate1").val();
            var searchValue2 = $("#searchInputDate2").val();
            $.ajax({
                type: "POST",
                url: "database/searchLoHangNVL.php",
                data: { searchValue1: searchValue1, searchValue2: searchValue2 },
                success: function (response) {
                    $("#searchResultsDate1").html(response);
                }
            });
        }
        function searchProductHSDTP() {
            var searchHSD1 = $("#searchInputHSD1").val();
            var searchHSD2 = $("#searchInputHSD2").val();
            $.ajax({
                type: "POST",
                url: "database/searchLoHangTP.php",
                data: { searchHSD1: searchHSD1, searchHSD2: searchHSD2 },
                success: function (response) {
                    $("#searchResultsDate2").html(response);
                }
            });
        }
</script>
</body>
</html>
