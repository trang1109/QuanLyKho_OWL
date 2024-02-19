<?php
    // Kết nối đến CSDL và lấy danh sách mã lô hàng dựa trên mã kho
    include_once("connection.php"); // Thay đổi tên file và đường dẫn phù hợp với bạn

    $lohangTable = ""; // Khởi tạo biến $lohangTable

    if (isset($_GET['maKho'])) {
        $maKho = $_GET['maKho'];
        $stmt = $conn->prepare("SELECT lohang.maLoHang FROM lohang WHERE lohang.maKho = :maKho");
        $stmt->bindParam(':maKho', $maKho, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                $lohangTable .= "<option value='{$row['maLoHang']}'>{$row['maLoHang']}</option>";
            }
        } else {
            $lohangTable = "Kho rỗng";
        }
    } else {
        $lohangTable = "Không có mã kho được cung cấp.";
    }

    // In ra giá trị của $lohangTable
    echo $lohangTable;
?>
