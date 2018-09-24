@extends('layouts/app')

@section('products-admin-nav','active')

@section('script')
<script>
$(function() {    
    $.getJSON('/api/products/{{$product->id}}/images', function (json) {
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$product->name}}</div>

                <div class="card-body">
                    <form id="product-edit" method="POST" action="" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">產品名稱</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$product->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">產品價格</label>

                            <div class="col-md-10">
                                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{$product->price}}" required>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">敘述</label>

                            <div class="col-md-10">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="5">{{$product->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-2 col-form-label text-md-right">上傳圖片</label>
                            <div class="col-md-10">
                                <div class="input-group mb-3">
                                    <input id="images" type="file" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" name="images[]" multiple>
                                </div>                                

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                
                                <div id="images-preview"></div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    新增
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection