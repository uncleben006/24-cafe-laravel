@extends('layouts/app')

@section('script')
<script>
$(function() {    

    $.getJSON('/products/list-cart/', function(json) {
        for( var index in json ) {
            var data = json[index];
            $('#tbody').append('\
                <tr>\
                    <td>'+data.id+'</td>\
                    <td>'+data.name+'</td>\
                    <td>'+data.price+'</td>\
                </tr>\
            ');
        }
    });       
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>All Products</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>商品名稱</th>
                        <th>價格</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            <a href="/products/" class="btn btn-danger">繼續購物</a>
        </div>
    </div>    
</div>
@endsection