<?php
if (!empty($msg)) {
    $type_msg = $msg['type'];
    $icon_msg = $msg['icon'];
    $pos_msg = $msg['position'];
    $content_msg = $msg['content'];
    echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg');</script>";
}
?>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" data-aos="fade-zoom-in" data-aos-duration="1000">
                    <table class="table mb-0" id="list_order">
                        <thead class="table-light" style="font-size: 1rem;">
                            <tr>
                                <th><i class="fa-duotone fa-fingerprint me-1"></i>Mã Đơn#</th>
                                <th><i class="fa-duotone fa-signature me-1"></i>Tên Khác Hàng</th>
                                <th><i class="fa-duotone fa-phone-volume me-1"></i>Số điện thoại</th>
                                <th><i class="fa-duotone fa-box-taped me-1"></i>Trạng Thái</th>
                                <th><i class="fa-duotone fa-coins me-1"></i>Tổng Tiền</th>
                                <th><i class="fa-duotone fa-calendar me-1"></i>Ngày Đặt</th>
                                <th><i class="fa-duotone fa-eye me-1"></i>Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($order as $key => $value) {
                                $id = $value['id_order'];
                                $name = $value['name_customer'];
                                $phone = $value['phone_customer'];
                                $status = $value['status'];
                                // pending, shipping, delivered, canceled
                                $total = (float)$value['total_money'];
                                $date = $value['order_date'];
                                $statusVie = ["Đang xử lý", "Đang giao hàng", "Đã giao hàng", "Đã hủy"];
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14"><?php echo $id ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $phone ?></td>
                                    <td>
                                        <?php
                                        if (($status == 'pending')) {
                                        ?>
                                            <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                                <i class="fa-duotone fa-box-taped me-1 fa-lg"></i><?php echo $statusVie[0] ?>
                                            </div>
                                        <?php
                                        } else if (($status == 'shipping')) {
                                        ?>
                                            <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                                <i class="fa-duotone fa-truck-fast me-1 fa-lg"></i><?php echo $statusVie[1] ?>
                                            </div>
                                        <?php
                                        } else if (($status == 'delivered')) {
                                        ?>
                                            <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                <i class="fa-duotone fa-person-carry-box me-1 fa-lg"></i><?php echo $statusVie[2] ?>
                                            </div>
                                        <?php
                                        } else if (($status == 'canceled')) {
                                        ?>
                                            <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                <i class="fa-duotone fa-ban me-1  fa-lg"></i><?php echo $statusVie[3] ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo number_price($total) ?></td>
                                    <td><?php echo $date ?></td>
                                    <td>
                                        <a href="javascript:;" onclick="loadOrderDetail('<?php echo $id?>')">
                                            <button type="button" class="btn btn-primary btn-sm radius-30 px-4">Xem</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/order.js"></script>