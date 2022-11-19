//* Edit Product
function editProduct() {
    var id = window.location.pathname.replace('/admin/product/detail/', '');
    let name = document.querySelector('#editProductForm input[id=name]').value;
    let price = document.querySelector('#editProductForm input[id=price]').value;
    let quantity = document.querySelector('#editProductForm input[id=quantity]').value;
    let discount = document.querySelector('#editProductForm input[id=discount]').value;
    let description = tinymce.get("mytextarea").getContent({
        format: 'text'
    });
    // let description = document.querySelector('#tinymce').textContent;

    //! format price => remove , and .
    price = price.replace(/\./g, '');

    // console.log(name, price, quantity, discount, description);
    if (name == '' || price == '' || quantity == '' || discount == '' || description == '') {
        return;
    }

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
            console.log(data);
        })
        .catch(err => {
            console.log(err);
        })
}
// //fetch post method
// document.querySelector('#submitEditProduct').removeAttribute('onclick');
// document.querySelector('#submitEditProduct').setAttribute('type', 'submit').click();