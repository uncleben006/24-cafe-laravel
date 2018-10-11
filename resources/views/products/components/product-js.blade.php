@section('script')
<script>
$(function() {    
    var url = new URL(window.location.href);
    // url.searchParams.set('series', '亮劍')
    console.log(url);
    var pathname = url.pathname;
    var search = url.search;
    var urlParams = url.searchParams;
    var href = url.href;
    // console.log(url.href);
    // console.log(urlParams.has('categories'))
    console.log(url.searchParams.value);
    
    var sortPath = '/api'+pathname+'sorting';

    (function createSortBar(apiPath) {
        $.getJSON(apiPath, function(s_json) {
            s_json.series.forEach(function(data){
                $('#series-dropdown').append('<a class="dropdown-item prodouct-filter" data-filter="'+data+'" data-sort="series" >'+data+'</a>')
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
        .done(function(){
            var urlParameters = ''
            for(var pair of url.searchParams.entries()){
                urlParameters += pair[0]+'='+pair[1] 
            }
            var urlHref = url.href
            $('.prodouct-filter').on('click', function(){

                
                
                console.log(urlHref)

                
                console.log(urlHref)
                // window.location.href = urlHref;
                // console.log(urlPath)
                // window.location.href = pathname + '?series=&categories=&rank=&brands='
                // if( $(this).data('sort')=='series' ) {
                //     for(var pair of url.searchParams.entries()){
                //         window.location.href = pathname + '?series=&categories=&rank=&brands='
                //     }
                // }               
            })
        })
        .fail(function() {
            var sortPathUpdate = '/api'+pathname+'/sorting';
            createSortBar(sortPathUpdate)
        })   
    })(sortPath);    

    // show product list
    var productList = '';
    (function showProduct() {
        $.getJSON('/api'+pathname+search, function(p_json) {        
            p_json.forEach(function(data){
                productList += '\
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
                </div>';
                $.getJSON('/api/products/'+data.product_id+'/images', function (i_json) {
                    var domain = window.location.origin;
                    var image_path = domain + '/storage/images/' + i_json[0].product_id + '/' + i_json[0].filename;
                    $('#image-'+i_json[0].product_id).html('<img src="'+image_path+'" alt="" class="img-fluid">');
                })
                .done(function () {
                    $('.loading-image').remove();
                })
            })
            $('#product_list').html(productList);
        })
        .done(function() {
            $('.loading-content').remove();    
        })
    })()  
});
</script>
@endsection