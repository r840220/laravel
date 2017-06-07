/**
 * Created by admin on 2017/5/22.
 */
$(document).ready(function () {
    mall_main = new mall_main();
    $('#content').on('click', '.btn.btn-primary', function(){
        mall_main.add_cart($(this).data('id'));
    });
    console.log('test');
});

class mall_main{

    constructor(){
        this.url = 'http://127.0.0.1/laravel/public/index.php/';
        
    }

    add_cart(id, qty = 1){
        $.ajax({
            url: this.url + 'cart/add/' + id,
            data:{qty: qty},
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#shopping_cart').html('購物車(' + data.total_Qty + ')');

            }
        });
    }

    test(data){


    }
}