@section('script')
<script>
$(function() {    
    var url = new URL(window.location.href);
    var pathname = url.pathname;
    var search = url.search;
    $.getJSON('/api'+pathname+'sorting', function(s_json) {
        s_json.series.forEach(function(data){
            if(data.series){
                $('#series-dropdown').append('<a class="dropdown-item" href="?series='+data.series+'">'+data.series+'</a>')
            }
        })
        s_json.categories.forEach(function(data){
            if(data.categories){
                $('#categories-dropdown').append('<a class="dropdown-item" href="?category='+data.categories+'">'+data.categories+'</a>')            
            }
        })
        s_json.rank.forEach(function(data){
            if(data.rank){
                $('#rank-dropdown').append('<a class="dropdown-item" href="?rank='+data.rank+'">'+data.rank+'</a>')
            }
        })
        
    });
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
        })
    })
    .done(function() {
        $('.loading-content').remove();    
    })
});
</script>
@endsection