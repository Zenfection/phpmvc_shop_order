function addProductCart(id, qty) {
    let insert = true;
    if (qty == "qty") {
        qty = parseInt(document.querySelector('.cart-plus-minus-box').value);
    }
    fetch('/cart/add/' + id + '/' + qty)
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
}


function deleteProductCart(id) {
    fetch('/cart/delete/' + id)
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

                    if(window.location.pathname == "/viewcart"){
                        document.querySelector('#total-money').textContent = data.total_money;
                        document.querySelector('#total-bill').textContent = data.total_money;
                        $('#view_cart_product' + id).hide('normal', function () {
                            $(this).remove();
                        })
                    }
                }
            } catch (e) {}
        })
}

function clearProductCart(){
    fetch('/cart/clear')
        .then((response) => response.text())
        .then((data) => {
            try {
                data = JSON.parse(data);
                if(data.status == 'clear'){
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


$(function () {
    /* Function
    ------------------------- */
    //* check Logged
    function checkLoged() {
        return document.querySelectorAll('#logged').length == 0;
    }
    
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

    // SHOP
    //* Search Product
    function searchProduct() {
        let sortby = $("option:selected", '.nice-select').val();
        let category = $('.sidebar-list li a.active').attr('id');
        let keyword = $('#searchFilterProduct').val();

        filterShop(category, sortby, 1, keyword);
    }
    $(document).on("keypress", "#searchFilterProduct", function (e) {
        if (e.which == 13) {
            searchProduct();
        }
    });
    $(document).on("click", ".search-box button", function () {
        searchProduct();
    });

    //* Pagination Product
    //* choose num page paginator page
    function choosePage(id) {
        let sortby = $("option:selected", '.nice-select').val();
        let category = $('.sidebar-list li a.active').attr('id');
        let keyword = $('.search-box button').siblings('input').val();

        filterShop(category, sortby, id, keyword);
    }

    $(document).keydown('.shop_wrapper grid_4', function (e) {
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

    $(document).on('click', '.page-item a[aria-label="Next"]', function () {
        let id = parseInt($(this).attr('name').split('page=')[1]);
        choosePage(id + 1);
    });
    $(document).on('click', '.page-item a[aria-label="Prev"]', function () {
        let id = parseInt($(this).attr('name').split('page=')[1]);
        choosePage(id - 1);
    });
    $(document).on('click', '#page-choose', function () {
        let id = parseInt($(this).attr('name').split('page=')[1]);
        choosePage(id);
    });
});