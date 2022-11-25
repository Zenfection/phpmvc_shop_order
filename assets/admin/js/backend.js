/*
    Author: Zenfection
    Created: 2021-07-10 10:00:00
    Description: Xử lý các Form trong Admin, fetch API

    !----FUNCTION BỔ TRỢ-----
    * 1. nofity(type, icon, position, msg): Thông báo
    * 2. checkText(content, text, min, max): Kiểm tra độ dài của text
    * 3. checkNumber(content, number, min, max): Kiểm tra giá trị của number
    * 4. checkEmail(content, text): Kiểm tra định dạng email

    !----FUNCTION CHÍNH-----
    * 1. editProduct(id): Sửa sản phẩm
    * 2. editOrder(id): Sửa đơn hàng
*/

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

function checkText(content, text, min, max) {
    if (text.length < min) {
        notify('error', 'fa-duotone fa-input-text', 'center top', content + ' phải có ít nhất ' + min + ' ký tự');
        return false;
    } else if (text.length > max) {
        notify('error', 'fa-duotone fa-input-text', 'center top', content + ' phải có nhiều nhất ' + max + ' ký tự');
        return false;
    }
    return true;
}

function checkNumber(content, number, min, max) {
    if (number < min) {
        notify('error', 'fa-duotone fa-input-numeric', 'center top', content + 'phải lớn hơn ' + min);
        return false;
    } else if (number > max) {
        notify('error', 'fa-duotone fa-input-numeric', 'center top', content + 'phải nhỏ hơn ' + max);
        return false;
    }
    return true;
}

function checkEmail(content, text) {
    let regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    if (!regex.test(text)) {
        notify('error', 'fa-duotone fa-input-text', 'center top', content + ' không đúng định dạng');
        return false;
    }
    return true;
}

function checkEmpty(data = []) {
    let length = data.length;
    for (let i = 0; i < length; i++) {
        if (data[i] === '' || data[i] === null || data[i] === undefined)
            return false;
    }
    return true;
}


function editProduct(id) {
    //* Lấy dữ liệu từ form
    let name = document.querySelector('#editProductForm input[id=name]').value;
    let price = document.querySelector('#editProductForm input[id=price]').value;
    let quantity = document.querySelector('#editProductForm input[id=quantity]').value;
    let discount = document.querySelector('#editProductForm input[id=discount]').value;
    let description = tinymce.get("mytextarea").getContent({
        format: 'text'
    });

    //* Format all number
    price = parseInt(price.replace(/\./g, ''));
    quantity = parseInt(quantity);
    discount = parseInt(discount);

    //* Check input
    if (!checkEmpty([name, price, quantity, discount, description])) {
        notify('warning', 'fa-duotone fa-input-text', 'center top', 'Vui lòng nhập đầy đủ thông tin');
        return;
    }
    if (!checkText("Tên sản phẩm", name, 5, 100)) return;
    if (!checkText("Mô tả sản phẩm", description, 10, 1000)) return;
    if (!checkNumber("Giá sản phẩm", price, 1000, 100000000)) return;
    if (!checkNumber("Số lượng sản phẩm", quantity, 0, 1000)) return;
    if (!checkNumber("Giảm giá sản phẩm", discount, 0, 100)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('name', name);
    data.append('price', price);
    data.append('quantity', quantity);
    data.append('discount', discount);
    data.append('description', description);

    //* fetch POST
    fetch('/admin/product/edit/' + id, {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
                data = JSON.parse(data);
                let msg = data.msg;
                notify(msg['type'], msg['icon'], msg['position'], msg['content']);
            } catch (e) {
                notify('error', 'fa-duotone fa-server', 'center top', 'Đã xảy ra lỗi server');
            }
        })
        .catch(err => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        })
}

function editOrder(id) {
    //* Lấy dữ liệu từ form
    let name_customer = document.querySelector('#editOrderForm input[id=name_customer]').value;
    let email_customer = document.querySelector('#editOrderForm input[id=email_customer]').value;
    let phone_customer = document.querySelector('#editOrderForm input[id=phone_customer]').value;
    let province = document.querySelector('#editOrderForm select[id=province]').value;
    let city = document.querySelector('#editOrderForm select[id=city]').value;
    let ward = document.querySelector('#editOrderForm select[id=ward]').value;
    let address = document.querySelector('#editOrderForm input[id=address]').value;
    let status = document.querySelector('#editOrderForm select[id=status]').value;

    //* Check dữ liệu
    if (!checkEmpty([name_customer, email_customer, phone_customer, province, city, ward, address, status])) {
        notify('error', 'fa-duotone fa-pen-field', 'center top', 'Vui lòng nhập đầy đủ thông tin');
        return;
    }
    if (!checkText("Tên khách hàng", name_customer, 5, 100)) return;
    if (!checkEmail("Email khách hàng", email_customer)) return;
    if (!checkText("Số điện thoại khách hàng", phone_customer, 10, 11)) return;
    if (!checkText("Địa chỉ", address, 5, 255)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('name_customer', name_customer);
    data.append('email_customer', email_customer);
    data.append('phone_customer', phone_customer);
    data.append('province_customer', province);
    data.append('city_customer', city);
    data.append('ward_customer', ward);
    data.append('address_customer', address);
    data.append('status', status);

    //* fetch POST
    fetch('/admin/order/edit/' + id, {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
                data = JSON.parse(data);
                let msg = data.msg;
                notify(msg['type'], msg['icon'], msg['position'], msg['content']);
            } catch (e) {
                notify('error', 'fa-duotone fa-server', 'center top', 'Đã xảy ra lỗi server');
            }
        })
        .catch(err => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        })
}

function addNewProduct() {
    let name = document.querySelector('#addNewProductForm input[id=name]').value;
    let description = tinymce.get("mytextarea").getContent({
        format: 'text'
    });
    let price = document.querySelector('#addNewProductForm input[id=price]').value;
    let quantity = document.querySelector('#addNewProductForm input[id=quantity]').value;
    let discount = document.querySelector('#addNewProductForm input[id=discount]').value;
    let ranking = document.querySelector('#addNewProductForm input[id=ranking]').value;
    let category = document.querySelector('#addNewProductForm select[id=category]').value;

    // ! Lỗi không thể thả ảnh
    let image = document.querySelector('#addNewProductForm input[id=image-uploadify]').files[0];


    //* Format all number
    price = parseInt(price.replace(/\./g, ''));
    quantity = parseInt(quantity);
    discount = parseInt(discount);
    ranking = parseInt(ranking);

    console.log(name, description, price, quantity, discount, ranking, category, image);

    //* Check Valid Data
    if (!checkEmpty([name, description, price, quantity, discount, ranking, category, image])) {
        notify('warning', 'fa-duotone fa-pen-field', 'center top', 'Vui lòng nhập đầy đủ thông tin');
        return;
    }
    
    if (!checkText("Tên sản phẩm", name, 5, 100)) return;
    if (!checkText("Mô tả sản phẩm", description, 5, 255)) return;
    if (!checkNumber("Giá sản phẩm", price, 1000, 100000000)) return;
    if (!checkNumber("Số lượng sản phẩm", quantity, 0, 1000)) return;
    if (!checkNumber("Giảm giá sản phẩm", discount, 0, 100)) return;
    if (!checkNumber("Số sao sản phẩm", ranking, 0, 10)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('name', name);
    data.append('description', description);
    data.append('price', price);
    data.append('quantity', quantity);
    data.append('discount', discount);
    data.append('ranking', ranking);
    data.append('category', category);
    data.append('image', image);

    //* fetch POST
    fetch('/admin/product/add_new_product', {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
                data = JSON.parse(data);
                let msg = data.msg;
                notify(msg['type'], msg['icon'], msg['position'], msg['content']);
                if(data['status'] == 'success'){
                    setTimeout(() => {
                        window.location.href = '/admin/dashboard/product';
                    }, 1500);
                }
            } catch (e) {
                notify('error', 'fa-duotone fa-server', 'center top', 'Đã xảy ra lỗi server');
            }
        })
        .catch(err => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        })
}