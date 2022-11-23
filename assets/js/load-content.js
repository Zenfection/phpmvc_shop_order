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
    }
];
var titleArr = dataArr[0];
var urlArr = dataArr[1];
var scriptArr = dataArr[2];


/* -------------------  
    HÀM CHÍNH XỬ LÝ LOAD CONTENT        
----------------------*/


function loadContent(content, check = false) {
    hideContent(); // hide content and footer
    let sucess = true;
    //use fetch API 
    fetch(`/content/${content}`)
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

                showContent(); // show content and footer
                AOS.init();
            }
        });
}

function loadDetailProduct(id) {
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
    if (sortby == 'check') {
        element = document.querySelector('.nice-select');
        sortby = element.options[element.selectedIndex].value;
    }
    hideContent();
    //fetch API
    fetch('/content/filter_shop/' + category + '/' + sortby + '/' + page + '/' + search)
        .then(response => response.text())
        .then(data => {
            document.title = titleArr['shop'];
            changeURL(urlShop(category, sortby, page, search));

            document.getElementById('content').innerHTML = data;

            loadSript('shop');

            showContent();
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


/* -----------------------------
    CÁC HÀM BỔ TRỢ
--------------------------------*/

function hideContent() {
    //* Add padding right to body when scroll bar when reload
    let scrollBarWidth = window.innerWidth - $(document).width();
    document.body.style.paddingRight = scrollBarWidth.toString() + 'px';

    //* Hide content and footer
    document.getElementById('content').style.display = 'none';
    document.getElementsByTagName('footer')[0].style.display = 'none';
}

function showContent() {
    //* Show content and footer
    document.getElementById('content').style.display = 'block';
    document.getElementsByTagName('footer')[0].style.display = 'block';

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