<?php
// test.php

// Include the database connection file
include_once('connection.php');

// Check if maPhieuNhapKho parameter is set
if (isset($_GET['maPhieuNhapKho'])) {
    // Get the maPhieuNhapKho value from the AJAX request
    $maPhieuNhapKho = $_GET['maPhieuNhapKho'];

    try {
        // Prepare and execute the SQL query
        $query = "SELECT * FROM lohang WHERE maPhieuNhapKho = :maPhieuNhapKho";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':maPhieuNhapKho', $maPhieuNhapKho, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch data as an associative array
        $loHangData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the data as JSON
        echo json_encode($loHangData);
    } catch (PDOException $e) {
        // If an error occurs, return an error message
        echo json_encode(array('error' => 'Error: ' . $e->getMessage()));
    }
} else {
    // If maPhieuNhapKho parameter is not set, return an error
    echo json_encode(array('error' => 'maPhieuNhapKho parameter is missing'));
}
?>
