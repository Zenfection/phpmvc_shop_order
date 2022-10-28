<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?php echo _WEB_ROOT; ?>/assets/admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">ZenAdmin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li <?php echo ($current_sidebar == 'dashboard') ? 'class="mm-active"': ''?>>
            <a id="sidebar-dashboard" href="/admin/dashboard">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Quản lí Hàng</li>
            <li <?php echo ($current_sidebar == 'product') ? 'class="mm-active"': ''?>>
                <a id="sidebar-product" href="/admin/dashboard/product">
                    <div class="parent-icon"><i class='lni lni-gift'></i>
                    </div>
                    <div class="menu-title">Sản Phẩm</div>
                </a>
            </li>
            <li <?php echo ($current_sidebar == 'order') ? 'class="mm-active"': ''?>>
                <a id="sidebar-order" style="cursor: pointer;">
                    <div class="parent-icon"><i class='lni lni-shopping-basket'></i>
                    </div>
                    <div class="menu-title">Đơn Hàng</div>
                </a>
            </li>
            <li <?php echo ($current_sidebar == 'customer') ? 'class="mm-active"': ''?>>
                <a id="sidebar-customer" style="cursor: pointer;">
                    <div class="parent-icon"><i class='lni lni-users'></i>
                    </div>
                    <div class="menu-title">Khách Hàng</div>
                </a>
            </li>
        <li class="menu-label">Trợ Giúp</li>
        <li>
            <a href="https://facebook.com/zenfection" target="_blank">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">Hỏi & Đáp</div>
            </a>
            <a href="https://facebook.com/zenfection" target="_blank">
                <div class="parent-icon"><i class='bx bx-headphone'></i>
                </div>
                <div class="menu-title">Hỗ trợ 24/7</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->