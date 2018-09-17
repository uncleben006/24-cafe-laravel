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

    // $(document).on('click','.btn-add-cart', function () {
    //     var id = $(this).data('id');
    //     $.getJSON('/products/add-cart/'+id, function (json) {
    //         if(json.status){
    //             alert('加入購物車成功');
    //         }
    //     })
    // });

    $.getJSON('/api/products', function(json) {
        for( var index in json ) {
            console.log(json);
            var data = json[index];
            $('#product_list').append('\
            <div class="col-md-3 product-card mb-5">\
                <a href="#" target="_blank">\
                    <div class="card">\
                        <div class="card-header">\
                            <img class="card-img-top" src="'+data.image_path+'" alt="Card image cap">\
                        </div>\
                        <div class="card-body">\
                            <h5 class="card-title">'+data.name+'</h5>\
                            <p class="card-text">'+data.description+'</p>\
                        </div>\
                        <div class="card-footer">\
                            <p class="card-text">NT. '+data.price+'</p>\
                        </div>\
                    </div>\
                </a>\
            </div>\
            ');
        }
    });       
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" id="product_list">
        <div class="col-md-3 product-card mb-5">
            <a href="#" target="_blank">
                <div class="card">
                    <div class="card-header">
                        <img class="card-img-top" src="http://127.0.0.1:8000/storage/images/vive-pro-hmd-update-03.png" alt="Card image cap">
                    </div>                    
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </a>
        </div>              
        {{-- <div class="col-md-8">
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
            <div class="d-flex justify-content-end">
                <a href="/products/cart" class="btn btn-primary">結帳</a>
            </div>            
        </div> --}}
    </div>    
</div>
@endsection