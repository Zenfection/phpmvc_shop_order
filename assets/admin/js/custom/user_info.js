var table = $('#list_order_user').DataTable({
    select: true,
    pageLength: 5,
    lengthMenu: [5, 10, 20, 50, 100],
    language: {
        url: window.location.origin + '/assets/admin/plugins/datatable/dataTables.vietnam.json'
    }
});
table.buttons().container().appendTo('#list_order_user_wrapper .col-md-6:eq(0)');

$(document).keydown('#list_order_user', function (e) {
    switch (e.which) {
        case 37: //left arrow key
            document.querySelector('.paginate_button.page-item.previous').click();
            break;
        case 39: //right arrow key
            document.querySelector('.paginate_button.page-item.next').click();
            break;
    }
})
