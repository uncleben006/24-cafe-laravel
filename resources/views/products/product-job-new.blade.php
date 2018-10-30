@extends('layouts/app')

@section('products-admin-nav','active')

@section('style')
<style>
.custom-file-label::after {
    content: '選擇檔案' !important;
}
</style>
@endsection

@section('script')
<script>

$(function () {

    // $('.custom-file-input').on('change', function() {
    //     let fileName = $(this).val().split('\\').pop();
    //     console.log(fileName);
    //     $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    // });

    // Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        var filesInput = document.getElementById("images");        
        filesInput.addEventListener("change", function(event){            
            var files = event.target.files; //FileList object
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
        
    <div class="card mb-5">
        <div class="card-header"><h1 class="mb-0 text-center" >新增產品</h1></div>
        <div class="card-body">
            <form method="POST" action="/products/job/new/" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">產品名稱</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>
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
                                    <option value="bag">羽球袋</option>
                                    <option value="apparel">羽球衣</option>
                                    <option value="accessory">羽球配件及器材</option>
                                    <option value="coffee">咖啡</option>
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label">產品價格</label>
        
                            <div class="col-md-8">
                                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="" required>
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
                                <input id="series" type="text" class="form-control" name="series" value="" placeholder="亮劍系列...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label">分類</label>

                            <div class="col-md-8">
                                <input id="category" type="text" class="form-control" name="category" value="" placeholder="速度、進攻...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="rank" class="col-md-4 col-form-label">等級</label>
                            <div class="col-md-8">
                                <input id="rank" type="text" class="form-control" name="rank" value="" placeholder="適合初級...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label">品牌</label>
                            <div class="col-md-8">
                                <input id="brand" type="text" class="form-control" name="brand" value="" placeholder="VICTOR...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label">敘述</label>        
                            <div class="col-md-10">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label">上傳圖片</label>
                            <div class="col-md-10">
                                <div class="input-group mb-3">
                                    <input id="images" type="file" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" multiple>
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
                    <button type="submit" class="btn btn-sm btn-primary rounded-0">
                        新增產品
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection