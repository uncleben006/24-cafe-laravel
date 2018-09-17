@extends('layouts/app')

@section('products-admin-nav','active')

@section('script')
<script>
$(function() {    

    // 這種形式沒辦法綁定動態產生的 html
    $('.btn-add-cart').click(function () {
        alert('click');
    })

    $(document).on('click','.btn-edit-product', function () {
        var id = $(this).data('id');
        window.location = '/products/'+id+'/edit/';
    });
    $(document).on('click','.btn-delete-product', function () {
        var id = $(this).data('id');
        window.location = '/products/'+id+'/delete/';
    });

    $.getJSON('/api/products', function(json) {
        console.log(json)
        for( var index in json ) {
            var data = json[index];
            $('#tbody').append('\
                <tr>\
                    <td>'+data.id+'</td>\
                    <td>'+data.name+'</td>\
                    <td>'+data.price+'</td>\
                    <td>'+data.description+'</td>\
                    <td>\
                        <button data-id="'+data.id+'" class="btn btn-primary btn-edit-product">編輯</button>\
                        <button data-id="'+data.id+'" class="btn btn-theme-tertiary btn-delete-product">刪除</button>\
                    </td>\
                    <td><a href="'+data.image_path+'" target="_blank">'+data.image_name+'</a></td>\
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
            <h1 class="float-left">商品列表</h1>
            <a href="/products/job/new/" class="btn btn-primary float-right">新增產品</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名稱</th>
                        <th>價格</th>
                        <th>產品敘述</th>
                        <th>編輯產品</th>
                        <th>產品圖</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
    </div>    
</div>
@endsection