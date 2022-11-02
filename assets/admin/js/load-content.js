function loadDashboard() {
    $.ajax({
        url: '/admin/content/dashboard',
        type: 'POST',
        success: function (data) {
            document.title = 'Trang chủ';
            if (window.location.pathname != '/admin/dashboard') {
                window.history.pushState(null, null, '/admin/dashboard');
            }
            $('#content').html(data);
            AOS.init();
        }
    });
}

function loadProduct() {
    $.ajax({
        url: '/admin/content/product',
        type: 'POST',
        success: function (data) {
            document.title = 'Quản lý sản phẩm';
            if (window.location.pathname != '/admin/dashboard/product') {
                window.history.pushState(null, null, '/admin/dashboard/product');
            }
            $('#content').html(data);
            AOS.init();
        }
    })
}

function loadAddProduct(){
    $.ajax({
        url: '/admin/content/add_product',
        type: 'POST',
        success: function (data) {
            document.title = 'Thêm sản phẩm';
            if (window.location.pathname != '/admin/dashboard/add_product') {
                window.history.pushState(null, null, '/admin/dashboard/add_product');
            }
            $('#content').html(data);
            AOS.init();
        }
    })
}

function loadOrder() {
    $.ajax({
        url: '/admin/content/order',
        type: 'POST',
        success: function (data) {
            document.title = 'Quản lý đơn hàng';
            if (window.location.pathname != '/admin/dashboard/order') {
                window.history.pushState(null, null, '/admin/dashboard/order');
            }
            $('#content').html(data);
            AOS.init();
        }
    })
}

//* Listen back & forward button to load content
window.addEventListener('popstate', function () {
    let url = new URL(window.location.href);
    let path = url.pathname;
    let id = path.replace('/', '');

    if (id == 'admin/dashboard') {
        loadDashboard();
    } else if (id == 'admin/dashboard/product') {
        loadProduct();
    } else if (id == 'admin/dashboard/order') {
        loadOrder();
    }
});

