<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Nhận dữ liệu từ yêu cầu Ajax
        $maThanhPham = isset($_POST['maThanhPham']) ? intval($_POST['maThanhPham']) : 0; // Chuyển đổi thành số nguyên

        if ($maThanhPham > 0) {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            $sql = "UPDATE thanhpham SET trangThai='Đã xóa' WHERE maThanhPham = :maThanhPham";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maThanhPham', $maThanhPham, PDO::PARAM_INT); // Sử dụng PDO::PARAM_INT vì mã kho là số nguyên

            if ($stmt->execute()) {
                // Trả về phản hồi cho trình duyệt
                echo json_encode(array("status" => "success", "message" => "Xóa thành công!"));
            } else {
                // Trả về phản hồi với thông báo lỗi
                echo json_encode(array("status" => "error", "message" => "Không thể xóa dữ liệu."));
            }

            $stmt->closeCursor();
            $conn = null;
        } else {
            // Trả về phản hồi với thông báo lỗi
            echo json_encode(array("status" => "error", "message" => "Mã thành phẩm không hợp lệ."));
        }
    } catch (PDOException $e) {
        // Trả về phản hồi với thông báo lỗi
        echo json_encode(array("status" => "error", "message" => "Lỗi xảy ra: " . $e->getMessage()));
    }
} else {
    // Trả về phản hồi với thông báo lỗi
    echo json_encode(array("status" => "error", "message" => "Yêu cầu không hợp lệ."));
}
?>
