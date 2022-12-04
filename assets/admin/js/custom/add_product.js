$(function () {
    var stars = new StarRating('.star-rating', {
        maxStars: 10,
        halfStar: true,
        tooltip: 'Chọn Đánh Giá',
        classNames: {
            active: 'gl-active',
            base: 'gl-star-rating',
            selected: 'gl-selected',
        },
    });

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