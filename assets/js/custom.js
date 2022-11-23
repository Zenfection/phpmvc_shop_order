function addProductCart(id, qty) {
    let insert = true;
    if (qty == "qty") {
        qty = parseInt(document.querySelector('.cart-plus-minus-box').value);
    }

    //* Tạo dữ liệu post
    let data = new FormData();
    data.append('id', id);
    data.append('qty', qty);

    fetch('/cart/add_product', {
            body: data,
            method: 'POST'
        })
        .then((response) => response.text())
        .then((data) => {
            try {
                data = JSON.parse(data);
                if (data.status == 'update') {
                    insert = false;
                    document.querySelector('#quantity' + id + " > strong").textContent = data.total_qty;
                    document.querySelector('#totalmoney').textContent = data.total_money;
                }
            } catch (e) {}

            if (insert) {
                let total_money = document.querySelector('#totalmoney').textContent.replace(/\D/g, '');
                total_money = parseInt(total_money);

                $(".cart-product-wrapper").prepend(data);

                let newprice = document.querySelector('#product_id' + id + ' span.new').textContent.replace(/\D/g, '');

                total_money += (qty * parseInt(newprice));
                //number format
                total_money = total_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                document.querySelector('#totalmoney').textContent = total_money + 'đ';

                let count_cart = document.querySelector('#count-cart').textContent;
                document.querySelector('#count-cart').textContent = parseInt(count_cart) + 1;
                $("#product_id" + id).hide().fadeIn();
            }
        })
        .catch((err) => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        });
}

function deleteProductCart(id, qty = 'all') {
    //* Tạo dữ liệu post
    let data = new FormData();
    if (qty == 'all') {
        data.append('id', id);
    } else {
        data.append('id', id);
        data.append('qty', qty);
    }

    fetch('/cart/delete_product/', {
            body: data,
            method: 'POST'
        })
        .then((response) => response.text())
        .then((data) => {
            try {
                data = JSON.parse(data);
                if (data.status == 'delete') {
                    $('#product_id' + id).hide('normal', function () {
                        $(this).remove();
                    });
                    document.querySelector('#totalmoney').textContent = data.total_money;
                    document.querySelector('#count-cart').textContent = data.total_qty;

                    if (window.location.pathname == "/viewcart") {
                        document.querySelector('#total-money').textContent = data.total_money;
                        document.querySelector('#total-bill').textContent = data.total_money;
                        $('#view_cart_product' + id).hide('normal', function () {
                            $(this).remove();
                        })
                    }
                } else if(data.status == 'update'){
                    document.querySelector('#totalmoney').textContent = data.total_money;
                    document.querySelector('#quantity' + id + " > strong").textContent = data.total_qty;
                    if (window.location.pathname == "/viewcart") {
                        document.querySelector('#total-money').textContent = data.total_money;
                        document.querySelector('#total-bill').textContent = data.total_money;
                    }
                }
            } catch (e) {
                notify('error', 'fa-duotone fa-server', 'center top', e);
            }
        })
        .catch((err) => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        });
}

function clearProductCart() {
    fetch('/cart/clear')
        .then((response) => response.text())
        .then((data) => {
            try {
                data = JSON.parse(data);
                if (data.status == 'clear') {
                    $('#table-cart').hide('normal', function () {
                        $(this).remove();
                    });
                    $('.cart-product-wrapper').children().hide('normal', function () {
                        $(this).remove();
                    });
                    document.querySelector('#count-cart').textContent = 0;
                    document.querySelector('#totalmoney').textContent = '0đ';
                    document.querySelector('#total-money').textContent = '0đ';
                    document.querySelector('#total-bill').textContent = '0đ';
                }
            } catch (e) {}
        })
}

//* Search Product
function searchProduct() {
    let sortby = $("option:selected", '.nice-select').val();
    let category = $('.sidebar-list li a.active').attr('id');
    let keyword = $('#searchFilterProduct').val();

    filterShop(category, sortby, 1, keyword);
}


//* Pagination Product
function choosePage(id) {
    let sortby = $("option:selected", '.nice-select').val();
    let category = $('.sidebar-list li a.active').attr('id');
    let keyword = $('.search-box button').siblings('input').val();

    filterShop(category, sortby, id, keyword);
}


function soldOutRibbon() {
    $('.ribbon').parents('.product-inner').css('opacity', '0.5');
    $('.ribbon').parents('.prsoduct-inner').find('.action-wrapper').remove();
    $('.ribbon').parents('.product-inner').find('a.image').removeAttr('onclick');
}

$(function () {
    //* search Product by name, listener via Enter
    // $(document).on("keypress", "#searchProduct", function (e) {
    //     if (e.which == 13) {
    //         let search = $("#searchProduct input").val();
    //         $.ajax({
    //             type: "post",
    //             url: "./shop.php",
    //             data: {
    //                 search: search,
    //             },
    //             success: function (data) {
    //                 $("#content").html(data);
    //                 AOS.init();
    //             },
    //         });
    //     }
    // });

    /*-------------------------
        Ajax Load Data Nagivation
    ---------------------------*/
    $(document).keydown('.shop_wrapp', function (e) {
        let next = $('.page-item a[aria-label="Next"]');
        let prev = $('.page-item a[aria-label="Prev"]');
        switch (e.which) {
            case 37: //left arrow key
                if (prev.length > 0) {
                    let id = parseInt($(prev).attr('name').split('page=')[1]);
                    choosePage(id - 1);
                }
                break;
            case 39: //right arrow key
                if (next.length > 0) {
                    let id = parseInt($(next).attr('name').split('page=')[1]);
                    choosePage(id + 1);
                }
                break;
        }
    })
});