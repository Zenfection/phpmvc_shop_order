$(function () {
    $('#image-uploadify').imageuploadify();

    var nice_select = document.querySelector('.nice-select');
    NiceSelect.bind(nice_select);

    document.querySelector('.nice-select .current').textContent = 'Chọn loại thức ăn';

    tinymce.remove();
    tinymce.init({
        selector: '#mytextarea',
        height: "200",
        toolbar: false
    });
});