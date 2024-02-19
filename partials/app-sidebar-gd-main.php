<div class="dashboard_sidebar" id="dashboard_sidebar">
            <h3 class="dashboard_logo">OWL</h3>
            <div class="dashboard_sidebar_user">
                <img src="images/user.jpg" alt="User Image." id="userImage"/>
                <span><?php echo $name?></span>
            </div>
            <div class="dashboard_sidebar_menus">
                <ul class="dashboard_menu_lists">
                    <li class="liMainMenu">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i><span class="menuText">Dashboard</span></a>
                    </li>
                    <li class="liMainMenu" >
                        <a href="show-nvl.php" class="showHideSubMenu" >
                            <i class="fa fa-cubes showHideSubMenu"></i>
                            <span class="menuText showHideSubMenu">Nguyên vật liệu</span>
                        </a>
                    </li>
                    <li class="liMainMenu" >
                        <a href="show-tp.php" class="showHideSubMenu" >
                            <i class="fa fa-cubes showHideSubMenu"></i>
                            <span class="menuText showHideSubMenu">Thành phẩm</span>
                        </a>
                    </li>
                    <li class="liMainMenu" >
                        <a href="show-kho.php" class="showHideSubMenu" >
                            <i class="fa fa-cubes showHideSubMenu"></i>
                            <span class="menuText showHideSubMenu">Kho</span>
                        </a>
                    </li>
                    <li class="liMainMenu" >
                        <a href="show-lohang.php" class="showHideSubMenu" >
                            <i class="fa fa-archive showHideSubMenu"></i>
                            <span class="menuText showHideSubMenu">Lô hàng</span>
                            
                        </a>
                        
                    </li>
                    <li class="liMainMenu" >
                    <a href="#" class="showHideSubMenu" >
                            <!-- <i class="fa fa-tag showHideSubMenu" ></i> -->
                            <i class="fa fa-folder-open showHideSubMenu"></i>
                            <span class="menuText showHideSubMenu">Biên bản kiểm kê</span>
                            <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" style="float: right;"></i>
                        </a>
                        <ul class="subMenus">
                            <li>
                                <!-- <a class="subMenuLink" href="bienbankiemke.php"><i class="fa fa-shield fa-rotate-270"></i>Tạo biên bản kiểm kê</a> -->
                                <a class="subMenuLink" href="bienbankiemke-duyet.php"><i class="fa fa-shield fa-rotate-270"></i>Duyệt biên bản kiểm kê</a>
                                <a class="subMenuLink" href="show-bienbankiemke.php"><i class="fa fa-shield fa-rotate-270"></i>Danh sách biên bản kiểm kê</a>
                            </li>
                        </ul>
                    </li>
                    <li class="liMainMenu" >
                        <a href="#" class="showHideSubMenu" >
                            <!-- <i class="fa fa-tag showHideSubMenu" ></i> -->
                            <i class="fa fa-folder-open showHideSubMenu"></i>
                            <span class="menuText showHideSubMenu">Phiếu/Đơn/Biên bản</span>
                            <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" style="float: right;"></i>
                        </a>
                        <ul class="subMenus">
                            <li>
                                <a class="subMenuLink" href="show-phieunhapkho.php"><i class="fa fa-shield fa-rotate-270"></i>Phiếu nhập kho</a>
                                <a class="subMenuLink" href="show-phieuxuatkho.php"><i class="fa fa-shield fa-rotate-270"></i>Phiếu xuất kho</a>
                                <a class="subMenuLink" href="show-phieudieuphoi.php"><i class="fa fa-shield fa-rotate-270"></i>Phiếu điều phối</a>
                                <a class="subMenuLink" href="show-bienbankiemke.php"><i class="fa fa-shield fa-rotate-270"></i>Biên bản kiểm kê</a>
                                
                            </li>
                        </ul>
                    </li>
                    <li class="liMainMenu">
                        <a href="thongke.php"><i class="fa fa-pie-chart"></i><span class="menuText">Thống kê</span></a>
                    </li>
                </ul>
            </div>
        </div>