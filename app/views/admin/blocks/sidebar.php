<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?php echo _GIT_SOURCE; ?>/assets/admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">ZenAdmin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='fa-duotone fa-backward-step'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li <?php echo ($current_sidebar == 'dashboard') ? 'class="mm-active"': ''?>>
            <a id="sidebar-dashboard" href="javascript:;" onclick="loadContent('dashboard')">
                <div class="parent-icon"><i class='fa-duotone fa-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Quản lí Hàng</li>
            <li <?php echo ($current_sidebar == 'product') ? 'class="mm-active"': ''?>>
                <a id="sidebar-product" href="javascript:;" onclick="loadContent('product')">
                    <div class="parent-icon"><i class='fa-duotone fa-burger-soda'></i>
                    </div>
                    <div class="menu-title">Sản Phẩm</div>
                </a>
            </li>
            <li <?php echo ($current_sidebar == 'order') ? 'class="mm-active"': ''?>>
                <a id="sidebar-order" href="javascript:;" onclick="loadContent('order')">
                    <div class="parent-icon"><i class='fa-duotone fa-basket-shopping-simple'></i>
                    </div>
                    <div class="menu-title">Đơn Hàng</div>
                </a>
            </li>
            <li <?php echo ($current_sidebar == 'customer') ? 'class="mm-active"': ''?>>
                <a id="sidebar-customer" href="javascript:;" onclick="loadContent('customer')">
                    <div class="parent-icon"><i class='fa-duotone fa-users-gear'></i>
                    </div>
                    <div class="menu-title">Khách Hàng</div>
                </a>
            </li>
        <li class="menu-label">Trợ Giúp</li>
        <li>
            <a href="https://facebook.com/zenfection" target="_blank">
                <div class="parent-icon"><i class="fa-duotone fa-circle-question"></i>
                </div>
                <div class="menu-title">Hỏi & Đáp</div>
            </a>
            <a href="https://facebook.com/zenfection" target="_blank">
                <div class="parent-icon"><i class='fa-duotone fa-headset'></i>
                </div>
                <div class="menu-title">Hỗ trợ 24/7</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->