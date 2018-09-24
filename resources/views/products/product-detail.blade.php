@extends('layouts/app')

@section('products-nav')
active
@endsection

@section('script')
<script>
$(function() {    
    $.getJSON('/api/products/'+{{$product->id}}+'/images', function (i_json) {
        console.log('i_json= ', i_json)
        
        var domain = window.location.origin;
        i_json.forEach(function (e) {
            $('#tbody').append('');
        });            
    })
});
</script>
@endsection

@section('content')
<div class="container pb-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-7 text-center border p-5" id="image-block">
                    <img class="img-fluid" src="{{$product->image_path}}" alt="">
                </div>
                <div class="col-md-5 ">
                    <h2>{{$product->name}}</h2>
                    <h4>NT. {{$product->price}}</h4>
                    <p>{{$product->description}}</p>
                    <p>最後編輯: {{$product->created_at}}</p>
                </div>
            </div>            
        </div>
    </div>    
</div>
@endsection