<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    // Kiểm tra và làm sạch dữ liệu đầu vào
    $maNguyenVatLieu = isset($_POST['maNguyenVatLieu']) ? intval($_POST['maNguyenVatLieu']) : 0;
    $tenNguyenVatLieu = isset($_POST['tenNguyenVatLieu']) ? htmlspecialchars($_POST['tenNguyenVatLieu']) : null;
    $soLuong = isset($_POST['soLuong']) ? doubleval($_POST['soLuong']) : 0.0;
    $donViTinh = isset($_POST['donViTinh']) ? htmlspecialchars($_POST['donViTinh']) : null;
    $trangThai = isset($_POST['trangThai']) ? htmlspecialchars($_POST['trangThai']) : null;
    if ($maNguyenVatLieu !== null && $tenNguyenVatLieu !== null && $soLuong !== null && $donViTinh !== null) {
        try {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            $sql = "UPDATE nguyenVatLieu SET tenNguyenVatLieu = :tenNguyenVatLieu, soLuong = :soLuong, donViTinh = :donViTinh, trangThai = :trangThai WHERE maNguyenVatLieu = :maNguyenVatLieu";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maNguyenVatLieu', $maNguyenVatLieu, PDO::PARAM_INT);
            $stmt->bindParam(':tenNguyenVatLieu', $tenNguyenVatLieu, PDO::PARAM_STR);
            $stmt->bindParam(':soLuong', $soLuong, PDO::PARAM_STR);
            $stmt->bindParam(':donViTinh', $donViTinh, PDO::PARAM_STR);
            $stmt->bindParam(':trangThai', $trangThai, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Trả về phản hồi cho trình duyệt
                echo json_encode(array("status" => "success", "message" => "Cập nhật thành công!"));
            } else {
                // Trả về phản hồi với thông báo lỗi
                echo json_encode(array("status" => "error", "message" => "Không thể cập nhật dữ liệu."));
            }

            $stmt->closeCursor();
            $conn = null;
        } catch (PDOException $e) {
            // Trả về phản hồi với thông báo lỗi
            echo json_encode(array("status" => "error", "message" => "Lỗi xảy ra: " . $e->getMessage()));
        }
    } else {
        // Trả về phản hồi với thông báo lỗi
        echo json_encode(array("status" => "error", "message" => "Dữ liệu không hợp lệ."));
    }
} else {
    // Trả về phản hồi với thông báo lỗi
    echo json_encode(array("status" => "error", "message" => "Yêu cầu không hợp lệ."));
}
?>
