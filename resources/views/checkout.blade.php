@extends('layouts/app')

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
                        <td width="100%">'+data.name+'</td>\
                        <td>'+data.price+'</td>\
                        <td><input type="text" name="'+data.id+'" value="'+data.quantity+'"></td>\
                    </tr>')
                totalPrice += data.price*data.quantity;                
            }            
        }      
        $('#totalPrice').html(totalPrice+' $');   
    });
    
    

    $(document).on('click','.delete-btn', function () {
        // 此 id 為刪除按鈕的 data.id
        var id = $(this).data('id');

        cartList.forEach(element => {
            // console.log(element);
            if(element.id==id){
                // console.log(element);
                element.quantity = element.quantity - 1;
                totalPrice = totalPrice - element.price;
                $('#data-'+id).html(element.quantity);
                $('#totalPrice').html(totalPrice+' $'); 
            }
            // 如果 quantity 太少就隱藏
            if(element.quantity<=0){
                $('#tableRow-'+element.id).hide();
            }
        });      
        
        console.log(cartList);
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/product/checkout" method="get">
                <h1>Checking List</h1>
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
                        <input type="submit" class="btn btn-danger" value="結帳">
                    </div>                
                </div>
            </form>
            
        </div>
    </div>    
</div>
@endsection