@extends('layouts/app')

@section('content-admin-nav','active')

@section('style')
<style>
#btn-pre {
    display: none;
}
#btn-next {
    display: none;
}

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
    var url_string = window.location.href
    var url = new URL(url_string)
    var para = url.searchParams.get("page")

    var data = {!! $postData !!}
    createPostTable(data)

    // $.getJSON('/api/posts/?page='+para, function(json){  
    //     // console.log(json);
    //     // console.log(json.data);
    //     var data = json.data        
    //     if (json.prev_page_url) {
    //         // console.log(json.prev_page_url)
    //         $('#btn-pre').attr('href', json.prev_page_url.replace('api/posts','products/job/content')) 
    //         $('#btn-pre').show()
    //     } if (json.next_page_url){
    //         // console.log(json.next_page_url)
    //         $('#btn-next').attr('href', json.next_page_url.replace('api/posts','products/job/content'))
    //         $('#btn-next').show()
    //     } 
    // })  
});

function createPostTable(php_datas) {
    var post_str = ''
    php_datas.forEach(function (data) {
        // console.log(data)
        post_str += '\
        <div class="Rtable-cell">'+data.id+'</div>\
        <div class="Rtable-cell">'+data.title+'</div>\
        <div class="Rtable-cell">'+data.note+'</div>\
        <div class="Rtable-cell">'+data.created_at+'</div>\
        <div class="Rtable-cell">'+data.updated_at+'</div>\
        <div class="Rtable-cell text-center">\
            <a class="btn btn-sm btn-outline-primary px-3 mx-1 rounded-0 " href="/products/job/'+data.id+'/edit">編輯</a>\
            <a class="btn btn-sm btn-outline-danger px-3 mx-1 rounded-0" href="javascript:doForward(\'/products/job/'+data.id+'/delete/\',\'確定要刪除 '+data.name+' 嗎?\');">刪除</a>\
        </div>'
    })
    $('#postDatas').replaceWith(post_str)
}
</script>
@endsection


@section('content')

<div class="container spacing"> 
    <div class="row justify-content-center">    
        <div class="col-md-12 pb-5">
                <div class="d-flex align-items-center justify-content-between">
                    <h1>貼文列表</h1>                        
                    <div>
                        <a href="#" class="sorting">順序&#x25BC;</a>
                        <a href="/products/job/content/new/" class="btn btn-primary btn-sm rounded-0">新增貼文</a>
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
        {{-- <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>note</th>
            </tr>
            </thead>
            <tbody id="tbody1">
            </tbody>
        </table> --}}
            <a class="btn btn-primary" id="btn-pre">Previous</a>
            <a class="btn btn-primary" id="btn-next">Next</a>
        </div>
        {{-- <div class="col-md-8">
            <div class="card-body">
                <form method="POST" action="{{ route('post') }}">
                    @csrf
                    <h2 class="text-center">Posting</h2>
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">{{ __('Title') }}</label>

                        <div class="col-md-10">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-md-2 col-form-label">{{ __('Note') }}</label>

                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" value="{{ old('note') }}"></textarea>
                            </div>

                            @if ($errors->has('note'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="author" class="col-md-2 col-form-label">{{ __('Author') }}</label>

                        <div class="col-md-10">
                            <input id="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" value="{{ old('author') }}" required>

                            @if ($errors->has('author'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('author') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    

                    <div class="form-group row mb-0">
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>  
</div>

@endsection