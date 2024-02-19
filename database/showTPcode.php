<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT * FROM thanhpham");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $code) {
        echo "<option value=\"{$code['maThanhPham']}\">{$code['tenThanhPham']}</option>";
    }
?>
