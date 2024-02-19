<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include("connection.php");

        // Tạo mã phiếu một lần
        $maPhieuNhapKho = time();
       
        // Bắt đầu giao dịch
        $conn->beginTransaction();

        // Kiểm tra xem mã phiếu đã tồn tại trong bảng phieunhapkho chưa
        $checkPhieuExistence = $conn->prepare("SELECT COUNT(*) FROM phieunhapkhotp WHERE maPhieuNhapKho = :maPhieuNhapKho");
        $checkPhieuExistence->bindParam(':maPhieuNhapKho', $maPhieuNhapKho, PDO::PARAM_INT);
        $checkPhieuExistence->execute();
        $phieuCount = $checkPhieuExistence->fetchColumn();

        if ($phieuCount == 0) {
            // Nếu mã phiếu chưa tồn tại, thêm mới vào bảng phieunhapkho
            $insertPhieu = $conn->prepare("INSERT INTO phieunhapkhotp(maPhieuNhapKho, ngayLapPhieu) VALUES(:maPhieuNhapKho, NOW())");
            $insertPhieu->bindParam(':maPhieuNhapKho', $maPhieuNhapKho, PDO::PARAM_INT);
            $insertPhieu->execute();
        }

        // Cập nhật Bảng lohang
        $insertLohang = $conn->prepare("INSERT INTO lohangtp(maLoHang, maThanhPham, soLuongNhap, soLuongChinh, donViTinh, ngaySanXuat, hanSuDung, maPhieuNhapKho, ngayLap) 
        VALUES (:maLoHang, :maThanhPham, :soLuongNhap, :soLuongChinh,  :donViTinh, :ngaySanXuat, :hanSuDung, :maPhieuNhapKho, NOW())");
        // cập nhật só lượng nguyên vật liệu
        $updateNVL = $conn->prepare("UPDATE thanhpham nv
        SET nv.soLuong = nv.soLuong + (
            SELECT COALESCE(SUM(lh.soLuongNhap), 0)
            FROM lohangtp lh
            WHERE lh.maThanhPham = :maThanhPham
            GROUP BY lh.maThanhPham)
        WHERE nv.maThanhPham = :maThanhPham;
        
        ");

        // Process each product data
        foreach ($_POST['tenThanhPham'] as $key => $value) {
            $maThanhPham = $value;
            $soLuongNhap = $_POST['soLuongNhap'][$key];
            $donViTinh = $_POST['donViTinh'][$key];
            $ngaySanXuat = $_POST['ngaySanXuat'][$key];
            $hanSuDung = $_POST['hanSuDung'][$key];
            $maLoHang = 'LH' . substr(abs(crc32(uniqid())), 0, 7);

        // Kiểm tra điều kiện ngày sản xuất và hạn sử dụng
        $ngayLapPhieu = date('Y-m-d'); // Ngày lập phiếu

        if (strtotime($ngaySanXuat) <= strtotime($ngayLapPhieu) && strtotime($hanSuDung) > strtotime($ngaySanXuat)) {
        // Cập nhật Bảng lohang với mã phiếu đã tạo
            $insertLohang->bindParam(':maLoHang', $maLoHang);
            $insertLohang->bindParam(':maThanhPham', $maThanhPham);
            $insertLohang->bindParam(':soLuongNhap', $soLuongNhap);
            $insertLohang->bindParam(':soLuongChinh', $soLuongNhap);
            $insertLohang->bindParam(':donViTinh', $donViTinh, PDO::PARAM_STR);
            $insertLohang->bindParam(':ngaySanXuat', $ngaySanXuat, PDO::PARAM_STR);
            $insertLohang->bindParam(':hanSuDung', $hanSuDung, PDO::PARAM_STR);
            $insertLohang->bindParam(':maPhieuNhapKho', $maPhieuNhapKho, PDO::PARAM_INT);
            $insertLohang->execute();
        // Đặt giá trị soLuong về 0 trước khi cộng thêm từ lohang
        $resetSoLuong = $conn->prepare("UPDATE thanhpham SET soLuong = 0 WHERE maThanhPham = :maThanhPham");
        $resetSoLuong->bindParam(':maThanhPham', $maThanhPham, PDO::PARAM_INT);
        $resetSoLuong->execute();

        // Thực hiện cập nhật soLuong
        $updateNVL->bindParam(':maThanhPham', $maThanhPham, PDO::PARAM_INT);
        $updateNVL->execute();
        } else {
            $errors[] = "Lô hàng không đáp ứng điều kiện: hạn sử dụng phải sau ngày sản xuất";
        }
        }
        // COMMIT giao dịch
        $conn->commit();

        // Sau khi xử lý tất cả sản phẩm, kiểm tra có lỗi không và cập nhật $response
        if (!empty($errors)) {
            $response = array(
                'success' => false,
                'message' => implode("<br>", $errors)
            );
        } else {
            // Nếu không có lỗi, cập nhật $response cho thành công
            $response = array(
                'success' => true,
                'message' => "Phiếu nhập kho: {$maPhieuNhapKho} đã được tạo thành công!"
            );
        }
    } catch (PDOException $e) {
        // ROLLBACK giao dịch nếu có lỗi
        $conn->rollBack();

        $response = array(
            'success' => false,
            'message' => $e->getMessage()
        );
    }

    // Lưu thông báo vào session và chuyển hướng trang
    $_SESSION['response'] = $response;
    header("refresh:0; url='../phieunhapkho-tp.php'");
}
?>
