<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Danh sách người dùng</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="list_customer" class="table table-striped table-bordered">
                        <thead>
                            <tr style="font-size: 1rem !important;">
                                <th><i class="fa-duotone fa-user me-1"></i>Username</th>
                                <th><i class="fa-duotone fa-signature me-1"></i>Họ và Tên</th>
                                <th><i class="fa-duotone fa-at me-1"></i>Email</th>
                                <th><i class="fa-duotone fa-phone-volume me-1"></i>Số điện thoại</th>
                                <th><i class="fa-duotone fa-address-card me-1"></i>Địa Chỉ</th>
                                <th>Đã mua</th>
                                <th>Tiện Ích</th>
                            </tr>
                        </thead>
                        <tbody class="font-15">
                            <?php
                            foreach ($customer as $key => $value) {
                                $username = $value['username'];
                                $fullname = $value['fullname'];
                                $phone = $value['phone'];
                                $email = $value['email'];
                                $address = $value['address'];

                                $count_ordered = 0;
                                foreach ($count_order_user as $key => $value) {
                                    if ($value['username'] == $username) {
                                        $count_ordered = $value['count'];
                                        //remove data from array
                                        unset($count_order_user[$key]);
                                    }
                                }
                            ?>
                                <tr>
                                    <td><?php echo $username ?></td>
                                    <td><?php echo $fullname ?></td>
                                    <td><?php echo $email ?></td>
                                    <td>
                                        <?php if ($phone != '') {
                                        ?>
                                            <div class="badge rounded-pill text-secondary bg-light-warning p-2 text-uppercase px-3 font-13">
                                                <?php echo $phone ?>
                                            </div>
                                        <?php
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($address != '') {
                                        ?>
                                            <div class="badge rounded-pill text-secondary bg-light-info p-2 text-uppercase px-3 font-13">
                                                <?php echo $address ?>
                                            </div>
                                        <?php
                                        } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($count_ordered == 0) {
                                            echo '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3 font-14"> 
                                                <i class="fa-duotone fa-cart-circle-xmark me-1"></i>';
                                        } else {
                                            echo '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 font-14">
                                                <i class="fa-duotone fa-cart-circle-check me-1"></i>';
                                        }
                                        echo $count_ordered;
                                        echo "</div>";
                                        ?>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="javascript:;" class=""><i class='fa-duotone fa-user-pen'></i></a>
                                            <a href="javascript:;" class="ms-3"><i class='fa-duotone fa-trash-can'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Họ và Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Địa Chỉ</th>
                                <th>Đã mua</th>
                                <th>Tiện Ích</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/customer.js"></script>