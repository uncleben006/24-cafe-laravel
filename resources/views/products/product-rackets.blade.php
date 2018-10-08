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
    
    $.getJSON('/api/products/rackets', function(p_json) {
        p_json.forEach(function(data){
            $('#product_list').append('\
            <div class="col-md-3 product-card mb-5">\
                <a href="/products/racket/'+data.product_id+'/detail" target="_blank">\
                    <div class="card">\
                        <div class="card-header">\
                            <div id="image-'+data.product_id+'" style="position:relative">\
                                <div class="loading loading-image"></div>\
                            </div>\
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
            $.getJSON('/api/products/'+data.product_id+'/images', function (i_json) {
                // 因為是 product list 所以放第一個當縮圖就好
                var domain = window.location.origin;
                var image_path = domain + '/storage/images/' + i_json[0].product_id + '/' + i_json[0].filename;
                $('#image-'+i_json[0].product_id).html('<img src="'+image_path+'" alt="" class="img-fluid">');
            })
        })
    })
    .done(function() {
        $('.loading-content').remove();    
    })       
});
</script>
@endsection

@section('content')
{{-- sorting start --}}
<div class="container">
    <div class="dropdown">
        <button class="btn btn-outline-theme-secondary dropdown-toggle rounded-0" type="button" id="dropdownMenuButton" data-toggle="dropdown">
        Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div>
</div>
{{-- sorting end --}}

<div class="container">
    <div class="row justify-content-center" id="product_list">       
        <div class="loading loading-content"></div>        
    </div>    
</div>
@endsection