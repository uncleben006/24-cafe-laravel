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
.list-group-item {
    height: 50px;
    width: auto;
}
.list-group-item img {
    height: 50px;
    width: auto;
}
@media ( min-width: 992px ) {
    .list-group-item {
        height: auto;
        width: 100%;
    }
    .list-group-item img {
        height: auto;
        width: 100%;
    }
    #image-overview img {
        /* height: 30vw; */
        max-height: 400px;
    }
}
/* .img-overview {
    height: 25vh;
}
.tab-content {
    max-height: 100%;
}
.tab-content > .tab-pane {
    max-height: 100%;
} */
/* .slick-slide {
    opacity: 0;
    transition: 0.5s;
    padding-top: 25px;
    padding-bottom: 25px;
}
.slick-current {
    opacity: 1;
}
.slick-prev {
    display: none !important;
}
.slick-next {
    display: none !important;
}
.slick-dots {
    bottom: 0px;
    left: 0;
}
.slick-dotted.slick-slider {
    margin-bottom: 0px;
}
.slick-slide {
        width: 300px;
    }
@media (min-width: 576px){
    .slick-slide {
        width: calc( 540px - 50px );
    }
}
@media (min-width: 768px){
    .slick-slide {
        width: calc( 720px / 12 * 7 - 50px );
    }
}
@media (min-width: 992px){
    .slick-slide {
        width: calc( 960px / 12 * 7 - 50px );
    }
}
@media (min-width: 1200px){
    .slick-slide {
        width: calc( 1140px / 12 * 7 - 50px );
    }
} */

/* * {
    border: solid 1px;
} */
</style>
@endsection

@section('script')
<script>
$(function() {
    var images = {!! $imgs !!}
    console.log(images)     
    var thumbnail = ''
    var overview = ''
    images.forEach(function (img) {
        console.log(img)
        thumbnail += '<a class="list-group-item list-group-item-action p-0 mb-lg-2" id="'+img.id+'" data-toggle="tab" href="#list-'+img.id+'">\
                        <img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid">\
                    </a>'
        overview += '<div class="tab-pane fade zooming" id="list-'+img.id+'">\
                        <img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid ">\
                    </div>'
    })        
    $('#image-thumbnail').html(thumbnail)
    $('#image-overview').html(overview)
    $($('.tab-content')[0].firstChild).addClass('active show')
    $('.zooming').zoom({magnify: 0.5});
});
</script>
@endsection

@section('content')
<div class="container spacing">
    <div class="row">
        <div class="col-lg-8">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-2 pt-3 pt-lg-0">
                    <div class="list-group flex-row flex-lg-column" id="image-thumbnail">
                        <div class="loading"></div>                        
                    </div>                    
                </div>
                <div class="col-lg-10 img-overview border px-0 d-flex justify-content-center align-items-center">
                    <div class="tab-content" id="image-overview">
                        <div class="loading"></div>
                    </div>
                </div>
            </div>              
        </div>        
        <div class="col-lg-4 pt-3 pt-lg-0">
            <div class="d-flex justify-content-between flex-column h-100">
                @foreach ($datas as $data) 
                <div>
                    <h2>{{$data->name}}</h2>
                    <h4>NT. {{$data->price}}</h4>
                    <div class="row py-3">
                        @if($data->serires)<div class="col-lg-6"><div>系列: {{$data->series}}</div></div>@endif
                        @if($data->category)<div class="col-lg-6"><div>分類: {{$data->category}}</div></div>@endif
                        @if($data->rank)<div class="col-lg-6"><div>等級: {{$data->rank}}</div></div>@endif
                        @if($data->brand)<div class="col-lg-6"><div>品牌: {{$data->brand}}</div></div>@endif
                    </div>
                    <div class="border p-3">{!! $data->description !!}</div>
                </div>
                <div>最後編輯: {{$data->created_at}}</div>
                @endforeach
            </div>
        </div>        
    </div>    
</div>
@endsection