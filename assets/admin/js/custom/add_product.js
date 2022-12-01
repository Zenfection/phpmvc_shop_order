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
        // stars: function (el, item, index) {
        //     el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
        // },

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