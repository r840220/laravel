/**
 * Created by admin on 2017/5/22.
 */
$(document).ready(function () {
    $.fn.exists = function () {
        return this.length !== 0;
    }
    mall_main = new mall_main();


    $('#content').on('click', '.btn.btn-primary', function(){
        mall_main.add_cart($(this).data('id'), 1, $("#csrf_token").html());
    });

    $('#search_li ul').on('click', 'a', function(){
        mall_main.change_type($(this).html(), $(this).attr('data'));
    });

    if($('#messages').exists()){
       alert($('#messages').text().trim());
    }
});

class mall_main{

    constructor(){
        this.url = '/laravel/public/index.php/';
        
    }

    add_cart(id, qty = 1, csrf){
        $.ajax({
            url: this.url + 'cart',
            data:{qty: qty, id: id, _token: csrf},
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#shopping_cart').html('購物車(' + data.total_Qty + ')');

            }
        });
    }

    change_type(type, value){
        $("#search_type").val(value);
        $('#search_type_current').html(type + '<span class = "caret"></span>');
    }

    test(data){


    }
}