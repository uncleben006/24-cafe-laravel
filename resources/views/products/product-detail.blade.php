@extends('layouts/app')

@section('products-nav')
active
@endsection

@section('style')
<style>
.img-fluid {
    margin: 0 auto;
    max-width: 100%;
    max-height: 100%;
}
</style>
@endsection

@section('script')
<script>
$(function() {       
    $.getJSON('/api/products/'+{{$product->product_id}}+'/images', function (i_json) {                
        var domain = window.location.origin;                 
        i_json.forEach(function (e) {
            var image_path = domain + '/storage/images/' + e.product_id + '/' + e.filename;
            console.log(image_path);
            $('#image-block').append('\
                <div><img class="img-fluid" src="'+image_path+'" alt=""></div>\
            ');
        });                 
    })
    .then(function() {
        $('.loading').remove();    
    })
    .done(function () {
        $('#image-block').slick({
            dots: true,
            infinite: true,
        });    
    })
});
</script>
@endsection

@section('content')
<div class="container pb-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-7 text-center border p-5" id="image-block"><div class="loading"></div></div>
                <div class="col-md-5 ">
                    <div class="d-flex justify-content-between flex-column h-100">
                        <div>
                            <h2>{{$product->name}}</h2>
                            <h4>NT. {{$product->price}}</h4>
                            <div class="py-3">
                                <div>
                                    系列: <span class="bg-info p-1 rounded">{{$product->series}}</span>
                                    分類: <span class="bg-info p-1 rounded">{{$product->categories}}</span>
                                </div>
                                <div class="pt-3">
                                    等級: <span class="bg-info p-1 rounded">{{$product->rank}}</span>
                                    品牌: <span class="bg-info p-1 rounded">{{$product->brands}}</span>
                                </div>
                            </div>

                            <div class="border p-3">{{$product->description}}</div>
                            <p></p>
                        </div>
                        <p>最後編輯: {{$product->created_at}}</p>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
</div>
@endsection