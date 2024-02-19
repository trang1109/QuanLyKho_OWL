<?php
	// Bắt đầu hoặc khôi phục session
	session_start();
	
	session_unset();
	
	// Hủy bỏ phiên làm việc
	session_destroy();
	
	// Chuyển hướng đến trang đăng nhập hoặc trang chính
	header("refresh:0; url='index.php'");
	exit;
?>