<?php
if (!empty($data['msg'])) {
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
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative">
                        <input type="text" id="searchOrder" class="form-control ps-5 radius-30" placeholder="Tìm đơn hàng" value="<?php echo $_POST['search'] ?>">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                            <i class="bx bx-search"></i>
                        </span>
                    </div>
                </div>
                <div class="table-responsive" data-aos="fade-zoom-in" data-aos-duration="1000">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã Đơn#</th>
                                <th>Tên Khách Hàng</th>
                                <th>Số Điện Thoại</th>
                                <th>Trạng Thái</th>
                                <th>Tổng Tiền</th>
                                <th>Ngày Đặt</th>
                                <th>Xem Chi Tiết</th>
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
                                                <i class="bx bxs-circle me-1"></i><?php echo $statusVie[0] ?>
                                            </div>
                                        <?php
                                        } else if (($status == 'shipping')) {
                                        ?>
                                            <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle me-1"></i><?php echo $statusVie[1] ?>
                                            </div>
                                        <?php
                                        } else if (($status == 'delivered')) {
                                        ?>
                                            <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle me-1"></i><?php echo $statusVie[2] ?>
                                            </div>
                                        <?php
                                        } else if (($status == 'canceled')) {
                                        ?>
                                            <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle me-1"></i><?php echo $statusVie[3] ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $total ?>$</td>
                                    <td><?php echo $date ?></td>
                                    <td>
                                        <a class="cursor-pointer" onclick="loadOrderDetail('<?php echo $id?>')">
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
<!--end page wrapper -->