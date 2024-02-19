<?php
    // Kết nối đến CSDL và lấy danh sách mã lô hàng dựa trên mã kho
    include_once("connection.php"); // Thay đổi tên file và đường dẫn phù hợp với bạn

    $lohangTable = ""; // Khởi tạo biến $lohangTable

    if (isset($_GET['maLoHang'])) {
        $maLoHang = $_GET['maLoHang'];
        $stmt = $conn->prepare("SELECT lohang.maLoHang, nguyenvatlieu.tenNguyenVatLieu, lohang.soLuongNhap, lohang.donViTinh
        FROM lohang 
        INNER JOIN nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu
        WHERE lohang.maLoHang = :maLoHang");
        $stmt->bindParam(':maLoHang', $maLoHang, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Khai báo bảng và thead ở đây để tránh việc tạo nhiều bảng
            $lohangTable .= "<div class='user'>
                <table>
                    <thead>
                        <tr>
                            <th>Mã lô hàng</th>
                            <th>Tên nguyên vật liệu</th>
                            <th>Số lượng nhập</th>
                            <th>Đơn vị tính</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Nối thêm giá trị cho mỗi lần lặp
                $lohangTable .= "<tr>
                                    <td>{$row['maLoHang']}</td>
                                    <td>{$row['tenNguyenVatLieu']}</td>
                                    <td>{$row['soLuongNhap']}</td>
                                    <td>{$row['donViTinh']}</td>
                                </tr>";
            }

            // Đóng tbody và table
            $lohangTable .= "</tbody></table></div>";
        } else {
            $lohangTable = "Kho rỗng";
        }
    } else {
        $lohangTable = "Không có mã kho được cung cấp.";
    }

    // In ra giá trị của $lohangTable
    echo $lohangTable;
?>
