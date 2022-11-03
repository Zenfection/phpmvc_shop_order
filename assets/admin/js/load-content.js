function loadDashboard() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.title = 'Dashboard';
            if (window.location.pathname != '/admin/dashboard') {
                window.history.pushState(null, null, '/admin/dashboard');
            }
            document.getElementById('content').innerHTML = this.responseText;
            //add script
            let script = document.createElement('script');
            script.src = '/assets/admin/js/custom/dashboard.js';
            document.body.appendChild(script);

            AOS.init();
        }
    }
    xhttp.open("POST", "/admin/content/dashboard", true);
    xhttp.send();
}

function loadProduct() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.title = 'Quản lý sản phẩm';
            if (window.location.pathname != '/admin/dashboard/product') {
                window.history.pushState(null, null, '/admin/dashboard/product');
            }
            document.getElementById('content').innerHTML = this.responseText;
            AOS.init();
        }
    }
    xhttp.open("POST", "/admin/content/product", true);
    xhttp.send();
}

function loadAddProduct() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.title = 'Thêm sản phẩm';

            window.history.pushState(null, null, '/admin/dashboard/product/');

            document.getElementById('content').innerHTML = this.responseText;
            AOS.init();
        }
    }
    xhttp.open("POST", "/admin/content/add_product", true);
    xhttp.send();
}

function loadOrder() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.title = 'Quản lý đơn hàng';
            if (window.location.pathname != '/admin/dashboard/order') {
                window.history.pushState(null, null, '/admin/dashboard/order');
            }
            document.getElementById('content').innerHTML = this.responseText;
            AOS.init();
        }
    }
    xhttp.open("POST", "/admin/content/order", true);
    xhttp.send();
}

function loadOrderDetail(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.title = 'Chi tiết đơn hàng' + id;
            if (window.location.pathname != '/admin/order/detail/' + id) {
                window.history.pushState(null, null, '/admin/order/detail/' + id);
            }
            document.getElementById('content').innerHTML = this.responseText;
            AOS.init();
        }
    }
    xhttp.open("POST", "/admin/content/order_detail/" + id, true);
    xhttp.send();
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