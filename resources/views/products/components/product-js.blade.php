@section('script')
<script>
$(function() {    
    var url = new URL(window.location.href);
    let params = new URLSearchParams(url.search.slice(1));
    params.set('series', '3');
    url.searchParams.set('series', '出擊')
    console.log(url);
    var pathname = url.pathname;
    var search = url.search;
    var urlParams = url.searchParams;
    var href = url.href;
    // console.log(url.href);
    // console.log(urlParams.has('categories'))
    console.log(url.searchParams.value);
    $.getJSON('/api'+pathname+'sorting', function(s_json) {
        s_json.series.forEach(function(data){
            $('#series-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'" >'+data+'</a>')
        })
        s_json.categories.forEach(function(data){
            $('#categories-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'">'+data+'</a>')      
        })
        s_json.rank.forEach(function(data){
            $('#rank-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'">'+data+'</a>')
        })
        s_json.brands.forEach(function(data){
            $('#brands-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'">'+data+'</a>')
        })        
    })        
    $.getJSON('/api'+pathname+search, function(p_json) {
        p_json.forEach(function(data){
            $('#product_list').append('\
            <div class="col-md-3 product-card mb-5">\
                <a href="'+pathname+data.product_id+'/detail" target="_blank">\
                    <div class="card">\
                        <div class="card-header">\
                            <div id="image-'+data.product_id+'" style="position:relative">\
                                <div class="loading loading-image"></div>\
                            </div>\
                        </div>\
                        <div class="card-body">\
                            <h5 class="card-title">'+data.name+'</h5>\
                        </div>\
                        <div class="card-footer">\
                            <p class="card-text">NT. '+data.price+'</p>\
                        </div>\
                    </div>\
                </a>\
            </div>\
            ');
            $.getJSON('/api/products/'+data.product_id+'/images', function (i_json) {
                // 因為是 product list 所以放第一個當縮圖就好
                var domain = window.location.origin;
                var image_path = domain + '/storage/images/' + i_json[0].product_id + '/' + i_json[0].filename;
                $('#image-'+i_json[0].product_id).html('<img src="'+image_path+'" alt="" class="img-fluid">');
            })
            .done(function () {
                $('.loading-image').remove();
            })
        })
    })
    .done(function() {
        $('.loading-content').remove();    
    })
});
</script>
@endsection