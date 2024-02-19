<?php
// Start the session.
session_start();
	$taikhoan = $_SESSION['taikhoan'];
	$maTaiKhoan = $taikhoan['maTaiKhoan'];
// Lấy dữ liệu từ POST
$maLoHang = isset($_POST['maLoHang']) ? $_POST['maLoHang'] : '';
$maKho = isset($_POST['maKho']) ? $_POST['maKho'] : '';
$moTaKiemKe = isset($_POST['moTaKiemKe']) ? $_POST['moTaKiemKe'] : '';
$soLuongKiemKe = isset($_POST['soLuongKiemKe']) ? doubleval($_POST['soLuongKiemKe']) : 0.0;
$trangThai = "Chờ duyệt";
$maBienBanKiemKe = 'BBKK' . substr(abs(crc32(uniqid())), 0, 5);
$ngayLap;
// Kiểm tra xem có dữ liệu đầu vào hay không
if (empty($maLoHang) || empty($moTaKiemKe) || empty($maKho) || empty($soLuongKiemKe)) {
    $response = array(
        'success' => false,
        'message' => 'Vui lòng nhập đầy đủ thông tin.'
    );
} else {
    try {
        // Sử dụng prepared statement để tránh SQL injection
        $sql = "INSERT INTO bienbankiemke(maBienBanKiemKe, maTaiKhoan, maLoHang, moTaKiemKe, maKho, soLuongKiemKe, trangThai, ngayLap)
         VALUES (:maBienBanKiemKe, :maTaiKhoan, :maLoHang, :moTaKiemKe, :maKho, :soLuongKiemKe,:trangThai, NOW())";

        include("connection.php");

        // Chuẩn bị và thực hiện truy vấn
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':maBienBanKiemKe', $maBienBanKiemKe, PDO::PARAM_STR);
        $stmt->bindParam(':maLoHang', $maLoHang, PDO::PARAM_STR);
        $stmt->bindParam(':maTaiKhoan', $maTaiKhoan, PDO::PARAM_STR);
        $stmt->bindParam(':soLuongKiemKe', $soLuongKiemKe);
        $stmt->bindParam(':maKho', $maKho, PDO::PARAM_STR); // Sử dụng PDO::PARAM_STR để đảm bảo định dạng chuỗi Unicode
        $stmt->bindParam(':trangThai', $trangThai, PDO::PARAM_STR);
        $stmt->bindParam(':moTaKiemKe', $moTaKiemKe, PDO::PARAM_STR);

        $stmt->execute();

        $response = array(
            'success' => true,
            'message' => "Biên bản có mã {$maBienBanKiemKe} - lô hàng: {$maLoHang} - {$maKho} đã được thêm thành công!"
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
header("refresh:0; url='../bienbankiemke.php'");
?>
