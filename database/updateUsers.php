<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    $maTaiKhoan = isset($_POST['maTaiKhoan']) ? $_POST['maTaiKhoan'] : null;
    $matKhau = isset($_POST['matKhau']) ? $_POST['matKhau'] : null;
    $tenTaiKhoan = isset($_POST['tenTaiKhoan']) ? $_POST['tenTaiKhoan'] : null;
    $trangThai = isset($_POST['trangThai']) ? $_POST['trangThai'] : null;
    if ($maTaiKhoan !== null && $matKhau !== null && $tenTaiKhoan !== null && $trangThai !== null) {
        try {
            include("connection.php");

            // Sử dụng prepare statement để tránh SQL injection
            $sql = "UPDATE taikhoan SET matKhau = :matKhau, tenTaiKhoan = :tenTaiKhoan, trangThai = :trangThai WHERE maTaiKhoan = :maTaiKhoan";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':maTaiKhoan', $maTaiKhoan, PDO::PARAM_INT);
            $stmt->bindParam(':matKhau', $matKhau, PDO::PARAM_STR);
            $stmt->bindParam(':tenTaiKhoan', $tenTaiKhoan, PDO::PARAM_STR);
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
