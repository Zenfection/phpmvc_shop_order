/**
 * Hàm được tạo ra bởi Zenfection
    //TODO Sử dụng để load nội dung của trang bằng fetch API
    //? Cách dùng: thêm onlick vào các thẻ a dẫn tới trang khác
    //! Lưu ý: Riêng trang order_detal và chỉ sử dụng các trang sau:
        //* dashboard, product, add_product, odrer, order_detail
 */

var dataArr = [{
        'dashboard': 'Dashboard',
        'product': 'Quản lý sản phẩm',
        'order': 'Quản lý đơn hàng',
        'add-product': 'Thêm sản phẩm',
        'customer': 'Quản lý khách hàng',
    },
    {
        'dashboard': '/admin/content/dashboard',
        'product': '/admin/content/product',
        'order': '/admin/content/order',
        'add-product': '/admin/content/add_product',
        'customer': '/admin/content/customer',
    },
    {
        'dashboard': '/admin/dashboard',
        'product': '/admin/dashboard/product',
        'order': '/admin/dashboard/order',
        'add-product': '/admin/product/add',
        'customer': '/admin/dashboard/customer',
    },
    {
        'dashboard': window.location.origin + '/assets/admin/js/custom/dashboard.js',
        'product': window.location.origin + '/assets/admin/js/custom/product.js',
        'add-product': window.location.origin + '/assets/admin/js/custom/add_product.js',
        'order': window.location.origin + '/assets/admin/js/custom/order.js',
        'customer': window.location.origin + '/assets/admin/js/custom/customer.js',
    }
];

var titleArr = dataArr[0];
var contentArr = dataArr[1];
var pathArr = dataArr[2];
var scriptArr = dataArr[3];

function hideContent() {
    //* Add padding right to body when scroll bar when reload
    let scrollBarWidth = window.innerWidth - $(document).width();
    document.body.style.paddingRight = scrollBarWidth.toString() + 'px';

    //* Hide content and footer

    // loader page 
    document.querySelector('.page-content').innerHTML = `
	<div class="d-flex align-items-center justify-content-center">	
        <i class="fa-duotone fa-loader fa-spin-pulse fa-10x" style="margin-top:15rem"></i>
    </div>`;
    document.getElementsByClassName('page-footer')[0].style.display = 'none';
}

function showContent() {
    document.getElementsByClassName('page-footer')[0].style.display = 'block';

    //* Remove padding right to body when scroll bar when reload
    document.body.style.paddingRight = '0px';
}

function loadContent(content) {
    hideContent();
    //fetch API
    fetch(contentArr[content])
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;

            document.title = titleArr[content];
            if (window.location.pathname != pathArr[content]) {
                window.history.pushState(null, null, pathArr[content]);
            }

            //add script, check content in or not in scriptArr
            if (content in scriptArr) {
                let script = document.createElement('script');
                script.src = scriptArr[content];
                document.body.appendChild(script);
            }
            showContent();
            AOS.init();
        });
}


function loadOrderDetail(id) {
    //fetch API
    fetch(`/admin/content/order_detail/${id}`)
        .then(response => response.text())
        .then(data => {
            document.title = 'Chi tiết đơn hàng';
            window.history.pushState(null, null, `/admin/order/detail/${id}`);
            document.getElementById('content').innerHTML = data;

            let sciprt = document.createElement('script');
            sciprt.src = window.location.origin + '/assets/admin/js/custom/order_detail.js';
            document.body.appendChild(sciprt);
            AOS.init();

        })
}

function loadProductDetail(id) {
    //fetch API
    fetch(`/admin/content/product_detail/${id}`)
        .then(response => response.text())
        .then(data => {
            document.title = 'Chi tiết sản phẩm';
            window.history.pushState(null, null, `/admin/product/detail/${id}`);
            document.getElementById('content').innerHTML = data;

            let sciprt = document.createElement('script');
            sciprt.src = window.location.origin + '/assets/admin/js/custom/product_detail.js';
            document.body.appendChild(sciprt);

            AOS.init();
        })
}

function loadUserInfo($user) {
    //fetch API
    fetch(`/admin/content/user_info/${$user}`)
        .then(response => response.text())
        .then(data => {
            document.title = 'Thông tin người dùng';
            window.history.pushState(null, null, `/admin/customer/info/${$user}`);
            document.getElementById('content').innerHTML = data;

            let sciprt = document.createElement('script');
            sciprt.src = window.location.origin + '/assets/admin/js/custom/user_info.js';
            document.body.appendChild(sciprt);

            AOS.init();
        })
}

//* Listen back & forward button to load content
window.addEventListener('popstate', function () {
    let url = new URL(window.location.href);
    let path = url.pathname;

    if (path.includes('/admin/product/detail')) {
        let id = path.replace('/admin/product/detail/', '');
        loadProductDetail(id);
        return;
    } else if (path.includes('/admin/order/detail')) {
        let id = path.replace('/admin/order/detail/', '');
        loadOrderDetail(id);
        return;
    } else if (path.includes('/admin/customer/info')) {
        let id = path.replace('/admin/customer/info/', '');
        loadUserInfo(id);
        return;
    }
    // check onject pathArr have path or not
    for (let key in pathArr) {
        if (pathArr[key] == path) {
            loadContent(key);
        }
    }
});



function loadCity() {
    let element = document.getElementById('province');
    let province = element.options[element.selectedIndex].text;

    fetch(`/address/get_city/${province}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('city').innerHTML = data;
            document.getElementById('city').nextSibling.remove();


            let options = {
                searchable: true
            };
            NiceSelect.bind(city, options).update();

            //* Change text "Select as option" to "Chọn quận / huyện"
            document.getElementById('city').nextElementSibling.childNodes[1].textContent = 'Chọn quận / huyện';
        })
}

function loadWard() {
    let element = document.getElementById('city');
    let city = element.options[element.selectedIndex].text;

    console.log(city);
    fetch(`/address/get_ward/${city}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('ward').innerHTML = data;
            document.querySelector('#ward').nextSibling.remove();
            let options = {
                searchable: true
            };
            NiceSelect.bind(ward, options).update();

            //* Change text "Select as option" to "Chọn phường / xã "
            document.querySelector('#ward').nextElementSibling.childNodes[1].textContent = 'Chọn phường / xã';
        });
}