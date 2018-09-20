@extends('layouts/app')

@section('products-nav')
active
@endsection

@section('style')
<style>
#product_list .card{
    min-height: 400px;
    height: 100%;
}
#product_list .card-header {
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}
#product_list .card-header .img-fluid {
    max-width: 100%;
    max-height: 100%;
}
</style>
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
                <a href="/products/'+data.id+'/detail" target="_blank">\
                    <div class="card">\
                        <div class="card-header">\
                            <img src="'+ data.image_path +'" class="img-fluid">\
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
    </div>    
</div>
@endsection