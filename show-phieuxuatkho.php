<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
    //get all nvl
    $nvl = include_once('database/showNVL.php');
    $nvl = json_encode($nvl);
    $pxks = include_once('database/showPhieuXuatKho.php');
    $count = include_once('database/countPhieuXuatKho.php');
    $pxks2 = include_once('database/showPhieuXuatKhotp.php');
    $count2 = include_once('database/countPhieuXuatKhotp.php');
	//echo $name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWL Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard_style.css">
    <link rel="icon" href="image/logo/icons8-the-flash-sign-100.png" type="image/x-icon" />
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- Thêm thư viện Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php include('partials/if-main.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php')?>
            <div class="title">
                <h1>Phiếu Xuất Kho</h1>
            </div>
            <div class="dashboard_content">
                <div class="row-add">
                   
                <h1>Danh sách phiếu xuất kho nguyên vật liệu</h1>
                                <div class="user">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Mã phiếu xuất kho</th>
                                                <th>Ngày lập phiếu</th>
                                                <th>Mã lô hàng</th>
                                                <th>Tên nguyên vật liệu</th>
                                                <th>Số lượng xuất</th>
                                                <th>Đơn vị tính</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pxks as $index => $pxk){ ?>
                                                <tr>
                                                    
                                                    <td><?php echo $pxk['maPhieuXuatKho'] ?></td>
                                                    <td><?php echo $pxk['ngayLapPhieu'] ?></td>
                                                    <td><?php echo $pxk['maLoHang'] ?></td>
                                                    <td><?php echo $pxk['tenNguyenVatLieu'] ?></td>
                                                    <td><?php echo $pxk['soLuong'] ?></td>
                                                    <td><?php echo $pxk['donViTinh'] ?></td>
                                                    
                                                </tr>
                                            <?php } ?>                   
                                        </tbody>
                                    </table>
                                    <p class="userCount"><?php echo count($count) ?> Phiếu xuất kho NVL</p>
                                </div>
                        <!-- </div> -->
                        <h1>Danh sách phiếu xuất kho thành phẩm</h1>
                                <div class="user">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Mã phiếu xuất kho</th>
                                                <th>Ngày lập phiếu</th>
                                                <th>Mã lô hàng</th>
                                                <th>Tên thành phẩm</th>
                                                <th>Số lượng xuất</th>
                                                <th>Đơn vị tính</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pxks2 as $index => $pxk){ ?>
                                                <tr>
                                                    
                                                    <td><?php echo $pxk['maPhieuXuatKho'] ?></td>
                                                    <td><?php echo $pxk['ngayLapPhieu'] ?></td>
                                                    <td><?php echo $pxk['maLoHang'] ?></td>
                                                    <td><?php echo $pxk['tenThanhPham'] ?></td>
                                                    <td><?php echo $pxk['soLuong'] ?></td>
                                                    <td><?php echo $pxk['donViTinh'] ?></td>
                                                    
                                                </tr>
                                            <?php } ?>                   
                                        </tbody>
                                    </table>
                                    <p class="userCount"><?php echo count($count2) ?> Phiếu xuất kho TP</p>
                                </div>
                        
                    
                    
                </div>
                
            </div>
        </div>
    </div>
<script src="js/script.js"></script>
<!-- <script src="js/jquery-3.6.1.min.js"></script> -->
<script>
    var nvl = <?php echo $nvl?>;
    function script()
    {
        let productOption = '\
        <div class="form-group orderProductRow">\
            <label for="tenNguyenVatLieu">Tên nguyên vật liệu:</label>\
            <select class="appFormInput" name="tenNguyenVatLieu[]" id="tenNguyenVatLieu">\
                <option value="NVL 1">Chọn nguyên vật liệu</option>\
                INSERTPRODUCTHERE\
            </select>\
        </div>\
        <div class="form-group ">\
            <label for="soLuongNhap">Số lượng:</label>\
            <input type="text" class="form-control" id="soLuongNhap" name="soLuongNhap[]" placeholder="Nhập số lượng">\
        </div>\
        <div class="form-group ">\
            <label for="donViTinh">Đơn vị tính:</label>\
            <select class="appFormInput" name="donViTinh[]" id="donViTinh">\
                <option value="kg">kg</option>\
                <option value="lon">lon</option>\
            </select>\
        </div>\
        <div class="form-group ">\
            <label for="ngaySanXuat">NSX</label>\
            <input type="date" class="form-control" name="ngaySanXuat[]" id="ngaySanXuat" placeholder="Nhập ngày sản xuất">\
        </div>\
        <div class="form-group ">\
            <label for="hanSuDung">HSD</label>\
            <input type="date" class="form-control" name="hanSuDung[]" id="hanSuDung" placeholder="Nhập hạn sử dụng">\
        </div>\
        <div class="form-group ">\
           <button class="btn btn-danger removeOrderBtn">Huỷ</button>\
        </div>';
        this.initallize =function(){
            this.registerEvents();
            this.renderProductOption();
        }
        this.renderProductOption = function() {
            // console.log(nvl);
            let optionHtml = '';

            nvl.forEach((p)=>{
                optionHtml+= '<option value="'+p.maNguyenVatLieu+'">'+p.tenNguyenVatLieu+'</option>';
            });
            // console.log(productOption);
            // console.log(optionHtml);
            productOption =productOption.replace("INSERTPRODUCTHERE", optionHtml);

            // Xử lý tiếp theo (nếu có) hoặc trả về optionHtml nếu cần
            // Ví dụ: return optionHtml;
        };


        this.registerEvents = function()
        {
            document.addEventListener('click', function(e){
                targetElement = e.target;
                classList =targetElement.classList;
                if(targetElement.id === 'orderProductBtn')
                {
                    let orderProductListContainer = document.getElementById('orderProductList');
                    orderProductList.innerHTML += '\
                    <div class="orderProductRow">\
                        '+productOption +'\
                    </div>';
                    // console.log(productOption);
                   
                }
                if (targetElement.classList.contains('removeOrderBtn')) {
                    let orderRow = targetElement.closest('div.orderProductRow');

                    if (orderRow) {
                        // Xóa phần tử
                        orderRow.remove();
                    }
                }

            });
            document.addEventListener('change', function(e){
                targetElement = e.target;
                classList =targetElement.classList;
                
                if(classList.contains('appFormInput'))
                {
                    let pid =targetElement.value;
                    // alert('change');
                    console.log(pid);
                   
                }
            });
        }
        this.renderSupplierRows = function(suppliers, counterId) {
            let supplierRows = '';

            suppliers.forEach((supplier) => {
                supplierRows += `
                    <div class="row">
                        <div style="width: 50%;">
                            <p class="supplierName">${supplier.supplier_name}</p>
                        </div>
                        <div style="width: 50%;">
                            <label for="quantity">Số lượng: </label>
                            <input type="number" class="appFormInput orderProductQty" id="quantity" placeholder="Nhập số lượng..." name="quantity" />
                        </div>
                    </div>
                `;
            });

            // Nối vào container
            let supplierRowContainer = document.getElementById('supplierRows_' + counterId);
            if (supplierRowContainer) {
                supplierRowContainer.innerHTML = supplierRows;
            }
        };

    }
    (new script()).initallize();
</script>
</body>
</html>