<?php
// Kết nối CSDL và thực hiện truy vấn để lấy danh sách lohang
include("connection.php");

if (isset($_GET['maNguyenVatLieu'])) {
    $maNguyenVatLieu = $_GET['maNguyenVatLieu'];

    $stmt = $conn->prepare("SELECT 
    lohang.maLoHang, 
    nguyenvatlieu.tenNguyenVatLieu, 
    lohang.soLuongChinh, 
    lohang.donViTinh, 
    lohang.ngaySanXuat, 
    lohang.hanSuDung, 
    lohang.maPhieuNhapKho, 
    lohang.ngayLap,
    kho.tenKho,
    lohang.maNguyenVatLieu
    FROM 
        lohang
    INNER JOIN 
        nguyenvatlieu ON lohang.maNguyenVatLieu = nguyenvatlieu.maNguyenVatLieu
    INNER JOIN 
        kho ON lohang.maKho = kho.maKho
    WHERE lohang.maNguyenVatLieu = :maNguyenVatLieu");
    $stmt->bindParam(':maNguyenVatLieu', $maNguyenVatLieu, PDO::PARAM_INT);
    $stmt->execute();

    // Xây dựng HTML cho bảng lohang
    if($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lohangTable .= "<tr>
        <td>{$row['maLoHang']}</td>
        <td>{$row['tenNguyenVatLieu']}</td>
        <td>{$row['soLuongChinh']}</td>
        <td>{$row['donViTinh']}</td>
        <td>{$row['ngaySanXuat']}</td>
        <td>{$row['hanSuDung']}</td>
        <td>{$row['tenKho']}</td>
        <td>
            <button id='updateBtn' class='btn btn-primary'
                data-maLohang='{$row['maLoHang']}'
                data-tenNguyenVatLieu='{$row['tenNguyenVatLieu']}' 
                data-soLuong='{$row['soLuongChinh']}' 
                data-donViTinh='{$row['donViTinh']}'
                data-ngaySanXuat='{$row['ngaySanXuat']}'
                data-hanSuDung='{$row['hanSuDung']}'
                data-maPhieuNhapKho='{$row['maPhieuNhapKho']}'
                data-ngayLap='{$row['ngayLap']}'
                data-maKho='{$row['maKho']}'><i class='fa fa-external-link-square '> Xuất kho</i></button>
                    <!-- Modal Bootstrap -->
                <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Xuất lô hàng nguyên vật liệu</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <!-- Form để nhập thông tin mới -->
                                <form id='updateForm'>
                                    <div class='form-group'>
                                        <label for='UmaLoHang'>Mã lô lô hàng:</label>
                                        <input type='text' class='form-control' id='UmaLoHang' placeholder='Nhập mã tài khoản' readonly>
                                    </div>
                                    <div class='form-group'>
                                        <label for='UmaNguyenVatLieu'>Tên nguyên vật liệu</label>
                                        <input type='text' class='form-control' id='UmaNguyenVatLieu' placeholder='Nhập mật khẩu' readonly>
                                    </div>
                                    <div class='form-group'>
                                        <label for='UsoLuong'>Số lượng tồn</label>
                                        <input type='text' class='form-control' id='UsoLuong' placeholder='Nhập tên tài khoản'  readonly>
                                    </div>
                                    <div class='form-group'>
                                        <label for='UdonViTinh'>Đơn vị tính</label>
                                        <input type='text' class='form-control' id='UdonViTinh' placeholder='Nhập tên tài khoản'  readonly>
                                    </div>
                                    <div class='form-group'>
                                        <label for='UsoLuongXuat'>Số lượng xuất kho</label>
                                        <input type='number' class='form-control' id='UsoLuongXuat' name='UsoLuongXuat' placeholder='Nhập số lượng xuất kho' >
                                    </div>
                                    
                                </form>
                            </div>
                            <div class='modal-footer'>
                                <!-- Nút cập nhật -->
                                <button type='button' class='btn btn-primary' id='updateUserBtn'>Xác nhận</button>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

                
            </td>
        </tr>";
    }

    echo $lohangTable;
} else {echo "<tr><td colspan='8'>Không có lô hàng nào cho nguyên vật liệu này hoặc lô hàng nguyên vật liệu này chưa được điều phối.</td></tr>";}
}
?>
