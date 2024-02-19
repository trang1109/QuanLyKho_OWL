<?php
    // Bắt đầu session
    session_start();
    
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['taikhoan'])) {
        header('Location: index.php');
        exit(); // Đảm bảo chương trình kết thúc nếu đã chuyển hướng
    }
    
    // Lấy thông tin tài khoản từ session
    $taikhoan = $_SESSION['taikhoan'];
    $code = $taikhoan['maTaiKhoan'];

    // Kiểm tra mã tài khoản và chuyển hướng tương ứng
    if (strpos($code, 'admin') !== false) {
        include('partials/app-sidebar-admin-main.php');
    } elseif (strpos($code, 'NV') !== false) {
        include('partials/app-sidebar-nv-main.php');
    } elseif (strpos($code, 'GD') !== false) {
        include('partials/app-sidebar-gd-main.php');
    } elseif (strpos($code, 'QLK') !== false) {
        include('partials/app-sidebar-qlk-main.php');
    } elseif (strpos($code, 'SXKD') !== false) {
        include('partials/app-sidebar-kdsx-main.php');
    }

    // // Nếu không phù hợp với bất kỳ điều kiện nào, bạn có thể chuyển hướng đến trang mặc định
    // header('Location: trang-mac-dinh-main.php');
    // exit();
?>
