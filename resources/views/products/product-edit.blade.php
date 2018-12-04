@extends('layouts/app')

@section('products-admin-nav','active')

@section('script')
<script>
$(function() {    

    // 抓取 image api 顯示現在的圖片，
    // 缺點是 input 裡無法顯示
    $.getJSON('/api/products/{{$data[0]->id}}/images', function (json) {
        // console.log(json);
        var domain = window.location.origin;
        json.forEach(function (e) {
            var image_path = domain + '/storage/images/' + e.product_id + '/' + e.filename
            $('#images-preview').append('<img src="'+ image_path +'" alt="" style="height: 150px; margin: 0 1rem 1rem 0">')
        })        
        console.log(image_path);
    })

    // Give current url to form
    var currentUrl = window.location.href;
    $('#product-edit').attr('action',currentUrl);

    // Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        var filesInput = document.getElementById("images");        
        filesInput.addEventListener("change", function(event){            
            var files = event.target.files; //FileList object
            console.log(files)
            var output = document.getElementById("images-preview");
            output.innerHTML='';            
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                    continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event){                    
                    var picFile = event.target;                    
                    var span = document.createElement("span");                    
                    span.innerHTML = "<img style='height: 150px; margin: 0 1rem 1rem 0' src='" + picFile.result + "'" +
                            "title='" + picFile.name + "'/>";                    
                    output.insertBefore(span,null);           
                });                
                //Read the image
                picReader.readAsDataURL(file);
            }           
        });
    }
    else
    {
        console.log("Your browser does not support File API");
    }
});
</script>
@endsection

@section('content')
<div class="container spacing">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$data[0]->name}}</div>

                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">產品名稱</label>
        
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$data[0]->name}}" required autofocus>
        
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="class" class="col-md-4 col-form-label">產品類別</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="class" name="class">
                                            <option value="racket">羽球拍</option>
                                            <option value="footwear">羽球鞋</option>
                                            <option value="bag">拍包袋 & 背包</option>
                                            <option value="apparel">服裝</option>
                                            <option value="accessory">羽球、配件及器材</option>
                                        </select>
                                    </div>                            
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label">產品價格</label>
                
                                    <div class="col-md-8">
                                        <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{$data[0]->price}}" required>
                
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">           
        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="series" class="col-md-4 col-form-label">系列</label>
        
                                    <div class="col-md-8">
                                        <input id="series" type="text" class="form-control" name="series" value="{{$data[0]->series}}" placeholder="亮劍系列...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label">分類</label>
        
                                    <div class="col-md-8">
                                        <input id="category" type="text" class="form-control" name="category" value="{{$data[0]->category}}" placeholder="速度、進攻...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="rank" class="col-md-4 col-form-label">等級</label>
        
                                    <div class="col-md-8">
                                        <input id="rank" type="text" class="form-control" name="rank" value="{{$data[0]->rank}}" placeholder="適合初級...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="brand" class="col-md-4 col-form-label">品牌</label>
        
                                    <div class="col-md-8">
                                        <input id="brand" type="text" class="form-control" name="brand" value="{{$data[0]->brand}}" placeholder="VICTOR...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="introduction" class="col-md-2 col-form-label">產品簡介<br><small>(簡介呈現於外面的產品卡)</small></label>
                
                                    <div class="col-md-10">
                                        <textarea id="introduction" type="text" class="form-control{{ $errors->has('introduction') ? ' is-invalid' : '' }}" name="introduction" rows="5">{{$data[0]->introduction}}</textarea>
                
                                        @if ($errors->has('introduction'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('introduction') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="detail" class="col-md-2 col-form-label">產品詳述<br><small>(詳述呈現於產品內頁)</small></label>
                
                                    <div class="col-md-10">
                                        <textarea id="detail" type="text" class="form-control{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="detail" rows="5">{{$data[0]->detail}}</textarea>
                
                                        @if ($errors->has('detail'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('detail') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="html" class="col-md-2 col-form-label">產品延伸資訊<br><small>(延伸資訊會顯示於產品下方圖片上方，使用HTML編輯)</small></label>
                
                                    <div class="col-md-10">
                                        <textarea id="html" type="text" class="form-control{{ $errors->has('html') ? ' is-invalid' : '' }}" name="html" rows="5">{{$data[0]->html}}</textarea>
                
                                        @if ($errors->has('html'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('html') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="images" class="col-md-2 col-form-label">上傳圖片</label>
                                    <div class="col-md-10">
                                        <div class="input-group mb-3">
                                            <input id="images" type="file" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" name="images[]" multiple>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif                                
                                    </div>
                                </div>
                            </div>
                        </div>             
        
                        <div class="text-center">
                            <div id="images-preview"></div>
                            <a href="/products/job/list" class="btn btn-sm btn-secondary rounded-0">返回</a>
                            <button type="submit" class="btn btn-sm btn-primary rounded-0">確認修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection