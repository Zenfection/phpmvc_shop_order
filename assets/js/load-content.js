var dataArr = [{
    'home': 'Trang Chủ',
    'about': 'Giới Thiệu',
    'contact': 'Liên Hệ',
    'shop': 'Cửa Hàng',
    'shop/cake': 'Bánh',
    'shop/candy': 'Kẹo',
    'shop/fastfood': 'Đồ Ăn Nhanh',
    'shop/fruit': 'Trái Cây',
    'shop/icecream': 'Kem',
    'login': 'Đăng Nhập',
    'viewcart': 'Xem Giỏ Hàng',
    'checkout': 'Thanh Toán',
    'account': 'Tài Khoản',
},
{
    'home': '/',
    'about': '/about',
    'contact': '/contact',
    'shop': '/shop/category',
    'shop/cake': '/shop/category/cake',
    'shop/candy': '/shop/category/candy',
    'shop/fastfood': '/shop/category/fastfood',
    'shop/fruit': '/shop/category/fruit',
    'shop/icecream': '/shop/category/icecream',
    'login': '/login',
    'viewcart': '/viewcart',
    'checkout': '/checkout',
    'account': '/account',
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

// list history url when click back button
var historyURL = [];

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
        document.body.appendChild(script);
    }
}

function loadContent(content, check = false) {
    let sucess = true;
    historyURL.push(window.location.href);
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
                hideContent();
                // add padding right to body when scroll bar appear
                document.getElementById('content').innerHTML = data;
                document.title = titleArr[content];

                if (scriptArr[content] != undefined) {
                    let script = document.createElement('script');
                    script.src = `/assets/js/custom/${content}.js`;
                    document.body.appendChild(script);
                }

                let newURL = window.location.href + '/' + urlArr[content];
                window.history.pushState({path: newURL}, "", urlArr[content]);

                showContent();

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
            document.getElementById('content').innerHTML = data;
            document.title = titleArr['product/detail'];

            if (scriptArr['product/detail'] != undefined) {
                let script = document.createElement('script');
                script.src = scriptArr['product/detail'];
                document.body.appendChild(script);
            }

            let newURL = window.location.href + '/product_detail/' + id;
            window.history.pushState({path:newURL}, "", `/product/detail/${id}`);

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
    let url = urlShop(category, sortby, page, search);

    //fetch API
    fetch(`/content/filter_shop/${category}/${sortby}/${page}/${search}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            document.title = titleArr['shop'];

            if (scriptArr['shop'] != undefined) {
                let script = document.createElement('script');
                script.src = scriptArr['shop'];
                document.body.appendChild(script);
            }

            let newURL = window.location.href + url;
            window.history.pushState({path: newURL}, "", url);
            AOS.init();
        });
}

//* Listen back & forward button to load content
window.addEventListener('popstate', function () {
    let url = historyURL[historyURL.length - 1];
    let path = url.pathname;
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
            filterShop(category, sortby, page, search);
        }
    } else if (path.includes('/product/detail/')) {
        let content = path.replace('/product/detail/', '');
        loadDetailProduct(content);
        return;
    }

    loadContent(id);
});

// Google map API fetch