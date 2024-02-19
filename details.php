<?php
  
  session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    $product = include('database/searchProduct.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php')?>
            <div class="dashboard_content">
                <h1>Search Products</h1>
                <form action="details.php" method="post" class="p-3">
                    <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control form-control-lg rounded-0 border-info" placeholder="Search..." autocomplete="off" required>
                    <div class="input-group-append">
                        <input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0">
                    </div>
                </div>
            </form>
                <div class="row-add">
                    <div class="column-add column-5">
                        <div class="dashboard_content_main">
                        <div id="userAddFormContainer">
                        <?php
                                if ($row) {
                                    foreach ($row as $row) {
                                      echo "<table border='1'>";
                                              echo "<tr><th>Mã Thành Phẩm</th><th>Tên Thành Phẩm</th><th>Số Lượng</th><th>Đơn Vị Tính</th><th>Hình Ảnh</th><th>Trạng Thái</th></tr>";
                                                 // foreach($result as $row) {
                                                      echo '<tr>';
                                                      echo  '<td>' . $row['maThanhPham'] .'</td>';
                                                      echo  '<td>' . $row['tenThanhPham'] . '</td>';
                                                      echo  '<td>' . $row['soLuong'] .'</td>';
                                                      echo  '<td>' . $row['donViTinh'] . '</td>';
                                                      echo  '<td>' . '<img src="images/product/'.$row['hinhAnh'].'" height=100px width = 150px>' . '</td>';
                                                      echo  '<td>' . $row['trangThai'] . '</td>';
                                                                          echo  '</tr>';
                                              }
                                              echo "</table>";
                                  }
                                  else {
                                    echo '<p class="list-group-item border-1">No Record</p>';
                                  }
                            ?>
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
