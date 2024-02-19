<?php
	//bắt đầu session
	session_start();
	if(!isset($_SESSION['taikhoan']))
	{
		header('Location: index.php');
	}
	$taikhoan = $_SESSION['taikhoan'];
	$name = $taikhoan['tenTaiKhoan'];
	//echo $name;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWL Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard_style.css">
    <link rel="icon" href="image/logo/icons8-the-flash-sign-100.png" type="image/x-icon" />
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css "> -->
    <!-- Thêm thư viện Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../css/metisMenu.min.css" rel="stylesheet">

<!-- Timeline CSS -->
<link href="../css/timeline.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/startmin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="../css/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
   
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('../partials/if.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('../partials/app-topnav-dash.php')?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                <div id="wrapper">
           

            <!-- <div id="page-wrapper"> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Trang chủ</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">26</div>
                                            <div>Thông báo mới!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Xem chi tiết</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">12</div>
                                            <div>Công việc mới</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Xem chi tiết</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-shopping-cart fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">124</div>
                                            <div>Đơn hàng mới!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Xem chi tiết</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-support fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">13</div>
                                            <div>Yêu cầu hỗ trợ!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Xem chi tiết</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Biểu đồ khu vực
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                Actions
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Hành động</a>
                                                </li>
                                                <li><a href="#">Hành động khác</a>
                                                </li>
                                                <li><a href="#">Khác</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="#">Liên kết riêng biệt</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="morris-area-chart"></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Biểu đồ cột
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                Actions
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Hành động</a>
                                                </li>
                                                <li><a href="#">Hành động khác</a>
                                                </li>
                                                <li><a href="#">Khác</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="#">Liên kết riêng biệt</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Ngày</th>
                                                            <th>Thời gian</th>
                                                            <th>Số lượng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>3326</td>
                                                            <td>10/21/2023</td>
                                                            <td>3:29 PM</td>
                                                            <td>$321.33</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3325</td>
                                                            <td>10/21/2023</td>
                                                            <td>3:20 PM</td>
                                                            <td>$234.34</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3324</td>
                                                            <td>10/21/2023</td>
                                                            <td>3:03 PM</td>
                                                            <td>$724.17</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3323</td>
                                                            <td>10/21/2023</td>
                                                            <td>3:00 PM</td>
                                                            <td>$23.71</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3322</td>
                                                            <td>10/21/2023</td>
                                                            <td>2:49 PM</td>
                                                            <td>$8345.23</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3321</td>
                                                            <td>10/21/2023</td>
                                                            <td>2:23 PM</td>
                                                            <td>$245.12</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3320</td>
                                                            <td>10/21/2023</td>
                                                            <td>2:15 PM</td>
                                                            <td>$5663.54</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3319</td>
                                                            <td>10/21/2023</td>
                                                            <td>2:13 PM</td>
                                                            <td>$943.45</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.col-lg-4 (nested) -->
                                        <div class="col-lg-8">
                                            <div id="morris-bar-chart"></div>
                                        </div>
                                        <!-- /.col-lg-8 (nested) -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                           
                        </div>
                        <!-- /.col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bell fa-fw"></i> Bảng thông báo
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-shopping-cart fa-fw"></i> Đặt đơn hàng mới
                                            <span class="pull-right text-muted small"><em>9:49 AM</em>
                                            </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-money fa-fw"></i> Thanh toán đã nhận
                                            <span class="pull-right text-muted small"><em>Yesterday</em>
                                            </span>
                                        </a>
                                    </div>
                                    <!-- /.list-group -->
                                    <a href="#" class="btn btn-default btn-block">Xem tất cả cảnh báo</a>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Biểu đồ Donut
                                </div>
                                <div class="panel-body">
                                    <div id="morris-donut-chart"></div>
                                    <a href="#" class="btn btn-default btn-block">Xem chi tiết</a>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                            <div class="chat-panel panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-comments fa-fw"></i>
                                    Chat
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu slidedown">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-refresh fa-fw"></i>  Làm mới
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-check-circle fa-fw"></i> Khả dụng
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-times fa-fw"></i> Bận
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-clock-o fa-fw"></i> Vắng mặt
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-sign-out fa-fw"></i> Đăng xuất
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                               
                            </div>
                            <!-- /.panel .chat-panel -->
                        </div>
                        <!-- /.col-lg-4 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
                </div>
            </div>
        </div>
    </div>
<script src="../js/script.js"></script>
 <!-- jQuery -->
 <script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../js/raphael.min.js"></script>
<script src="../js/morris.min.js"></script>
<script src="../js/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</body>
</html>
