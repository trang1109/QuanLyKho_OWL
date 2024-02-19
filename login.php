<?php
	//bắt đầu session
	session_start();
	if(isset($_SESSION['taikhoan']))
	{
		header('Location: dashboard.php');
	}
	$error_message ='';
	if($_POST)
	{
		include('database/connection.php');
		// Lấy giá trị từ POST
		$maTaiKhoan = $_POST['maTK'];
		$matKhau = $_POST['matKhau'];
		
		// Chuẩn bị truy vấn với prepared statement
		$query = "SELECT * FROM taikhoan WHERE maTaiKhoan = :maTaiKhoan AND matKhau = :matKhau";
		$stmt = $conn->prepare($query);
		
		
		// Bind giá trị vào các placeholder
		$stmt->bindParam(':maTaiKhoan', $maTaiKhoan, PDO::PARAM_STR);
		$stmt->bindParam(':matKhau', $matKhau, PDO::PARAM_STR);
		
		// Thực thi truy vấn
		$stmt->execute();
		// Lấy số dòng kết quả
		$numRows = $stmt->rowCount();
		if ($numRows > 0) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();
		
			if (!empty($result)) {
				$taikhoan = $result[0];
				$_SESSION['taikhoan'] = $taikhoan;
				header("Location: dashboard.php");
				exit; // Dừng thực thi kịch bản sau khi chuyển hướng
			} else {
				// Xử lý trường hợp không có hàng nào được trả về
				$error_message = "Không tìm thấy hàng nào!";
			}
		} else {
			$error_message = "Sai mã tài khoản hoặc mật khẩu!";
			// Bạn có thể xử lý hoặc hiển thị thông báo lỗi phù hợp ở đây
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>OWL Login - Inventory Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" href="image/logo/icons8-the-flash-sign-100.png" type="image/x-icon" />
    <meta charset="utf-8">
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
<body id="loginBody">
	<?php if($error_message){?>
        <div class="errorMessage">
            <p>Error : <?php echo $error_message;?> </p>
        </div>
    <?php }?>
	<div class="container">
		<div class="loginHeader">
			<h1>OWL</h1>
			<p>Inventory Management System</p>
		</div>
		<div class="loginBody">
			<form action="login.php" method="post">
				<div class="loginInputsContainer">
					<label for="">Mã đăng nhập </label>
					<input placeholder="mã đăng nhập" name="maTK" type="text" />
				</div>
				<div class="loginInputsContainer">
					<label for="">Mật khẩu</label>
					<input placeholder="mật khẩu" name="matKhau" type="password" />
				</div>
				
				<div class="loginButtonContainer">
					<button>Đăng nhập</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>