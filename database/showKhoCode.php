<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT * FROM kho WHERE trangThai = 'Đang sử dụng';");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $code) {
        echo "<option value=\"{$code['maKho']}\">{$code['tenKho']}</option>";
    }
?>