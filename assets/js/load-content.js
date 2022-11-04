let Arr = [{
        'home': 'Trang Chủ',
        'about': 'Giới Thiệu',
        'contact': 'Liên Hệ',
        'shop': 'Cửa Hàng',
        'shop/cake': 'Bánh',
        'shop/candy': 'Kẹo',
        'shop/fastfood': 'Đồ Ăn Nhanh',
        'shop/fruit': 'Trái Cây',
        'shop/icecream': 'Kem',
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
    },
    {
        'home': '/assets/js/custom/home.js',
        'product/detail': '/assets/js/custom/product_detail.js',
    }
];
titleArr = Arr[0];
urlArr = Arr[1];
scriptArr = Arr[2];

function loadContent(content, check = false) {
    document.getElementById('content').style.display = 'none';
    document.getElementsByTagName('footer')[0].style.display = 'none';

    //use fetch API 
    fetch(`/content/${content}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            document.title = titleArr[content];

            if (scriptArr[content] != undefined) {
                let script = document.createElement('script');
                script.src = `/assets/js/custom/${content}.js`;
                document.body.appendChild(script);
            }

            window.history.pushState(null, null, urlArr[content]);
            document.getElementById('content').style.display = 'block';
            document.getElementsByTagName('footer')[0].style.display = 'block';
            AOS.init();
        });
}

function loadDetailProduct(id) {
    document.getElementById('content').style.display = 'none';
    document.getElementsByTagName('footer')[0].style.display = 'none';

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

            window.history.pushState(null, null, `/product/detail/${id}`);

            document.getElementById('content').style.display = 'block';
            document.getElementsByTagName('footer')[0].style.display = 'block';
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
    let url = urlShop(category, sortby, page, search);

    //fetch API
    fetch(`/content/shop/${category}/${sortby}/${page}/${search}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            document.title = titleArr['shop'];

            if (scriptArr['shop'] != undefined) {
                let script = document.createElement('script');
                script.src = scriptArr['shop'];
                document.body.appendChild(script);
            }

            window.history.pushState(null, null, url);
            AOS.init();
        });
}

//* Listen back & forward button to load content
window.addEventListener('popstate', function () {
    let url = new URL(window.location.href);
    let path = url.pathname;
    let id = path.replace('/', '');

    if (path == '' || path == '/') {
        id = 'home';
    } else if (path == '/shop/category') {
        id = 'shop';
    } else if (path.includes('/product/detail/')) {
        loadDetailProduct(path.replace('/product/detail/', ''));
        return;
    }
    loadContent(id);
});