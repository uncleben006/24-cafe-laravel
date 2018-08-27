@extends('layouts/app')

@section('script')
<script>
$(function() {    

    // 這種形式沒辦法綁定動態產生的 html
    // $('.btn-add-cart').click(function () {
    //     alert('click');
    // })

    $(document).on('click','.btn-add-cart', function () {
        var id = $(this).data('id');
        $.getJSON('/products/add-cart/'+id, function (json) {
            if(json.status){
                alert('加入購物車成功');
            }
        })
    });

    $.getJSON('/api/products', function(json) {
        for( var index in json ) {
            var data = json[index];
            $('#tbody').append('\
                <tr>\
                    <td>'+data.id+'</td>\
                    <td>'+data.name+'</td>\
                    <td>'+data.price+'</td>\
                    <td><button data-id="'+data.id+'" class="btn btn-sm btn-primary btn-add-cart">加入購物車</button></td>\
                </tr>\
            ');
        }
    });       
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>All Products</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>商品名稱</th>
                        <th>價格</th>
                        <th>加入購物車</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            <a href="/products/cart" class="btn btn-primary">結帳</a>
        </div>
    </div>    
</div>
@endsection