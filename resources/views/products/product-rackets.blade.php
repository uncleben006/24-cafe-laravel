@extends('layouts/app')

@section('badminton-nav','active')
@section('badminton-subnav', 'show-dropdown')
@section('badminton-rackets', 'subnav-active')

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
    
    $.getJSON('/api/products', function(p_json) {
        for( var index in p_json ) {
            console.log(p_json);
            var data = p_json[index];
            $('#product_list').append('\
            <div class="col-md-3 product-card mb-5">\
                <a href="/products/'+data.id+'/detail" target="_blank">\
                    <div class="card">\
                        <div class="card-header">\
                            <img id="image-'+data.id+'" src="" class="img-fluid">\
                        </div>\
                        <div class="card-body">\
                            <h5 class="card-title">'+data.name+'</h5>\
                        </div>\
                        <div class="card-footer">\
                            <p class="card-text">NT. '+data.price+'</p>\
                        </div>\
                    </div>\
                </a>\
            </div>\
            ');

            $.getJSON('/api/products/'+data.id+'/images', function (i_json) {
                // 因為是 product list 所以放第一個當縮圖就好
                console.log('i_json= ', i_json)
                var domain = window.location.origin;
                console.log('domain= ', domain);
                var image_path = domain + '/storage/images/' + i_json[0].product_id + '/' + i_json[0].filename;
                console.log(image_path);
                $('#image-'+i_json[0].product_id).attr('src', image_path);
            })
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