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
    var images = {!! $imgs !!}
    console.log(images)     
    var str = ''
    images.forEach(function (img) {
        console.log(img)
        str += '<img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid">'
        // $('.card-'+img.product_id).append('<img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid">');
    })  
      
    $('#image-block').html(str)
    
    // slick generate
    $('#image-block').slick({
        infinite: true,
        adaptiveHeight: true,
        variableWidth: true,
        centerMode: true,
        centerPadding: '0px',
        dots: true,
    })    
});
</script>
@endsection

@section('style')
<style>
.slick-slide {
    height: auto;
    width: 250px;
    opacity: 0;
    transition: 0.5s;
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
}
.slick-dotted.slick-slider {
    margin-bottom: 0px;
}
@media (min-width: 576px) {
    .slick-list {
        max-height: 200px;
    }
    .slick-track {
        max-height: 200px;
    }
    .slick-slide {
        height: 150px;
        width: auto;
    }
}
</style>
@endsection

@section('content')
<div class="container spacing">
    <div class="row">
        <div class="col-md-7 text-center border" id="image-block"><div class="loading"></div></div>
        <div class="col-md-5 ">
            <div class="d-flex justify-content-between flex-column h-100">
                @foreach ($datas as $data) 
                <div>
                    <h2>{{$data->name}}</h2>
                    <h4>NT. {{$data->price}}</h4>
                    <div class="py-3">
                        <div>
                            系列: <span class="bg-info p-1 rounded">{{$data->series}}</span>
                            分類: <span class="bg-info p-1 rounded">{{$data->category}}</span>
                            等級: <span class="bg-info p-1 rounded">{{$data->rank}}</span>
                            品牌: <span class="bg-info p-1 rounded">{{$data->brand}}</span>
                        </div>
                    </div>
                    <div class="border p-3">{{$data->description}}</div>
                </div>
                <div>最後編輯: {{$data->created_at}}</div>
                @endforeach
            </div>
        </div>        
    </div>    
</div>
@endsection