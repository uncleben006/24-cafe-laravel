@extends('layouts/app')

@section('products-admin-nav','active')

@section('script')
<script>
$(function() {    


});
</script>
@endsection

@section('content')
<div class="container spacing">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">編輯篩選</div>

                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
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
                                        <input id="filter_name" type="text" class="form-control" name="filter_name" value="{{$filterDatas[0]->filter_name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="sequence" class="col-md-4 col-form-label">篩選<br>順序</label>        
                                    <div class="col-md-8">
                                        <input id="sequence" type="number" class="form-control" name="sequence" value="{{$filterDatas[0]->sequence}}">
                                    </div>
                                </div>
                            </div>
                        </div>                     
                        <div class="text-center">
                            <a href="/products/job/list" class="btn btn-sm btn-secondary rounded-0">返回</a>
                            <button type="submit" class="btn btn-sm btn-primary rounded-0">新增產品</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection