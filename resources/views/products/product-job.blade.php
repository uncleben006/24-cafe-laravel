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

    $.getJSON('/api/products', function(p_json) {
        console.log(p_json)
        for( var index in p_json ) {
            var data = p_json[index];
            $('#tbody').append('\
                <tr>\
                    <td>'+data.id+'</td>\
                    <td>'+data.name+'</td>\
                    <td>'+data.description+'</td>\
                    <td>'+data.price+'</td>\
                    <td id="image-'+data.id+'" style="max-width: 120px;"></td>\
                    <td>\
                        <button data-id="'+data.id+'" class="btn btn-primary btn-edit-product">編輯</button>\
                        <button data-id="'+data.id+'" class="btn btn-theme-tertiary btn-delete-product">刪除</button>\
                    </td>\
                </tr>\
            ');

            $.getJSON('/api/products/'+data.id+'/images', function (i_json) {
                console.log(i_json)
                var domain = window.location.origin;
                image_path = [];                
                i_json.forEach(function (e) {
                    image_path.push(domain+'/storage/images/'+e.filename);
                    $('#image-'+e.product_id).append('<a href="'+domain+'/storage/images/'+e.product_id+'/'+e.filename+'" target="_blank">'+e.filename+'</a>、');
                });            
                // console.log(image_path);
            })
        }
    });       
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="float-left">商品列表</h1>
            <a href="/products/job/new/" class="btn btn-primary float-right">新增產品</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名稱</th>
                        <th>產品敘述</th>                        
                        <th>價格</th>
                        <th>產品圖</th>
                        <th style="min-width: 150px;">編輯產品</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
    </div>    
</div>
@endsection