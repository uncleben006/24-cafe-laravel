@extends('layouts/app')

@section('products-admin-nav','active')

@section('style')
<style>
/* Tables
================================== */
.Rtable {
    display: flex;
    flex-wrap: wrap;
    margin: 0 0 3em 0;
    padding: 0px;
}
.Rtable-cell {
    box-sizing: border-box;
    flex-grow: 1;
    width: 100%; 
    padding: 0.1rem 0.25rem;
    overflow: hidden; 
    list-style: none;
    border: solid 1px black;
    background: fade(slategrey,20%);
    > h1, > h2, > h3, > h4, > h5, > h6 { margin: 0; }
}
.Rtable-cell hr {
    margin: 5px auto;
}

/* Table column sizing
================================== */
.Rtable--2cols > .Rtable-cell  { width: 50%; }
.Rtable--3cols > .Rtable-cell  { width: 33.33%; }
.Rtable--4cols > .Rtable-cell  { width: 25%; }
.Rtable--5cols > .Rtable-cell  { width: 20%; }
.Rtable--6cols > .Rtable-cell  { width: 16.6%; }

@media(max-width: 500px) {
    .Rtable--6cols > .Rtable-cell  { width: 100%; }
}

</style>
@endsection

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
                <div class="Rtable-cell">'+data.id+'</div>\
                <div class="Rtable-cell">'+data.name+'</div>\
                <div class="Rtable-cell">'+data.description+'</div>\
                <div class="Rtable-cell">'+data.price+'</div>\
                <div class="Rtable-cell" id="image-'+data.id+'"></div>\
                <div class="Rtable-cell">\
                    <button data-id="'+data.id+'" class="btn btn-primary btn-edit-product">編輯</button>\
                    <button data-id="'+data.id+'" class="btn btn-theme-tertiary btn-delete-product">刪除</button>\
                </div>\
            ');

            $.getJSON('/api/products/'+data.id+'/images', function (i_json) {
                console.log(i_json)
                var domain = window.location.origin;
                image_path = [];                
                i_json.forEach(function (e) {
                    image_path.push(domain+'/storage/images/'+e.filename);
                    $('#image-'+e.product_id).append('<a href="'+domain+'/storage/images/'+e.product_id+'/'+e.filename+'" target="_blank">'+e.filename+'</a><hr>');
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
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="float-left">商品列表</h1>
                <a href="/products/job/new/" class="btn btn-primary float-right">新增產品</a>
            </div>
            <div class="Rtable Rtable--6cols" id="tbody">
                <div class="Rtable-cell"><strong>ID</strong></div>
                <div class="Rtable-cell"><strong>商品名稱</strong></div>
                <div class="Rtable-cell"><strong>產品敘述</strong></div>
                <div class="Rtable-cell"><strong>價格</strong></div>
                <div class="Rtable-cell"><strong>產品圖</strong></div>
                <div class="Rtable-cell"><strong>編輯產品</strong></div>             
                
            </div>
        </div>
    </div>    
</div>
@endsection