<?php
// searchProduct.php
require_once('./connection.php');

if (isset($_POST['searchHSD1']) && isset($_POST['searchHSD2'])) {
    $searchHSD1 = $_POST['searchHSD1'];
    $searchHSD2 = $_POST['searchHSD2'];
    $stmt = $conn->prepare("SELECT *
    FROM lohangtp INNER JOIN thanhpham ON lohangtp.maThanhPham = thanhPham.maThanhPham
    WHERE hanSuDung >= :searchHSD1 AND hanSuDung <= :searchHSD2;
    ");
    $stmt->bindValue(':searchHSD1',$searchHSD1 , PDO::PARAM_STR);
    $stmt->bindValue(':searchHSD2',$searchHSD2 , PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<table border="1" class="user">';
        echo '<thead>';
        echo '<tr>
                <th>Mã lô hàng</th>
                <th>Tên thành phẩm</th>
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
            echo '<td>' . $row['tenThanhPham'] . '</td>';
            echo '<td>' . $row['soLuongChinh'] . '</td>';
            // Add other columns as needed
            echo '<td>' . $row['donViTinh'] . '</td>';
            echo '<td>' . $row['ngaySanXuat'] . '</td>';
            echo '<td>' . $row['hanSuDung'] . '</td>';            
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<h3>           No results found</h3>';
    }
}
?>