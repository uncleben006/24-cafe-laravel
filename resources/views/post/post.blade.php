@extends('layouts/app')

@section('post-nav')
active
@endsection

@section('style')
@endsection

@section('script')
<script>  

$(function() {
    var url_string = window.location.href
    var url = new URL(url_string);
    var para = url.searchParams.get("page");
    $.getJSON('/api/posts/?page='+para, function(json){  
        // console.log(json);
        // console.log(json.data);
        var data = json.data;
        for( var index in data){
            // console.log(data)
            $('#news').append('\
                <div class="content py-5 border-bottom">\
                    <h6 class="text-center">'+data[index].created_at+'</h6>\
                    <h2 class="text-center py-3">'+data[index].title+'</h2>\
                    <div>'+data[index].content+'</div>\
                </div>\
            ')
        }
        // console.log(json.next_page_url)
        json.prev_page_url? $('#btn-pre').attr('href', json.prev_page_url.replace('api/','')) : $('#btn-pre').css({'background':'gainsboro','color':'#797979','cursor':'context-menu'})
        json.next_page_url? $('#btn-next').attr('href', json.next_page_url.replace('api/','')) : $('#btn-next').css({'background':'gainsboro','color':'#797979','cursor':'context-menu'})
    })  
    $('.page-link').each(function(){        
        if(para) {
            if($(this)[0].innerHTML == para){
                $(this).addClass('color','active')
            }
        }else {
            if($(this)[0].innerHTML == 1){
                $(this).addClass('color','active')
            }
        }
    })
});
</script>
@endsection


@section('content')

<div class="container spacing">
    <h1>最新消息</h1>
    <div class="row justify-content-center">    
        <div class="col-md-9 mb-5">
            <div id="news" class="py-5"></div>
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="javascript: void(0)" id="btn-pre">上一頁</a></li>
                    @if( $postCount>5 )
                        @for($i=0;$i<$postCount/5;$i++)                        
                            <li class="page-item"><a class="page-link" href="/posts?page={{$i+1}}">{{$i+1}}</a></li>                    
                        @endfor
                    @endif
                <li class="page-item"><a class="page-link" href="javascript: void(0)" id="btn-next">下一頁</a></li>
            </ul>
        </div>
    </div>  
</div>

@endsection