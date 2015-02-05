$( document ).ready(function() {
    $('#form1').validate({
        rules: {
            title: {
                required: true,
            },
            post: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Zadejte titulek"
            },
            post: {
                required: "Zadejte obsah"
            }
        }
    });
});