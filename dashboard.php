<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$code = $taikhoan['maTaiKhoan'];
    // var_dump($taikhoans)
	//echo $name;
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=pages/index.php">
    <title>Startmin</title>
    <script language="javascript">
        window.location.href = "pages/index.php"
    </script>
</head>
<body>
<a href="pages/index.php">Go to Demo</a>
</body>
</html>
