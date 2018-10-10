@section('style')
<style>
#product_list .card{
    min-height: 400px;
    height: 100%;
}
#product_list .card-header {
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}
#product_list .card-header .img-fluid {
    max-width: 100%;
    max-height: 100%;
}
</style>
@endsection

@section('content')
{{-- sorting start --}}
<div class="container d-flex mb-5">
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">系列</button>
        <div class="dropdown-menu" id="series-dropdown">
        </div>
    </div>
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">分類</button>
        <div class="dropdown-menu" id="categories-dropdown">
        </div>
    </div>    
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">等級</button>
        <div class="dropdown-menu" id="rank-dropdown">
        </div>
    </div>  
    <div class="dropdown mr-5">
        <button class="btn sorting-primary dropdown-toggle" type="button" data-toggle="dropdown">品牌</button>
        <div class="dropdown-menu" id="brands-dropdown">
        </div>
    </div>  
</div>
{{-- sorting end --}}
{{-- product card start --}}
<div class="container">
    <div class="row justify-content-center" id="product_list">       
        <div class="loading loading-content"></div>        
    </div>    
</div>
{{-- product card end --}}
@endsection