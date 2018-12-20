@extends('layouts/app')

@section('post-nav')
active
@endsection

@section('style')
<style>
#btn-pre {
    display: none;
}
#btn-next {
    display: none;
}
</style>
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
        // for( var index in data){
        //     $('#tbody').append('\
        //         <tr>\
        //             <td>'+ data[index].id +'</td>\
        //             <td><a href="/posts/'+ data[index].id +'/show">'+ data[index].title +'</a></td>\
        //             <td>'+ data[index].content +'</td>\
        //         <tr>\
        //     ')
        // }
        for( var index in data){
            console.log(data)
            $('#news').append('\
                <div class="content py-5 border-bottom">\
                    <h6 class="text-center">'+data[index].created_at+'</h6>\
                    <h2 class="text-center py-3">'+data[index].title+'</h2>\
                    <div>'+data[index].content+'</div>\
                </div>\
            ')
        }
        // console.log(json.next_page_url)
        if (json.prev_page_url) {
            $('#btn-pre').attr('href', json.prev_page_url.replace('api/',''));      
            $('#btn-pre').show();
        } 
        if (json.next_page_url){
            $('#btn-next').attr('href', json.next_page_url.replace('api/',''));
            $('#btn-next').show();
        } 
    })  
});
</script>
@endsection


@section('content')

<div class="container spacing">
    <h1>最新消息</h1>
    <div class="row justify-content-center">    
        <div id="news" class="col-md-9 pt-5">            
            {{-- <div class="content py-5 border-bottom">
                <h6 class="text-center">DEC 4TH , 2018</h6>
                <h2 class="text-center py-3">新品上市｜藏心軟歐貝果</h2>
                <img src="http://www.louisacoffee.co/upload/news/20181204_014847-image(750x_).png" alt="" class="img-fluid pb-3">
                <p>到路易莎喝咖啡除了吃蛋糕、漢堡、磚壓外又有新選擇囉！因應國人愛吃“軟”的飲食習慣，路易莎推出咖啡館新食伴「藏心軟歐貝果」。顛覆貝果硬脆的傳統印象，特製外Q內軟、多款內餡好料的藏心軟歐貝果，其中主廚推薦的“墨魚明太子”口味絕不能錯過！即日起新品上市『任選3個(含)以上即享9折優惠』（限定門市販售）</p>
                <p>【特色介紹】

                        ・混合法國T55冠軍比賽專用粉，讓麥香更濃郁。
                        
                        ・採用燙麵工法創造外Q內軟的口感。
                        
                        ・62%高含水量讓貝果內層柔軟，不再硬梆梆。（一般含水量40%）
                        
                </p>
            </div> --}}

            {{-- <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>note</th>
                </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table> --}}
            <a class="btn btn-primary" id="btn-pre">Previous</a>
            <a class="btn btn-primary" id="btn-next">Next</a>
        </div>
    </div>  
</div>

@endsection