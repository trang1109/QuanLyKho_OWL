<?php
session_start();

try {
    // Assign values to variables
    $tenNguyenVatLieu = isset($_POST['tenNguyenVatLieu']) ? $_POST['tenNguyenVatLieu'] : ''; // Ensure $tenNguyenVatLieu is not null or empty
    $soLuong = isset($_POST['soLuong']) ? doubleval($_POST['soLuong']) : 0.0;
    $donViTinh = isset($_POST['donViTinh']) ? $_POST['donViTinh'] : '';
    $trangThai = "Đang sử dụng";
    $soLuong = 0;

    // Check if $tenNguyenVatLieu is not null or empty
    if (empty($tenNguyenVatLieu)) {
        throw new Exception("Tên NVL không được để trống.");
    }

    // Sử dụng prepared statement để tránh SQL injection
    $sql = "INSERT INTO nguyenvatlieu(tenNguyenVatLieu, soLuong, donViTinh, trangThai) VALUES (:tenNguyenVatLieu, :soLuong, :donViTinh, :trangThai)";

    include("connection.php");

    // Chuẩn bị và thực hiện truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tenNguyenVatLieu', $tenNguyenVatLieu, PDO::PARAM_STR);
    $stmt->bindParam(':soLuong', $soLuong);
    $stmt->bindParam(':donViTinh', $donViTinh, PDO::PARAM_STR);
    $stmt->bindParam(':trangThai', $trangThai, PDO::PARAM_STR);

    $stmt->execute();

    $response = array(
        'success' => true,
        'message' => "Nguyên vật liệu đã được thêm thành công!"
    );
} catch (Exception $e) {
    $response = array(
        'success' => false,
        'message' => $e->getMessage()
    );
}

// Lưu thông báo vào session và chuyển hướng trang
$_SESSION['response'] = $response;
header("refresh:0; url='../nvl-add.php'");
?>
