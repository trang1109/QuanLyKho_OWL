<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT maNhanVien FROM nhanvien");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($result as $code) {
        echo "<option value=\"$code\">$code</option>";
    }
?>
