<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT *FROM nguyenvatlieu WHERE trangThai <> 'Đã xóa'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
    return $data;

?>