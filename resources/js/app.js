import './bootstrap';

$(function(){
    $('body').on('click', '.btn-form-delete', function(){
        const el = $(this);

        Swal.fire({
            title: el.data('title'),
            text: el.data('body'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: el.data('yes'),
            cancelButtonText: el.data('not'),
        }).then(function (result) {
            if (result.value) {
                $(el).find('form')[0].submit();
            }
        });
    });
})