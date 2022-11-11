$(function () {
    /* Function
    ------------------------- */
    // *Popup Notification
    function notify(type, icon, position, msg) {
        Lobibox.notify(type, {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: icon,
            continueDelayOnInactiveTab: false,
            position: position,
            msg: msg
        });
    }
    //* check Logged
    function checkLoged() {
        return document.querySelectorAll('#logged').length == 0;
    }

    //* Check product exist or not in cart by id
    function checkProductExistCart(id) {
        let check = $(".cart-product-wrapper .cart-product-inner");
        for (let i = 0; i < check.length; i++) {
            if (check[i].id == "product_id" + id) return true;
        }
        return false;
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

    //* Add, Remove Product to Cart
    function getQtyProductCart(id) {
        let amount = parseInt(
            $("#quantity" + id)
            .text()
            .replace(/\D/g, "")
        );
        return amount;
    };

    function addProduct(id, qty) {
        let insert = true;
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

                    $("#product_id" + id).hide().fadeIn();
                }
            })
    }

    document.querySelectorAll(".add-to-cart").forEach((item) => {
        item.addEventListener("click", function () {
            if (!checkLoged()) {
                notify('warning', 'fa-duotone fa-cart-circle-xmark', 'right', 'Vui lòng đăng nhập để mua hàng');
                return;
            }
            let id = parseInt(this.getAttribute('id').replace('product', ''));
            let qty = parseInt(document.querySelector('.cart-plus-minus-box').value);
            if (isNaN(qty)) qty = 1;
            addProduct(id, qty);
        });

    });

    document.querySelectorAll('a#plus_product').forEach((item) => {
        item.addEventListener('click', function () {
            if (!checkLoged()) {
                notify('warning', 'fa-duotone fa-cart-circle-xmark', 'right', 'Vui lòng đăng nhập để mua hàng');
                return;
            }
            let id = parseInt(this.parentElement.getAttribute('id').replace('wrapper', ''));
            let qty = 1;
            addProduct(id, qty);
        })
    });



    /*-------------------------
        Ajax Cart View
    ---------------------------*/
    $(document).on('click', '.pro-remove a', function () {
        let id = parseInt($(this).parent().attr('id').replace('product', ''));
        let money = parseFloat($('#product_id' + id + ' .price .new').text().replace('$', ''));
        let total = parseFloat($('#totalmoney').text().replace('$', ''));
        let amount = parseInt($('#count-cart').text());
        let qty = parseInt($('#quantity' + id).text().replace(/\D/g, ''));
        console.log(money, total, amount, qty);
        $('#view_cart_product' + id).fadeOut('normal', function () {
            $(this).remove();
        });
        let totalMoney = (total - money * qty).toFixed(2);
        console.log(totalMoney);
        $('#totalmoney').text(totalMoney + '$');
        $('#count-cart').text(amount - 1);
        $('#product_id' + id).hide('normal', function () {
            $(this).remove();
        });

        $.ajax({
            type: "post",
            url: "/cart/delete/" + id,
        });
    });

    $(document).on('click', '#clear-cart', function () {
        $('#table-cart').hide('normal', function () {
            $(this).remove();
        });
        $('.cart-product-wrapper').children().hide('normal', function () {
            $(this).remove();
        });
        $('#count-cart').text('0');
        $('#totalmoney').text('0.00$');
        $('#total-money').text('0.00$');
        $('#total-bill').text('0.00$');
        $.ajax({
            type: 'post',
            url: '/cart/clear',
        });
    })


    /*-------------------------
        Ajax Remove Product Cart 
    ---------------------------*/
    $(document).on('click', '.remove-cart', function () {
        let id = $(this).attr('id').replace('product', '');
        $('#product_id' + id).fadeOut('normal', function () {
            let amount = parseInt($('#count-cart').text());
            $('#count-cart').text(amount - 1);
            let money = parseFloat($('#product_id' + id + " .price .new").text().replace('$', ''));
            let total = parseFloat($('#totalmoney').text().replace('$', ''));
            let qty = parseInt($('#quantity' + id).text().replace(/\D/g, ''));
            let totalMoney = (total - money * qty).toFixed(2);
            $('#totalmoney').text(totalMoney + '$');
            $(this).remove();
        });
        $.ajax({
            type: 'post',
            url: '/cart/delete/' + id,
            data: {
                delete_id: id
            },
        });
    });

});