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

    let script = document.createElement('script');
    script.src = `/assets/js/custom/${content}.js`;

    // ajax load content by javascript
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
            
            if(scriptArr[content] != undefined){
                let script = document.createElement('script');
                script.src = scriptArr[content];
                document.body.appendChild(script);
            }

            document.getElementById('content').style.display = 'block';
            document.getElementsByTagName('footer')[0].style.display = 'block';
            document.getElementsByTagName('head')[0].appendChild(script);

            document.title = titleArr[content];
            if(window.location.pathname != urlArr[content]){
                window.history.pushState(null, null, urlArr[content]);
            }
            AOS.init();
        }
    };
    xhttp.open("POST", "/content/" + content, true);
    xhttp.send();
}

function loadDetailProduct(id) {
    document.getElementById('content').style.display = 'none';
    document.getElementsByTagName('footer')[0].style.display = 'none';
    
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
            document.getElementById('content').style.display = 'block';
            document.getElementsByTagName('footer')[0].style.display = 'block';
            
            if(scriptArr['product/detail'] != undefined){
                let script = document.createElement('script');
                script.src = scriptArr['product/detail'];
                document.body.appendChild(script);
            }

            document.title = titleArr['Chi tiết sản phẩm'];
            
            window.history.pushState(null, null, `/product/detail/${id}`);

            AOS.init();
        }
    }
    xhttp.open("POST", "/content/product_detail/" + id, true);
    xhttp.send();
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

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
            
            if(scriptArr['shop'] != undefined){
                let script = document.createElement('script');
                script.src = scriptArr['shop'];
                document.body.appendChild(script);
            }

            document.title = titleArr['shop'];
            window.history.pushState(null, null, url);

            AOS.init();
        }
    }
    xhttp.open("POST", "/content/shop/" + category + '/' + sortby + '/' + page + '/' + search, true);
    xhttp.send();
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