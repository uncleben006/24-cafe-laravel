@extends('layouts/app')

{{-- nav-bar --}}
@section('badminton-nav','active')
@section('badminton-subnav', 'show-dropdown')

@switch($class)
    @case('rackets')
        @section('badminton-rackets', 'subnav-active')
        @break
    @case('footwears')
        @section('badminton-footwears', 'subnav-active')
        @break
    @case('apparels')
        @section('badminton-apparels', 'subnav-active')
        @break
    @case('bags')
        @section('badminton-bags', 'subnav-active')
        @break
    @case('accessories')
        @section('badminton-accessories', 'subnav-active')
        @break
    @default        
@endswitch

@section('script')
<script>
$(function() {    
    // var url = new URL(window.location.href);
    // // url.searchParams.set('series', '亮劍')
    // console.log(url);
    // var pathname = url.pathname;
    // var search = url.search;
    // var urlParams = url.searchParams;
    // var href = url.href;
    // // console.log(url.href);
    // // console.log(urlParams.has('categories'))
    // console.log(url.searchParams.value);
    
    // show product list
    // var productList = '';
    // (function showProduct() {
    //     $.getJSON('/api'+pathname+search, function(p_json) {        
    //         p_json.forEach(function(data){
    //             productList += '\
    //             <div class="col-md-3 product-card mb-5">\
    //                 <a href="'+pathname+data.product_id+'/detail" target="_blank">\
    //                     <div class="card">\
    //                         <div class="card-header">\
    //                             <div id="image-'+data.product_id+'" style="position:relative">\
    //                                 <div class="loading loading-image"></div>\
    //                             </div>\
    //                         </div>\
    //                         <div class="card-body">\
    //                             <h5 class="card-title">'+data.name+'</h5>\
    //                         </div>\
    //                         <div class="card-footer">\
    //                             <p class="card-text">NT. '+data.price+'</p>\
    //                         </div>\
    //                     </div>\
    //                 </a>\
    //             </div>';
    //             $.getJSON('/api/products/'+data.product_id+'/images', function (i_json) {
    //                 var domain = window.location.origin;
    //                 var image_path = domain + '/storage/images/' + i_json[0].product_id + '/' + i_json[0].filename;
    //                 $('#image-'+i_json[0].product_id).html('<img src="'+image_path+'" alt="" class="img-fluid">');
    //             })
    //             .done(function () {
    //                 $('.loading-image').remove();
    //             })
    //         })
    //         $('#product_list').html(productList);
    //     })
    //     .done(function() {
    //         $('.loading-content').remove();    
    //     })
    // })()  


    // var sortPath = '/api'+pathname+'sorting';

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
    $('.card-header').slick({
        variableWidth: true,
        infinite: true,
    })
    
});
</script>
@endsection

@section('style')
<style>
#product_list .card{
    min-height: 400px;
    height: 100%;
}
#product_list .card-header {
    height: 200px !important;
    display: flex;
    justify-content: center;
    align-items: center;
}
#product_list .card-header .img-fluid {
    max-width: 100%;
    max-height: 100%;
}
#product_list .card-header .image-block {
    max-width: 100%;
    max-height: 100%;
}
.slick-slider, .slick-list, .slick-track {
  max-height: 100%;
  max-width: 100%;
  width: auto !important;
  height: auto !important;
  transform: translate3d(0px, 0px, 0px) !important;
}
.slick-slider, .slick-list {
  display: flex;
  justify-content: center;
  align-items: center;
}

</style>
@endsection

@section('content')
{{-- sorting start --}}
<div class="container d-flex mb-5">
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">系列</button>
        <div class="dropdown-menu" id="series-dropdown">
        </div>
    </div>
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">分類</button>
        <div class="dropdown-menu" id="categories-dropdown">
        </div>
    </div>    
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">等級</button>
        <div class="dropdown-menu" id="rank-dropdown">
        </div>
    </div>  
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">品牌</button>
        <div class="dropdown-menu" id="brands-dropdown">
        </div>
    </div>  
</div>
{{-- sorting end --}}
{{-- product card start --}}
<div class="container">
    <div class="row justify-content-center" id="product_list">       
        @foreach ($datas as $data)                       
            <div class="col-md-3 product-card mb-5">
                
                <div class="card">
                    <div class="card-header">
                        @foreach ($imgs as $img)                  
                            @if($img->product_id == $data->id)
                                <img src="/storage/images/{{$img->product_id}}/{{$img->filename}}" alt="" class="img-fluid">
                            @endif
                        @endforeach
                    </div>
                    <a href="{{$data->id}}/detail" target="_blank">
                        <div class="card-body">
                            <h5 class="card-title">{{$data->name}}</h5>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">NT. {{$data->price}}</p>
                        </div>
                    </a>
                </div>
                
            </div>    
        @endforeach       
        
    </div>        
</div>
{{-- product card end --}}
@endsection
