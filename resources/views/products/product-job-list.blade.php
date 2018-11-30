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
/* Tables
================================== */
.Rtable {
    display: flex;
    flex-wrap: wrap;
    margin: 0 0 3em 0;
    padding: 0px;
}
.Rtable-cell {
    box-sizing: border-box;
    flex-grow: 1;
    width: 100%; 
    padding: 0.1rem 0.25rem;
    overflow: hidden; 
    list-style: none;
    border: solid 1px black;
    background: fade(slategrey,20%);
    max-height: 15vh;
    overflow: auto;
    > h1, > h2, > h3, > h4, > h5, > h6 { margin: 0; }
}
.Rtable-cell hr {
    margin: 5px auto;
}

/* Table column sizing
================================== */
.Rtable--2cols > .Rtable-cell  { width: 50%; }
.Rtable--3cols > .Rtable-cell  { width: 33.33%; }
.Rtable--4cols > .Rtable-cell  { width: 25%; }
.Rtable--5cols > .Rtable-cell  { width: 20%; }
.Rtable--6cols > .Rtable-cell  { width: 16.6%; }

@media(max-width: 500px) {
    .Rtable--6cols > .Rtable-cell  { width: 100%; }
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
});
function createProductTable(php_datas) {
    var product_str = ''
    php_datas.forEach(function (data) {
        console.log(data)
        product_str += '\
        <div class="Rtable-cell">'+data.id+'</div>\
        <div class="Rtable-cell">'+data.class+'</div>\
        <div class="Rtable-cell">'+data.name+'</div>\
        <div class="Rtable-cell">'+data.price+'</div>\
        <div class="Rtable-cell">'+data.introduction+'</div>\
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
        console.log(data)
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

// $('.list-group-item-action').on('click',function(e){
//     window.location = e.target.href
//     console.log()
// })

switch (window.location.hash) {
    case '#product-list':
        $('.product-list').toggleClass('active')
        break;
    case '#fliter-list':
        $('.fliter-list').toggleClass('active')
        break;
    case '#product-pages':
        $('.product-pages').toggleClass('active')
        break;
    case '#list-messages':
        $('.list-messages').toggleClass('active')
        break;
    default:
        break;
}




</script>
@endsection

@section('content')
<div class="container spacing">
    <div class="row flex-column">
        <div class="col-md-4">
            <div class="list-group flex-row" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action col-md-6 py-1 px-3 text-center rounded-0 product-list active" data-toggle="list" href="#product-list" >編輯商品</a>
                <a class="list-group-item list-group-item-action col-md-6 py-1 px-3 text-center rounded-0 fliter-list" data-toggle="list" href="#fliter-list" >編輯篩選</a>
                <a class="list-group-item list-group-item-action col-md-6 py-1 px-3 text-center rounded-0 list-messages" data-toggle="list" href="#list-messages" >編輯標籤</a>
            </div>
        </div>
        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">

                {{-- 編輯商品 --}}
                <div class="tab-pane fade mt-3 show active" id="product-list">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="float-left">商品列表</h1>
                        <div class="float-right">
                            <a href="/products/job/new/" class="btn btn-primary btn-sm rounded-0">新增產品</a>
                        </div>                
                    </div>
                    <div>
                        <div class="Rtable Rtable--6cols" id="tbody">  
                            <div class="Rtable-cell"><strong>ID</strong></div>                    
                            <div class="Rtable-cell"><strong>產品類別</strong></div>
                            <div class="Rtable-cell"><strong>商品名稱</strong></div>
                            <div class="Rtable-cell"><strong>價格</strong></div>
                            <div class="Rtable-cell"><strong>產品簡介</strong></div>                    
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
                            <a href="/products/job/filter/new/" class="btn btn-primary btn-sm rounded-0">新增篩選</a>
                        </div>                
                    </div>
                    <div>
                        <div class="Rtable Rtable--6cols">  
                            <div class="Rtable-cell"><strong>ID</strong></div>                    
                            <div class="Rtable-cell"><strong>產品類別</strong></div>
                            <div class="Rtable-cell"><strong>篩選類別</strong></div>
                            <div class="Rtable-cell"><strong>篩選名稱</strong></div>
                            <div class="Rtable-cell"><strong>順序</strong></div>   
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