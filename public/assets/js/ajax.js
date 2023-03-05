$(() => {
    //Варинт по нажатию кнопки
    $(document).on('click', '.input-search-button', () => {
        $.ajax({
            url: '/api/info/get',
            type: 'POST',
            cache: false,
            data: {
                'value': $('.input-email-field').val(),
            },
            success: function (response) {
                switch (typeof JSON.parse(response)) {
                    case "object":
                        $(".alert").html('')
                        $(".success").html(`${JSON.parse(response).email} - ${JSON.parse(response).name} ${JSON.parse(response).sname} [${JSON.parse(response).id}]`)
                        break;
                    case "string":
                        $(".success").html('')
                        $(".alert").html(JSON.parse(response))
                        break;
                }
            }
        })
    })

    //Вариант при каждом нажатии клавиши
    $('.input-email-field').on('keyup', () => {
        $(".alert").html('')
        $(".success").html('')
        $.ajax({
            url: '/api/info/get-key',
            type: 'POST',
            cache: false,
            data: {
                'value': $('.input-email-field').val(),
            },
            success: function (response) {
                switch (typeof JSON.parse(response)) {
                    case "object":
                        JSON.parse(response).forEach(item => $(".success").append(`${item.email} - ${item.name} ${item.sname} [${item.id}] <br/>`))
                        break;
                    case "string":
                        console.log(JSON.parse(response))
                        $(".alert").html(JSON.parse(response))
                        break;
                }
            }
        })
    })
})