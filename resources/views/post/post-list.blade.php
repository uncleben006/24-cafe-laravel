@extends('layouts/app')

@section('content-admin-nav','active')

@section('style')

@endsection

@section('script')
<script>  

$(function() {
    var url_string = window.location.href
    var url = new URL(url_string)
    var para = url.searchParams.get("page")
    var data = {!! $postData !!}
    createPostTable(data)
});

function createPostTable(php_datas) {
    var post_str = ''
    php_datas.forEach(function (data) {
        // console.log(data)
        post_str += '\
        <div class="Rtable-cell">'+data.id+'</div>\
        <div class="Rtable-cell">'+data.title+'</div>\
        <div class="Rtable-cell">'+data.content+'</div>\
        <div class="Rtable-cell">'+data.created_at+'</div>\
        <div class="Rtable-cell">'+data.updated_at+'</div>\
        <div class="Rtable-cell text-center">\
            <a class="btn btn-sm btn-outline-primary px-3 mx-1 rounded-0 " href="/posts/job/content/'+data.id+'/edit">編輯</a>\
            <a class="btn btn-sm btn-outline-danger px-3 mx-1 rounded-0" href="javascript:doForward(\'/posts/job/content/'+data.id+'/delete/\',\'確定要刪除 '+data.title+' 嗎?\');">刪除</a>\
        </div>'
    })
    $('#postDatas').replaceWith(post_str)
}
function doForward(url, warning) {
    confirm(warning)? window.location=url: '';
}
</script>
@endsection


@section('content')

<div class="px-3 px-lg-5 spacing"> 
    <div class="row justify-content-center">    
        <div class="col-md-12 pb-5">
            <div class="d-flex align-items-center justify-content-between">
                <h1>貼文列表</h1>                        
                <div>
                    <a href="#" class="sorting">順序&#x25BC;</a>
                    <a href="/posts/job/content/new/" class="btn btn-primary btn-sm rounded-0">新增貼文</a>
                </div>                
            </div>
            <div class="Rtable Rtable--6cols" id="tbody">  
                <a href="?postSort=id" class="Rtable-cell"><strong>ID</strong></a>            
                <a href="?postSort=name" class="Rtable-cell"><strong>貼文標題</strong></a>
                <a href="?postSort=name" class="Rtable-cell"><strong>貼文內容</strong></a>
                <a href="?postSort=class" class="Rtable-cell"><strong>新增時間</strong></a>
                <a href="?postSort=class" class="Rtable-cell"><strong>修改時間</strong></a>
                <div class="Rtable-cell"><strong>編輯產品</strong></div>     
                <div id="postDatas"></div>                                               
            </div>
        </div>
    </div>  
</div>

@endsection