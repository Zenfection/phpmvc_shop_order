$(function () {
    var table = $('#list_customer').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print'],
    });
    table.buttons().container().appendTo('#list_customer_wrapper .col-md-6:eq(0)');
    
    $(document).keydown('#list_customer', function (e) {
        switch (e.which) {
            case 37: //left arrow key
                document.querySelector('.paginate_button.page-item.previous').click();
                break;
            case 39: //right arrow key
                document.querySelector('.paginate_button.page-item.next').click();
                break;
        }
    })
})
