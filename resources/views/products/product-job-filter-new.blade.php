@extends('layouts/app')

@section('products-admin-nav','active')

@section('style')
<style>
    /* * {
        border: solid 1px;
    } */
.custom-file-label::after {
    content: '選擇檔案' !important;
}
.form-group {
    align-items: center
}
</style>
@endsection

@section('content')
<div class="container spacing">
        
    <div class="card mb-5">
        <div class="card-header"><h1 class="mb-0 text-center" >新增篩選</h1></div>
        <div class="card-body">
            <form method="POST" action="/products/job/filter/new/" enctype="multipart/form-data">
                @csrf
                <div class="row">                    
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="product_class" class="col-md-4 col-form-label">產品<br>類別</label>
                            <div class="col-md-8">
                                <select class="form-control" id="product_class" name="product_class" required>
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
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="filter_class" class="col-md-4 col-form-label">篩選<br>類別</label>
                            <div class="col-md-8">
                                <select class="form-control" id="filter_class" name="filter_class" required>
                                    <option value="series">系列</option>
                                    <option value="category">分類</option>
                                    <option value="rank">等級</option>
                                    <option value="brand">品牌</option>
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="filter_name" class="col-md-4 col-form-label">篩選<br>名稱</label>        
                            <div class="col-md-8">
                                <input id="filter_name" type="text" class="form-control" name="filter_name" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="sequence" class="col-md-4 col-form-label">篩選<br>順序</label>        
                            <div class="col-md-8">
                                <input id="sequence" type="number" class="form-control" name="sequence" value="">
                            </div>
                        </div>
                    </div>
                </div>                     
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-primary rounded-0">新增產品</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection