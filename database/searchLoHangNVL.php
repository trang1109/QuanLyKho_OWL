<?php
// searchProduct.php
require_once('./connection.php');

if (isset($_POST['searchValue1']) && isset($_POST['searchValue2'])) {
    $searchValue1 = $_POST['searchValue1'];
    $searchValue2 = $_POST['searchValue2'];
    $stmt = $conn->prepare("SELECT *
    FROM lohang INNER JOIN nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu
    WHERE hanSuDung >= :searchValue1 AND hanSuDung <= :searchValue2;
    ");
    $stmt->bindValue(':searchValue1',$searchValue1 , PDO::PARAM_STR);
    $stmt->bindValue(':searchValue2',$searchValue2 , PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<table border="1" class="user">';
        echo '<thead>';
        echo '<tr>
                <th>Mã lô hàng</th>
                <th>Tên nguyên vật liệu</th>
                <th>Số lượng tồn</th>
                <th>Đơn vị tính</th>
                <th>Ngày sản xuất</th>
                <th>Hạn sử dụng</th>
            </tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['maLoHang'] . '</td>';
            echo '<td>' . $row['tenNguyenVatLieu'] . '</td>';
            echo '<td>' . $row['soLuongChinh'] . '</td>';
            // Add other columns as needed
            echo '<td>' . $row['donViTinh'] . '</td>';
            echo '<td>' . $row['ngaySanXuat'] . '</td>';
            echo '<td>' . $row['hanSuDung'] . '</td>';            
            echo '</tr>';
        }
        echo '<tbody>';
        echo '</table>';
    } else {
        echo '<h3>             No results found</h3>';
    }
}
?>