$(document).ready(function() {

    $('#category_id').change(function() {

        let currentCategory = $(this).val();
        let categoryBlock = $('#category_properties');

        let page = $('#data-page').attr('data-page'); // create или edit

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //если не передать токен, то возвращается 419 ошибка
            }
        });

        $.ajax({
            type: "POST",
            url: '/admin/ajax/category-properties',
            //contentType: "application/json", // какой тип данных отправляем
            dataType: "html", //возвращаемые данные
            data: {'currentCategory' : currentCategory, 'dataPage' : page}, // что посылаем в POST
            success: function(result) {
                categoryBlock.html(result);
            }
        });

    })

});
