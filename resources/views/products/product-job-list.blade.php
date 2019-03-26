@extends('layouts/app')

@section('products-admin-nav','active')

@section('style')
<style>

/* * {
    border: solid 1px;
}     */
.list-group-item:last-child {
    margin-bottom: -1px;
}

</style>
@endsection

@section('script')
<script>
$(function() {   
    // create product table
    createProductTable( {!! $productDatas !!} )
    // create filter table
    createFilterTable( {!! $filterDatas !!} )    
    
    var url = new URL(window.location.href);
    var pathname = url.pathname
    var urlHref = url.href
    var urlParameters = ''
    // console.log(urlParameters).
    $('.sorting').on('click', function(e){
        e.preventDefault()
        if(url.searchParams.has('order')){
            // console.log('it has order')   
            // console.log(url.searchParams.get('order'))
            for(var pair of url.searchParams.entries()){
                if(pair[0]=='order'){
                    if(pair[1]=='asc'){
                        pair[1]='desc'
                    }
                    else {
                        pair[1]='asc'
                    }
                }
                // console.log(pair[0])
                // console.log(pair[1])
                urlParameters += pair[0]+'='+pair[1]+'&'
            }
            // console.log(urlParameters)
        }
        else {
            for(var pair of url.searchParams.entries()){
                urlParameters += pair[0]+'='+pair[1]+'&order=desc'
            }
        }
        window.location.href = pathname + '?' + urlParameters
    }) 
    $('.product-list').on('click',function(){
        document.cookie = 'tab = ; expires = Wed; 01 Jan 1970'
        document.cookie = 'tab = product-list'
    })
    $('.fliter-list').on('click',function(){
        document.cookie = 'tab = ; expires = Wed; 01 Jan 1970'
        document.cookie = 'tab = fliter-list'
    })
    $('.list-messages').on('click',function(){
        document.cookie = 'tab = ; expires = Wed; 01 Jan 1970'
        document.cookie = 'tab = list-messages'
    })
    if(getCookie('tab')){
        $('.'+getCookie('tab')).addClass('active')
        $('#'+getCookie('tab')).addClass('active show')
    }    
    else {
        $('.product-list').addClass('active')
        $('#product-list').addClass('active')
    }
});
function createProductTable(php_datas) {
    var product_str = ''
    php_datas.forEach(function (data) {
        console.log(data)
        product_str += '\
        <div class="Rtable-cell" title="'+data.id+'">'+data.id+'</div>\
        <div class="Rtable-cell" title="'+data.class+'">'+data.class+'</div>\
        <div class="Rtable-cell" title="'+data.name+'">'+data.name+'</div>\
        <div class="Rtable-cell" title="'+data.price+'">'+data.price+'</div>\
        <div class="Rtable-cell" title="'+data.series+'">'+data.series+'</div>\
        <div class="Rtable-cell" title="'+data.category+'">'+data.category+'</div>\
        <div class="Rtable-cell" title="'+data.rank+'">'+data.rank+'</div>\
        <div class="Rtable-cell" title="'+data.brand+'">'+data.brand+'</div>\
        <div class="Rtable-cell" title="'+data.introduction+'">'+data.introduction+'</div>\
        <div class="Rtable-cell" title="'+data.detail+'">'+data.detail+'</div>\
        <div class="Rtable-cell" title="'+data.topSection+'">'+data.topSection+'</div>\
        <div class="Rtable-cell" title="'+data.middleSection+'">'+data.middleSection+'</div>\
        <div class="Rtable-cell text-center">\
            <a class="btn btn-sm btn-outline-primary px-3 mx-1 rounded-0 " href="/products/job/'+data.id+'/edit">編輯</a>\
            <a class="btn btn-sm btn-outline-danger px-3 mx-1 rounded-0" href="javascript:doForward(\'/products/job/'+data.id+'/delete/\',\'確定要刪除 '+data.name+' 嗎?\');">刪除</a>\
        </div>'
    })
    $('#productDatas').replaceWith(product_str)
}
function createFilterTable(php_datas) {
    var filter_str = ''
    php_datas.forEach(function (data) {
        // console.log(data)
        filter_str += '\
        <div class="Rtable-cell">'+data.id+'</div>\
        <div class="Rtable-cell">'+data.product_class+'</div>\
        <div class="Rtable-cell">'+data.filter_class+'</div>\
        <div class="Rtable-cell">'+data.filter_name+'</div>\
        <div class="Rtable-cell">'+data.sequence+'</div>\
        <div class="Rtable-cell text-center">\
            <a class="btn btn-sm btn-outline-primary px-3 mx-1 rounded-0" href="/products/job/filter/'+data.id+'/edit">編輯</a>\
            <a class="btn btn-sm btn-outline-danger px-3 mx-1 rounded-0" href="javascript:doForward(\'/products/job/filter/'+data.id+'/delete\',\'確定要刪除 '+data.filter_name+' 嗎?\');">刪除</a>\
        </div>'
    })    
    $('#filterDatas').replaceWith(filter_str)
}
function doForward(url, warning) {
    confirm(warning)? window.location=url: '';
}
function getCookie(cookieName) {
    var name = cookieName + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
</script>
@endsection

@section('content')
<div class="px-3 px-lg-5 spacing">
    <div class="row flex-column">
        <div class="col-md-4">
            <div class="list-group flex-row" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action col-md-6 py-1 px-3 text-center rounded-0 product-list" data-toggle="list" href="#product-list" >編輯商品</a>
                <a class="list-group-item list-group-item-action col-md-6 py-1 px-3 text-center rounded-0 fliter-list" data-toggle="list" href="#fliter-list" >編輯篩選</a>
                <a class="list-group-item list-group-item-action col-md-6 py-1 px-3 text-center rounded-0 list-messages" data-toggle="list" href="#list-messages" >編輯標籤</a>
            </div>
        </div>
        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">                
                {{-- 編輯商品 --}}
                <div class="tab-pane fade mt-3 show" id="product-list">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="float-left">商品列表</h1>                        
                        <div class="float-right">
                            <a href="#" class="sorting">順序&#x25BC;</a>
                            <a href="/products/job/new/" class="btn btn-primary btn-sm rounded-0">新增產品</a>
                        </div>                
                    </div>
                    <div>
                        <div class="Rtable Rtable--13cols" id="tbody">  
                            <a href="?productSort=id" class="Rtable-cell"><strong>ID</strong></a>                    
                            <a href="?productSort=class" class="Rtable-cell"><strong>產品類別</strong></a>
                            <a href="?productSort=name" class="Rtable-cell"><strong>商品名稱</strong></a>
                            <a href="?productSort=price" class="Rtable-cell"><strong>價格</strong></a>
                            <a href="?productSort=series" class="Rtable-cell"><strong>系列</strong></a>
                            <a href="?productSort=category" class="Rtable-cell"><strong>分類</strong></a>
                            <a href="?productSort=rank" class="Rtable-cell"><strong>等級</strong></a>
                            <a href="?productSort=brand" class="Rtable-cell"><strong>品牌</strong></a>
                            <a href="javascript:void(0)" class="Rtable-cell"><strong>產品簡介</strong></a>     
                            <a href="javascript:void(0)" class="Rtable-cell"><strong>產品詳述</strong></a>
                            <a href="javascript:void(0)" class="Rtable-cell"><strong>產品內容(頂)</strong></a>
                            <a href="javascript:void(0)" class="Rtable-cell"><strong>產品內容(尾)</strong></a>                      
                            <div class="Rtable-cell"><strong>編輯產品</strong></div>     
                            <div id="productDatas"></div>                                               
                        </div>
                    </div>      
                </div>

                {{-- 編輯篩選 --}}
                <div class="tab-pane fade mt-3" id="fliter-list">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="float-left">篩選列表</h1>
                        <div class="float-right">
                            <a href="#" class="sorting">順序&#x25BC;</a>
                            <a href="/products/job/filter/new/" class="btn btn-primary btn-sm rounded-0">新增篩選</a>
                        </div>                
                    </div>
                    <div>
                        <div class="Rtable Rtable--6cols">  
                            <a href="?filterSort=id" class="Rtable-cell"><strong>ID</strong></a>                    
                            <a href="?filterSort=product_class" class="Rtable-cell"><strong>產品類別</strong></a>
                            <a href="?filterSort=filter_class" class="Rtable-cell"><strong>篩選類別</strong></a>
                            <a href="?filterSort=filter_name" class="Rtable-cell"><strong>篩選名稱</strong></a>
                            <a href="?filterSort=sequence" class="Rtable-cell"><strong>順序</strong></a>   
                            <div class="Rtable-cell"><strong>編輯產品</strong></div>                
                            <div id="filterDatas"></div>                                               
                        </div>
                    </div>    
                </div>

                {{-- 編輯標籤 --}}
                <div class="tab-pane fade mt-3 list-messages" id="list-messages">3</div>
            </div>
        </div>
    </div>    
</div>
@endsection