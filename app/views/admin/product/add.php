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
            <div class="card-body p-4">
                <h5 class="card-title">Thêm Sản Phẩm</h5>
                <hr />
                <form action="backend/add_product.php" method="post" id="addProductForm" novalidate>
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8" data-aos="fade-right">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô Tả</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập Mô Tả Sản Phẩm"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ảnh Sản Phẩm</label>
                                        <input id="image-uploadify" name="fileUpload" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf,.png,.jpg" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" data-aos="fade-left">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="price" class="form-label">Giá</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="00.00 $">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Số lượng</label>
                                            <input type="number" min=1 max=100 class="form-control" name="quantity" id="quantity" placeholder="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="discount" class="form-label">Giảm Giá</label>
                                            <input type="number" min=1 max=100 class="form-control" id="discount" name="discount" placeholder="0%">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ranking" class="form-label">Đánh Giá</label>
                                            <input type="number" min=1 max=10 class="form-control" id="ranking" name="ranking" placeholder="Từ 1 tới 10">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Kiểu Thức Ăn</label>
                                            <select class="form-select" id="inputProductType" name="type">
                                                <option></option>
                                                <option value="cake">Bánh</option>
                                                <option value="candy">Kẹo</option>
                                                <option value="fruit">Trái Cây</option>
                                                <option value="icecream">Kem</option>
                                                <option value="fastfood">Đồ Chiên</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary" name="submit">Lưu Sản Phẩm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/add_product.js"></script>