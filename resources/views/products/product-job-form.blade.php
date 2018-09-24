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
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        console.log(fileName);
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    });
});

</script>
@endsection

@section('content')
<div class="container">
    <h1>新增產品</h1>    
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">您的資料</div>

                <div class="card-body">
                    <form method="POST" action="/products/job/new/" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">產品名稱</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">產品價格</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="" required>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">敘述</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="5"></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">上傳圖片</label>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    {{-- <div class="custom-file">
                                        <input type="file" class="custom-file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image" name="image" multiple>
                                        <label class="custom-file-label" for="image">尚未選擇檔案</label>
                                    </div> --}}
                                    <input id="images" type="file" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" name="images[]" multiple>
                                </div>
                                

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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