<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ yêu cầu Ajax
    $maLoHang = isset($_POST['maLoHang']) ? $_POST['maLoHang'] : null;
    $soLuongXuat = isset($_POST['UsoLuongXuat']) ? doubleval($_POST['UsoLuongXuat']) : 0.0;
    $maPhieuXuatKho = time();
    $maChiTietXuatLo = 'CTXL' . substr(abs(crc32(uniqid())), 0, 7);

    if ($maLoHang !== null && $soLuongXuat !== null) {
        try {
            include("connection.php");

            // Bắt đầu giao dịch
            $conn->beginTransaction();
            // Kiểm tra số lượng trước khi tạo phiếu xuất kho
            $checkSoLuongSql = "SELECT soLuongNhap FROM lohangtp WHERE maLoHang = :maLoHang";
            $stmtCheckSoLuong = $conn->prepare($checkSoLuongSql);
            $stmtCheckSoLuong->bindParam(':maLoHang', $maLoHang, PDO::PARAM_STR);
            $stmtCheckSoLuong->execute();
            $soLuongNhap = $stmtCheckSoLuong->fetchColumn();

            if ($soLuongNhap < $soLuongXuat) {
                throw new Exception("Số lượng xuất vượt quá số lượng tồn.");
            }

            // Lấy tổng số lượng đã xuất từ lô hàng
            // $tongSoLuongXuatSql = "SELECT COALESCE(SUM(soLuong), 0) AS tongSoLuongXuat 
            // FROM chitietxuatlo WHERE maLoHang = :maLoHang";
            // $stmtTongSoLuongXuat = $conn->prepare($tongSoLuongXuatSql);
            // $stmtTongSoLuongXuat->bindParam(':maLoHang', $maLoHang, PDO::PARAM_STR);
            // $stmtTongSoLuongXuat->execute();
            // $tongSoLuongXuat = $stmtTongSoLuongXuat->fetchColumn();

            // Lấy mã kho và thêm vào bảng phieuxuatkho
            $insertPhieuXuatKhoSql = "INSERT INTO phieuxuatkhotp(maPhieuXuatKho, ngayLapPhieu) 
            VALUES (:maPhieuXuatKho, NOW())";
            $stmtPhieuXuatKho = $conn->prepare($insertPhieuXuatKhoSql);
            $stmtPhieuXuatKho->bindParam(':maPhieuXuatKho', $maPhieuXuatKho, PDO::PARAM_INT);
            $stmtPhieuXuatKho->execute();

            // Thêm vào bảng chitietxuatlo
            $insertCTXuatLoSql = "INSERT INTO chitietxuatlotp(maChiTietXuatLo, maLoHang, maPHieuXuatKho, soLuong) 
                      VALUES (:maChiTietXuatLo, :maLoHang, :maPhieuXuatKho, :soLuong)";
            $stmtPhieuXuatKho = $conn->prepare($insertCTXuatLoSql);
            $stmtPhieuXuatKho->bindParam(':maChiTietXuatLo', $maChiTietXuatLo, PDO::PARAM_STR);
            $stmtPhieuXuatKho->bindParam(':maLoHang', $maLoHang, PDO::PARAM_STR);
            $stmtPhieuXuatKho->bindParam(':maPhieuXuatKho', $maPhieuXuatKho, PDO::PARAM_INT);
            $stmtPhieuXuatKho->bindParam(':soLuong', $soLuongXuat, PDO::PARAM_STR);
            $stmtPhieuXuatKho->execute();

            // Cập nhật số lượng chính (sl tồn) trong lohang
            $updateSoLuongChinhSql = "UPDATE lohangtp 
            SET soLuongChinh = soLuongNhap - (SELECT COALESCE(SUM(soLuong), 0) AS tongSoLuongXuat 
            FROM chitietxuatlotp WHERE maLoHang = :maLoHang)
            WHERE maLoHang = :maLoHang";
            $stmtUpdateSoLuongChinh = $conn->prepare($updateSoLuongChinhSql);
            $stmtUpdateSoLuongChinh->bindParam(':maLoHang', $maLoHang, PDO::PARAM_STR);
            $stmtUpdateSoLuongChinh->bindParam(':tongSoLuongXuat', $tongSoLuongXuat, PDO::PARAM_STR);
            $stmtUpdateSoLuongChinh->execute();
            //Cập nhật số lượng nvl = sum của soLuongChinh
            $updateNVL = "UPDATE thanhpham nv
            SET nv.soLuong = COALESCE((
                SELECT COALESCE(SUM(lh.soLuongChinh), 0)
                FROM lohangtp lh
                WHERE lh.maThanhPham = nv.maThanhPham
                GROUP BY lh.maThanhPham
            ), 0);";
            $stmtUpdateSoLuongNVL= $conn->prepare($updateNVL);
            $stmtUpdateSoLuongNVL->execute();
            // COMMIT giao dịch nếu không có lỗi
            $conn->commit();

            // Trả về phản hồi cho trình duyệt
            echo json_encode(array("status" => "success", "message" => "Tạo phiếu xuất kho thành công!"));

        } catch (PDOException $e) {
            // ROLLBACK giao dịch nếu có lỗi
            $conn->rollBack();

            // Trả về phản hồi với thông báo lỗi
            echo json_encode(array("status" => "error", "message" => "Lỗi xảy ra: " . $e->getMessage()));
        } catch (Exception $e) {
            // Trả về phản hồi với thông báo lỗi
            echo json_encode(array("status" => "error", "message" => $e->getMessage()));
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
