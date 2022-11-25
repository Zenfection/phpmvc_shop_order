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
                <form id="addNewProductForm" novalidate>
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8" data-aos="fade-right">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ảnh Sản Phẩm</label>
                                        <input id="image-uploadify" name="file" type="file" accept=".png,.jpg" multiple>
                                    </div>
                                </div>
                                <div class="border border-2 p-2 rounded">
                                    <div class="col-4 mx-auto">
                                        <div class="d-grid">
                                            <button type="button" class="btn btn-primary" onclick="addNewProduct()">
                                                <i class="fa-duotone fa-square-plus fa-lg"></i>
                                                Lưu Sản Phẩm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" data-aos="fade-left">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô Tả</label>
                                        <textarea id="mytextarea" name="mytextarea" placeholder="Nhập mô tả sản phẩm"></textarea>
                                    </div>
                                </div>
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="price" class="form-label">Giá</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="0.000 đ">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Số lượng</label>
                                            <input type="number" min=1 max=1000 class="form-control" name="quantity" id="quantity" placeholder="0..1000">
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
                                            <select class="nice-select" id="category" name="type">
                                                <option value=""></option>
                                                <option value="cake">Bánh</option>
                                                <option value="candy">Kẹo</option>
                                                <option value="fruit">Trái Cây</option>
                                                <option value="icecream">Kem</option>
                                                <option value="fastfood">Đồ Chiên</option>
                                            </select>
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

<style>
    .nice-select-dropdown {
        width: 100% !important;
    }

    select.nice-select {
        display: none !important;
    }

    .nice-select {
        display: block !important;
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #ced4da !important;
        background-color: #fff !important;
        border-radius: 0.375rem !important;
    }

    .nice-select:focus {
        border-color: #80bdff !important;
        outline: 0 !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>


<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/add_product.js"></script>