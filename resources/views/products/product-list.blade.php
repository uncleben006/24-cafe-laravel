@extends('layouts/app')

{{-- nav-bar --}}
@section('badminton-nav','active')
@section('badminton-subnav', 'show-dropdown')

@switch($class)
    @case('racket')
        @section('badminton-rackets', 'subnav-active')
        @break
    @case('footwear')
        @section('badminton-footwears', 'subnav-active')
        @break
    @case('apparel')
        @section('badminton-apparels', 'subnav-active')
        @break
    @case('bag')
        @section('badminton-bags', 'subnav-active')
        @break
    @case('accessory')
        @section('badminton-accessories', 'subnav-active')
        @break
    @default        
@endswitch

@section('script')
<script>
$(function() {    
    // get data
    var images = {!! $imgs !!}
    console.log(images)
    images.forEach(function (img) {
        $('.card-'+img.product_id).append('<img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid">');
    })
    
    // slick generate
    $('.card-header').slick({
        infinite: true,
        adaptiveHeight: true,
        variableWidth: true,
        centerMode: true,
        centerPadding: '25px',
        dots: true,
    })    

    // hide slick dots if only one
    for (let i = 0; i < $('.slick-dots').length; i++) {
        if($('.slick-dots')[i].children.length==1){
            $($('.slick-dots')[i]).hide()
        }
    }

    // var url = new URL(window.location.href);
    // // url.searchParams.set('series', '亮劍')
    // console.log(url)
    // var pathname = url.pathname
    // var sortPath = '/api'+pathname+'sorting';
    // console.log(sortPath)

    // (function createSortBar(apiPath) {
    //     $.getJSON(apiPath, function(s_json) {
    //         s_json.series.forEach(function(data){
    //             $('#series-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'" data-sort="series" >'+data+'</a>')
    //         })
    //         s_json.categories.forEach(function(data){
    //             $('#categories-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'" data-sort="categories">'+data+'</a>')      
    //         })
    //         s_json.rank.forEach(function(data){
    //             $('#rank-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'" data-sort="rank">'+data+'</a>')
    //         })
    //         s_json.brands.forEach(function(data){
    //             $('#brands-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'" data-sort="brands">'+data+'</a>')
    //         })        
    //     })  
    //     .done(function(){
    //         // 按下分類後，如果url 已經有該屬性則取代，如果沒有則新增(append)
            
    //         var urlHref = url.href
    //         var urlParameters = ''
    //         for(var pair of url.searchParams.entries()){
    //             urlParameters += pair[0]+'='+pair[1]+'&'
    //         }
    //         console.log('urlParameter=',urlParameters)
    //         console.log('pathname= ',pathname)
    //         $('.prodouct-filter').on('click', function(){
                
    //             if(url.searchParams.has($(this).data('sort'))){
    //                 urlParameters = ''
    //                 for(var pair of url.searchParams.entries()){
    //                     if(pair[0]==$(this).data('sort')){
    //                         pair[1] = $(this).data('filter')
    //                     }
    //                     urlParameters += pair[0]+'='+pair[1]+'&'
    //                 }
    //                 console.log(urlParameters)
    //                 window.location.href = pathname + '?' + urlParameters
    //             }else{
    //                 window.location.href = pathname + '?' + urlParameters + $(this).data('sort') + '=' + $(this).data('filter')
    //             }  
    //         })
    //     })
    //     .fail(function() {
    //         var sortPathUpdate = '/api'+pathname+'/sorting';
    //         createSortBar(sortPathUpdate)
    //     })   
    // })(sortPath);   

});
</script>
@endsection

@section('style')
<style>
.sorting {
    border-bottom: 1.5px solid black; 
    margin-bottom:50px;
}
.sorting-primary {
    width: 158px;
}
@media (min-width: 992px) {
    .sorting-primary {
        width: auto;
    }
}

/* .product-card {
    &:hover {
        .card {
            opacity: 0.75;
            transition: 0.5s;
        }        
    }
    a:hover {
        color: inherit !important;
        text-decoration: none;
    }
} */

.card {
    min-height: 400px;
    height: 100%;
}
.card-header {
    text-align: center;
    padding: 30px 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
.card-header .img-fluid {
    max-width: 100%;
    max-height: 100%;
}
.card-header .image-block {
    max-width: 100%;
    max-height: 100%;
}
.card-title{
    font-size: 1.2rem;
}
.card-description{
    font-size: 1rem;
}
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
    .card-header {
        height: 200px !important;
    }
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
{{-- sorting start --}}
<div class="container spacing">
    {{-- <div class="d-inline-block dropdown m-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">系列</button>
        <div class="dropdown-menu" id="series-dropdown">
            <a class="dropdown-item prodouct-filter" data-filter="'+data+'" data-sort="series">全英系列</a>
        </div>
    </div>
    <div class="d-inline-block dropdown m-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">分類</button>
        <div class="dropdown-menu" id="categories-dropdown">
        </div>
    </div> 
    <div class="d-inline-block dropdown m-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">等級</button>
        <div class="dropdown-menu" id="rank-dropdown">
        </div>
    </div>  
    <div class="d-inline-block dropdown m-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">品牌</button>
        <div class="dropdown-menu" id="brands-dropdown">
        </div>
    </div>   --}}

    <div class="sorting">
        <div class="row pb-3">
            <div class="col-md-9">
                <div class="text-nowrap float-left pr-3">篩選 |</div>
                <div class="d-flex flex-column flex-lg-row">
                    <div class="d-inline-block dropdown pr-3">
                        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">系列</button>
                        <div class="dropdown-menu" id="series-dropdown">
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                        </div>
                    </div>
                    <div class="d-inline-block dropdown pr-3">
                        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">分類</button>
                        <div class="dropdown-menu" id="categories-dropdown">
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                        </div>
                    </div> 
                    <div class="d-inline-block dropdown pr-3">
                        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">等級</button>
                        <div class="dropdown-menu" id="rank-dropdown">
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                        </div>
                    </div>  
                    <div class="d-inline-block dropdown pr-3">
                        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">品牌</button>
                        <div class="dropdown-menu" id="brands-dropdown">
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                            <a class="dropdown-item prodouct-filter">全英系列</a>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-nowrap float-left pr-3">排序 |</div>
                <div></div>
            </div>
        </div>
    </div>    
</div>
{{-- sorting end --}}
{{-- product card start --}}
<div class="container">
    <div class="row justify-content-center" id="product_list">       
        @foreach ($datas as $data)                       
            <div class="col-lg-3 col-md-4 col-sm-6 product-card mb-5">                
                <div class="card rounded-0">
                    <div class="card-header card-{{$data->id}}">
                    </div>                    
                    <div class="card-body">
                        <h5 class="card-title">{{$data->name}}</h5>
                        <p class="card-description">{{$data->description}}</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text">NT. {{$data->price}}</p>
                    </div>
                </div>                
            </div>    
        @endforeach               
    </div>        
</div>
{{-- product card end --}}
@endsection
