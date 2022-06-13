import './bootstrap';

$(function(){
    $('body').on('click', '.btn-form-delete', function(){
        if(confirm($(this).data('body'))){
            $(this).find('form')[0].submit();
        }
    });
})