<?php
// Start the session.
session_start();

// Lấy dữ liệu từ POST
$maTaiKhoan = isset($_POST['maTaiKhoan']) ? $_POST['maTaiKhoan'] : '';
$matKhau = isset($_POST['matKhau']) ? $_POST['matKhau'] : '';
$tenTaiKhoan = isset($_POST['tenTaiKhoan']) ? $_POST['tenTaiKhoan'] : '';
$trangThai = 'Đang hoạt động';

// Kiểm tra xem có dữ liệu đầu vào hay không
if (empty($maTaiKhoan) || empty($matKhau) || empty($tenTaiKhoan)) {
    $response = array(
        'success' => false,
        'message' => 'Vui lòng nhập đầy đủ thông tin.'
    );
} else {
    try {
        // Sử dụng prepared statement để tránh SQL injection
        $sql = "INSERT INTO taikhoan(maTaiKhoan, matKhau, tenTaiKhoan, trangThai) VALUES (:maTaiKhoan, :matKhau, :tenTaiKhoan, :trangThai)";

        include("connection.php");

        // Chuẩn bị và thực hiện truy vấn
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':maTaiKhoan', $maTaiKhoan);
        $stmt->bindParam(':matKhau', $matKhau);
        $stmt->bindParam(':tenTaiKhoan', $tenTaiKhoan, PDO::PARAM_STR); // Sử dụng PDO::PARAM_STR để đảm bảo định dạng chuỗi Unicode
        $stmt->bindParam(':trangThai', $trangThai, PDO::PARAM_STR);

        $stmt->execute();

        $response = array(
            'success' => true,
            'message' => "{$maTaiKhoan} - {$tenTaiKhoan} đã được thêm thành công!"
        );
    } catch (PDOException $e) {
        $response = array(
            'success' => false,
            'message' => $e->getMessage()
        );
    }
}

// Lưu thông báo vào session và chuyển hướng trang
$_SESSION['response'] = $response;
header("refresh:0; url='../user-add.php'");
?>
