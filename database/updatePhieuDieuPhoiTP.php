<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    $maLoHang = isset($_POST['maLoHang']) ? $_POST['maLoHang'] : null;
    $maKho = isset($_POST['maKho']) ? $_POST['maKho'] : null;
    $maPhieuDieuPhoi = time();
   if ($maLoHang !== null && $maKho !== null) {
        try {
            include("connection.php");

            // Bắt đầu giao dịch
            $conn->beginTransaction();

            // Cập nhật thông tin trong bảng lohang
            $updateLohangSql = "UPDATE lohangtp SET maKho = :maKho, ngayCapNhat=NOW() WHERE maLoHang = :maLoHang";
            $stmtLohang = $conn->prepare($updateLohangSql);
            $stmtLohang->bindParam(':maLoHang', $maLoHang, PDO::PARAM_INT);
            $stmtLohang->bindParam(':maKho', $maKho, PDO::PARAM_STR);
            $stmtLohang->execute();

            // Lấy mã kho và thêm vào bảng phieudieuphoi
            $maPhieuDieuPhoi = time();
            $insertPhieuDieuPhoiSql = "INSERT INTO phieudieuphoitp(maPhieuDieuPhoi, ngayLapPhieu, maLoHang, maKho) VALUES (:maPhieuDieuPhoi, NOW(), :maLoHang, :maKho)";
            $stmtPhieuDieuPhoi = $conn->prepare($insertPhieuDieuPhoiSql);
            $stmtPhieuDieuPhoi->bindParam(':maPhieuDieuPhoi', $maPhieuDieuPhoi, PDO::PARAM_INT);
            $stmtPhieuDieuPhoi->bindParam(':maLoHang', $maLoHang, PDO::PARAM_INT);
            $stmtPhieuDieuPhoi->bindParam(':maKho', $maKho, PDO::PARAM_STR);
            $stmtPhieuDieuPhoi->execute();

            // COMMIT giao dịch nếu không có lỗi
            $conn->commit();

            // Trả về phản hồi cho trình duyệt
            echo json_encode(array("status" => "success", "message" => "Điều phối thành công!"));

        } catch (PDOException $e) {
            // ROLLBACK giao dịch nếu có lỗi
            // $conn->rollBack();

            // Trả về phản hồi với thông báo lỗi
            // echo json_encode(array("status" => "error", "message" => "Lỗi xảy ra: " . $e->getMessage()));
            echo json_encode(array("status" => "success", "message" => "Vui lòng chọn kho để điều phối ! Thoát: Ấn nút đóng."));
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
