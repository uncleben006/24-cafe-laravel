@extends('layouts/app')

@section('shopping-cart-nav')
active
@endsection

@section('style')
<style>
input {
    width: 100%;
    height: 100%;
    text-align: center;
}
.table td {
    padding: 0 2em;
    text-align: center;
}
.table td:last-child {
    padding: 0;
}
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
        console.log(json);
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
                        <td width="75"><input type="number" min="0" name="'+data.id+'" value="'+data.quantity+'"></td>\
                    </tr>')
                totalPrice += data.price*data.quantity;                
            }            
        }      
        $('#totalPrice').html(totalPrice+' $');   
    });
    
    
    $(document).on('click','.btn-submit', function (event) {
        var user = '{{ isset(Auth::user()->name)?Auth::user()->name: NULL }}';
        // console.log(user)
        if(!user){
            event.preventDefault()
            var login = confirm(" 您尚未登入，請先登入才能結帳 ")
        }
        // console.log(login)
        if(login){
            window.location = '/login/'
        }        
    })
});
</script>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="../products/checkout" method="post">
                <h1>My Shopping Cart</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                        <div id="totalPrice" class="px-3" style="min-width: 200px; text-align: right;">$</div>                        
                        <input type="submit" class="btn btn-danger btn-submit" value="結帳">
                    </div>                
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection