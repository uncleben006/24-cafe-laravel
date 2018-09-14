@extends('layouts/app')

@section('products-nav')
active
@endsection

@section('script')
<script>
$(function() {    

    // 這種形式沒辦法綁定動態產生的 html
    // $('.btn-add-cart').click(function () {
    //     alert('click');
    // })

    $(document).on('click','.btn-add-cart', function () {
        var id = $(this).data('id');
        window.location = '/products/'+id+'/edit/';
    });

    $.getJSON('/api/products', function(json) {
        for( var index in json ) {
            var data = json[index];
            $('#tbody').append('\
                <tr>\
                    <td>'+data.id+'</td>\
                    <td>'+data.name+'</td>\
                    <td>'+data.price+'</td>\
                    <td><button data-id="'+data.id+'" class="btn btn-theme-tertiary btn-sm btn-add-cart">編輯產品</button></td>\
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
            <h1 class="float-left">產品列表</h1>
            <button class="btn btn-primary float-right">新增產品</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>商品名稱</th>
                        <th>價格</th>
                        <th>編輯產品</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <a href="/products/cart" class="btn btn-primary">結帳</a>
            </div>            
        </div>
    </div>    
</div>
@endsection