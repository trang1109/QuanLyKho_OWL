<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    $khos = include('database/showKho.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css ">
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
                    <h1>Danh sách Kho</h1>
            </div>
            <div class="dashboard_content">
                <div class="row-add">
                    <div class="column-add column-5">
                        <div class="dashboard_content_main">
                        <div id="userAddFormContainer">
                        <h2>Tất cả kho</h2>
                        <div class="user">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Kho</th>
                                        <th>Tên kho</th>
                                        <th>Sức chứa</th>
                                        <th>Mã nhân viên</th>
                                        <th>Trạng thái</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($khos as $index => $kho) { ?>
                                        <tr>
                                            
                                            <td><?php echo $kho['maKho'] ?></td>
                                            <td><?php echo $kho['tenKho'] ?></td>
                                            <td><?php echo $kho['sucChua'] ?></td>
                                            <td><?php echo $kho['maNhanVien'] ?></td>
                                            <td><?php echo $kho['trangThai'] ?></td>
                                        </tr>
                                    <?php } ?>                   
                                </tbody>
                            </table>
                            <p class="userCount"><?php echo count($khos) ?> Kho</p>
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
