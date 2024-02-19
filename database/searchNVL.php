<?php
// searchProduct.php
require_once('./connection.php');

if (isset($_POST['searchValue'])) {
    $searchValue = $_POST['searchValue'];

    $stmt = $conn->prepare("SELECT * FROM nguyenvatlieu WHERE tenNguyenVatLieu LIKE :searchValue AND trangThai <> 'Đã xóa'");
    $stmt->bindValue(':searchValue', '%' . $searchValue . '%', PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<table border="1" class="user">';
        echo '<tr><th>Mã Nguyên Vật Liệu</th><th>Tên Nguyên Vật Liệu</th><th>Số Lượng</th><th>Đơn vị tính</th><th>Trạng thái</th></tr>';
        
        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['maNguyenVatLieu'] . '</td>';
            echo '<td>' . $row['tenNguyenVatLieu'] . '</td>';
            // Add other columns as needed
            echo '<td>' . $row['soLuong'] . '</td>';
            echo '<td>' . $row['donViTinh'] . '</td>';
            echo '<td>' . $row['trangThai'] . '</td>';            
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No results found';
    }
}
?>