<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Nhận dữ liệu từ yêu cầu Ajax
        $maKho = isset($_POST['maKho']) ? intval($_POST['maKho']) : 0; // Chuyển đổi thành số nguyên

        if ($maKho > 0) {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            $sql = "UPDATE KHO SET trangThai='Đã xóa' WHERE maKho = :maKho";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maKho', $maKho, PDO::PARAM_INT); // Sử dụng PDO::PARAM_INT vì mã kho là số nguyên

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
            echo json_encode(array("status" => "error", "message" => "Mã Kho không hợp lệ."));
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
