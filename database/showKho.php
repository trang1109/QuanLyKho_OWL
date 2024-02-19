<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT *FROM kho WHERE trangThai <> 'Đã xóa'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
    return $data;

?>