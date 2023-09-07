$(document).ready(function () {

    $('.item-quantity').on('change',function()
    {
        $.ajax({
            url: "/cart/" + $(this).data('id'),
            type: "PUT",
            data: {
                quantity: $(this).val(),
                _token:csrf_token
            },
            success: function (data) {
               console.log(data)
            },
        });

    });


    $('.delete').on('click',function()
    {
        $.ajax({
            url: "/cart/" + $(this).data('delete'),
            type: "DELETE",
            data: {
                _token:csrf_token
            },
            success: function (response) {

               //$(this).remove();
               $(`#${$(this).data('delete')}`).remove();
            },
        });
    })

      


    

});