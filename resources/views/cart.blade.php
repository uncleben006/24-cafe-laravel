@extends('layouts/app')

@section('style')
<style>
.delete-btn {
    position: absolute; 
    top: 0; 
    right: 0; 
    font-size: 0.5em; 
    padding: 0 0.5em; 
    background: red; 
    color: white;   
    font-weight: bold;
}
</style>
@endsection

@section('script')
<script>
$(function() {    
    var cartList = [];
    var totalPrice = 0;
    $.getJSON('/products/list-cart/', function(json) {
        // console.log(json);
        cartList = json;       
        console.log(cartList);
        for( var index in cartList ) {
            var data = cartList[index];       
            // 如果data是存在的，才會產生產品資料庫
            if(data){
                $('#tbody').append('\
                    <tr id="tableRow-'+data.id+'">\
                        <td>'+data.id+'</td>\
                        <td>'+data.name+'</td>\
                        <td>'+data.price+'</td>\
                        <td style="position: relative">\
                            <div id="data-'+data.id+'">'+data.quantity+'</div>\
                            <button class="delete-btn" data-id="'+ data.id +'">X</button>\
                        </td>\
                    </tr>\
                ');
                totalPrice += data.price*data.quantity;
                
            }            
        }      
        $('#totalPrice').html(totalPrice+' $');   
    });
    
    

    $(document).on('click','.delete-btn', function () {
        // 此 id 為刪除按鈕的 data.id，
        // 但 data.id 是資料庫自動產生的流水號，是從 1 開始，
        // 所以如果要用它來查詢陣列就要 -1，變成從 0 開始
        var id = $(this).data('id');
        var array_id = id-1;

        // 當 X 按鈕被按則少 1，並改變數量與總價顯示 
        cartList[array_id].quantity = cartList[array_id].quantity-1;
        totalPrice = totalPrice-cartList[array_id].price;
        $('#data-'+id).html(cartList[array_id].quantity);
        $('#totalPrice').html(totalPrice+' $'); 

        // 如果 quantity 太少就隱藏
        if(cartList[array_id].quantity<=0){
            $('#tableRow-'+id).hide();
        }
        console.log(cartList);
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>My Shopping Cart</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>商品名稱</th>
                        <th>價格</th>
                        <th>數量</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <a href="/products/" class="btn btn-secondary">繼續購物</a>
                <div class="d-flex align-items-center">
                    <div id="totalPrice"class="px-3">$</div>
                    <a href="#" class="btn btn-danger">結帳</a>
                </div>                
            </div>
            
        </div>
    </div>    
</div>
@endsection