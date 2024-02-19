<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    // Kiểm tra và làm sạch dữ liệu đầu vào
    $maKho = isset($_POST['maKho']) ? intval($_POST['maKho']) : 0;
    $tenKho = isset($_POST['tenKho']) ? htmlspecialchars($_POST['tenKho']) : null;
    $sucChua = isset($_POST['sucChua']) ? doubleval($_POST['sucChua']) : 0.0;
    $maNhanVien = isset($_POST['maNhanVien']) ? htmlspecialchars($_POST['maNhanVien']) : null;
    $trangThai = isset($_POST['trangThai']) ? htmlspecialchars($_POST['trangThai']) : null;
    if ($maKho !== null && $tenKho !== null && $sucChua !== null && $maNhanVien !== null) {
        try {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            $sql = "UPDATE kho SET tenKho = :tenKho, sucChua = :sucChua, maNhanVien = :maNhanVien, trangThai = :trangThai WHERE maKho = :maKho";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maKho', $maKho, PDO::PARAM_INT);
            $stmt->bindParam(':tenKho', $tenKho, PDO::PARAM_STR);
            $stmt->bindParam(':sucChua', $sucChua, PDO::PARAM_STR);
            $stmt->bindParam(':maNhanVien', $maNhanVien, PDO::PARAM_STR);
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
