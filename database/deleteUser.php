<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    $maTaiKhoan = isset($_POST['maTaiKhoan']) ? $_POST['maTaiKhoan'] : null;

    if ($maTaiKhoan !== null) {
        try {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            // $sql = "DELETE FROM taikhoan WHERE maTaiKhoan= :maTaiKhoan";
            $sql = "UPDATE taikhoan SET trangThai = 'Đã xóa' WHERE maTaiKhoan = :maTaiKhoan";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maTaiKhoan', $maTaiKhoan, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Trả về phản hồi cho trình duyệt
                echo json_encode(array("status" => "success", "message" => "Xóa thành công!"));
            } else {
                // Trả về phản hồi với thông báo lỗi
                echo json_encode(array("status" => "error", "message" => "Không thể xóa dữ liệu."));
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
