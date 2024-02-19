<?php
    include("connection.php");
    $stmt = $conn->prepare("SELECT * FROM taikhoan WHERE trangThai <> 'Đã xóa'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
    return $data;

?>