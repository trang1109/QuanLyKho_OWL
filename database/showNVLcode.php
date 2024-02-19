<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT * FROM nguyenvatlieu");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $code) {
        echo "<option value=\"{$code['maNguyenVatLieu']}\">{$code['tenNguyenVatLieu']}</option>";
    }
?>
