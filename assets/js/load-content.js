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
    }
];
titleArr = Arr[0];
urlArr = Arr[1];

function scroolTop() {
    window.scrollTo(0, 0);
}

function loadContent(content, check = false) {
    //$('#content').hide();
    //$('footer').hide();

    $.ajax({
        url: '/content/' + content,
        type: 'POST',
        success: function (data) {
            document.title = titleArr[content];
            if (window.location.pathname != urlArr[content]) {
                window.history.pushState(null, null, urlArr[content]);
            }
            $('#content').html(data);
            //$('#content').show();
            //$('footer').show();
            AOS.init();
        }
    });
}

function loadDetailProduct(id) {
    $('#content').hide();
    $('footer').hide();

    $.ajax({
        url: '/content/product_detail/' + id,
        type: 'POST',
        success: function (data) {
            document.title = 'Chi tiết sản phẩm';

            window.history.pushState(null, null, '/product/detail/' + id);
            $('#content').html(data);
            $('#content').show();
            $('#content').show();
            AOS.init();
        }
    })
}

function urlShop(category, sortby, page, search) {
    let url;
    if(category == 'all' && sortby == 'default' && page == 1 && search == ''){
        url = '/shop/category';
    } else {
        url = `/shop/category/${category}/${sortby}/${page}/${search}`;
    }
    return url;
}

function filterShop(category = 'all', sortby = 'default', page = 1, search = '') {
    let url = urlShop(category, sortby, page, search);
    $.ajax({
        url: `/content/filter_shop/${category}/${sortby}/${page}/${search}`,
        type: 'POST',
        success: function (data) {
            window.history.pushState(null, null, url);
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