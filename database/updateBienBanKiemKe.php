<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    $maBienBanKiemKe = isset($_POST['maBienBanKiemKe']) ? $_POST['maBienBanKiemKe'] : null;
    $trangThai = isset($_POST['trangThai']) ? $_POST['trangThai'] : null;
    if ($maBienBanKiemKe !== null && $trangThai !== null) {
        try {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            $sql = "UPDATE bienbankiemke SET trangThai = :trangThai WHERE maBienBanKiemKe = :maBienBanKiemKe";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maBienBanKiemKe', $maBienBanKiemKe, PDO::PARAM_INT);
            $stmt->bindParam(':trangThai', $trangThai, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Trả về phản hồi cho trình duyệt
                echo json_encode(array("status" => "success", 
                "message" => "Xử lý biên bản: {$maBienBanKiemKe} - Trạng thái: {$trangThai} thành công!"));
            } else {
                // Trả về phản hồi với thông báo lỗi
                echo json_encode(array("status" => "error", "message" => "Không thể xử lý biên bản kiểm kê."));
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
