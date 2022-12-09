/**
    //! Đây là hàm để load content sử dụng công nghệ fetch API của Javascript
    //* Cách bước để loadContent:
        //? 1. Ẩn content và footer
        //? 2. Fetch API để lấy dữ liệu từ server
        //? 3. Nếu có lỗi logic thì hiển thị thông báo
        //? 4. Nếu không có lỗi logic thì thực hiện các bước tiếp theo
            //? 4.1. Thay đổi url trong thanh địa chỉ
            //? 4.2. Thay đổi nội dung content
            //? 4.3. Thay đổi title của trang
            //? 4.4. Load script tương ứng với content
            //? 4.5. Hiển thị content và footer

    //* Các hàm: 
        // TODO 1. loadContent(content, check = false)
            // content: tên của content cần load
            // check: kiểm tra xem có cần load script hay không
        // TODO 2. loadDetailProduct(id):
            // id: id của sản phẩm cần load
        // TODO 3. urlShop(category, sortby, page, search):
            // category: loại sản phẩm
            // sortby: cách sắp xếp sản phẩm
            // page: số trang
            // search: từ khóa cần tìm kiếm
        // TODO 4. filterShop(category = 'all', sortby = 'default', page = 1, search = ''):
            // category: tên của danh mục sản phẩm
            // sortby: cách sắp xếp sản phẩm
            // page: số trang
            // search: từ khóa tìm kiếm

        // TODO 5. popstate event listener để xử lý khi người dùng click vào nút back/forward của trình duyệt
        // TODO Các hàm bổ trợ 
            // 1. hideContent(): Ẩn content và footer
            // 2. showContent(): Hiển thị content và footer
            // 3. changeURL(url): Thay đổi url trong thanh địa chỉ
            // 4. loadSript(content): Load script tương ứng với content
*/

/* -------------------------- 
    DỮ LIỆU CHO CÁC TRANG
-----------------------------*/

var dataArr = [{
        'home': 'Trang Chủ',
        'about': 'Giới Thiệu',
        'contact': 'Liên Hệ',
        'shop': 'Cửa Hàng',
        'login': 'Đăng Nhập',
        'register': 'Đăng Ký',
        'viewcart': 'Xem Giỏ Hàng',
        'checkout': 'Thanh Toán',
        'account': 'Tài Khoản',
        'product/detail': 'Chi Tiết Sản Phẩm',
    },
    {
        'home': '/',
        'about': '/about',
        'contact': '/contact',
        'shop': '/shop/category',
        'login': '/login',
        'register': '/register',
        'viewcart': '/viewcart',
        'checkout': '/checkout',
        'account': '/account',
        'product/detail': '/product/detail',
    },
    {
        'home': '/assets/js/custom/home.js',
        'product/detail': '/assets/js/custom/product_detail.js',
        'shop': '/assets/js/custom/shop.js',
        'checkout': '/assets/js/custom/checkout.js',
        'account': '/assets/js/custom/account.js',
    },
    {
        'home': 'homeNav',
        'about': 'aboutNav',
        'contact': 'contactNav',
        'shop': 'shopNav'
    }
];
var titleArr = dataArr[0];
var urlArr = dataArr[1];
var scriptArr = dataArr[2];
var navArr = dataArr[3];

/* -------------------  
    HÀM CHÍNH XỬ LÝ LOAD CONTENT        
----------------------*/

function loadContent(content, logged = true) {
    hideContent(); // hide content and footer

    if(navArr[content] != undefined) {
        chooseNav(navArr[content]); // choose nav
    } else {
        resetNav(); // reset nav
    }

    let sucess = true;
    //use fetch API 
    fetch(`/${content}/content`)
        .then(response => response.text())
        .then(data => {
            try {
                //* Trường hợp có lỗi logic
                data = JSON.parse(data);
                let type = data['msg'].type;
                let icon = data['msg'].icon;
                let position = data['msg'].position;
                let content = data['msg'].content;

                notify(type, icon, position, content);
                sucess = false;
            } catch (e) {}

            if (sucess) {
                changeURL(urlArr[content]); // change url in address bar

                document.getElementById('content').innerHTML = data;
                document.title = titleArr[content];

                loadSript(content); // load script
            }
            showContent(); // show content and footer
            AOS.init();
        });
}

function loadDetailProduct(id) {
    chooseNav('shopNav'); // choose nav
    hideContent();
    //fetch API
    fetch(`/content/product_detail/${id}`)
        .then(response => response.text())
        .then(data => {
            changeURL(urlArr['product/detail'] + '/' + id);

            document.getElementById('content').innerHTML = data;
            document.title = titleArr['product/detail'];

            loadSript('product/detail');

            showContent();
            AOS.init();
        });
}

function urlShop(category, sortby, page, search) {
    let url;
    if (category == 'all' && sortby == 'default' && page == 1 && search == '') {
        url = '/shop/category';
    } else {
        url = `/shop/category/${category}/${sortby}/${page}/${search}`;
    }
    return url;
}

function filterShop(category = 'all', sortby = 'default', page = 1, search = '') {
    chooseNav('shopNav');
    if (sortby == 'check') {
        element = document.querySelector('.nice-select');
        sortby = element.options[element.selectedIndex].value;
    }
    hideProduct();
    //fetch API
    fetch('/content/filter_shop/' + category + '/' + sortby + '/' + page + '/' + search)
        .then(response => response.text())
        .then(data => {
            document.title = titleArr['shop'];
            changeURL(urlShop(category, sortby, page, search));

            document.getElementById('product-content').innerHTML = data;

            // Thay đổi current_category, current_sortby, current_page, current_search
            document.querySelector('.product-tab-nav li a.active').classList.remove('active');
            document.querySelector(`.product-tab-nav li a[id="${category}"]`).classList.add('active');


            let total = document.querySelector('.shop_wrapper').getAttribute('name');
            document.getElementsByClassName('shop-top-show')[0].innerHTML = `<span>Tổng cộng có ${total} sản phẩm</span>`

            document.querySelector('.search-box input').value = search;

            loadSript('shop');
            AOS.init();
        });
}


//* Listen back & forward button to load content
window.addEventListener('popstate', function () {
    let url = window.location.href;
    let path = url.replace(window.location.origin, '');
    let id = path.replace('/', '');

    if (path == '' || path == '/') {
        id = 'home';
    } else if (path.includes('/shop/category')) {
        let temp = path.replace('/shop/category', '');
        if (temp == '') {
            id = 'shop';
        } else {
            let arr = temp.split('/');
            let category = arr[1];
            let sortby = arr[2];
            let page = arr[3];
            let search = arr[4];
            filterShop(category, sortby, page, search, oldUrl = '');
            return; 
        }
    } else if (path.includes('/product/detail/')) {
        let content = path.replace('/product/detail/', '');
        loadDetailProduct(content);
        return;
    } 

    loadContent(id);
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
            document.getElementById('city').nextElementSibling.childNodes[1].textContent = 'Chọn Thành phố';

            changeTextNiceSelectSearch('Tìm kiếm...');
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
            document.querySelector('#ward').nextElementSibling.childNodes[1].textContent = 'Chọn phường';

            changeTextNiceSelectSearch('Tìm kiếm...');
        });
}


/* -----------------------------
    CÁC HÀM BỔ TRỢ
--------------------------------*/


function resetNav() {
    let navs = document.querySelectorAll('.main-menu li > a');
    navs.forEach(nav => {
        nav.classList.remove('active');
    });
}
function chooseNav(id) {
    resetNav();
    document.getElementById(id).classList.add('active');
}

function hideProduct() {
    document.querySelector('#product-content').innerHTML = `
	<div class="d-flex align-items-center justify-content-center">	
        <i class="fa-duotone fa-loader fa-spin-pulse fa-10x opacity-75" style="margin-top:15rem"></i>
    </div>`;
}

function hideContent() {
    //* Add padding right to body when scroll bar when reload
    let scrollBarWidth = window.innerWidth - $(document).width();
    document.body.style.paddingRight = scrollBarWidth.toString() + 'px';

    //* loader page 
    document.querySelector('#content').innerHTML = `
	<div class="d-flex align-items-center justify-content-center">	
        <i class="fa-duotone fa-loader fa-spin-pulse fa-10x opacity-75" style="margin-top:15rem"></i>
    </div>`;

    //* hide footer
    try {
        document.getElementsByTagName('footer')[0].style.display = 'none';
    } catch (error) {}
}

function showContent() {
    //* Show and footer
    try {
        document.getElementsByTagName('footer')[0].style.display = 'block';
    } catch (error) {}

    //* Remove padding right to body when scroll bar when reload
    document.body.style.paddingRight = '0px';
}

function loadSript(content) {
    if (scriptArr[content] != undefined) {
        let script = document.createElement('script');
        script.src = scriptArr[content];
        document.getElementById('content').appendChild(script);
    }
}

function changeURL(newUrl) {
    if (window.location.pathname != newUrl) {
        window.history.pushState(null, "", newUrl);
    }
}