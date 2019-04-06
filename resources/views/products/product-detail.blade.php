@extends('layouts/app') 
{{-- nav-bar --}} 
@section('badminton-nav','active') 
@section('badminton-subnav', 'show-dropdown')

@switch($class) 
    @case('racket') 
        @section('badminton-rackets', 'subnav-active') 
        @break 
    @case('footwear') 
        @section('badminton-footwears','subnav-active') 
        @break 
    @case('apparel') 
        @section('badminton-apparels', 'subnav-active') 
        @break 
    @case('bag') 
        @section('badminton-bags','subnav-active') 
        @break 
    @case('accessory') 
        @section('badminton-accessories', 'subnav-active') 
        @break 
    @default 
@endswitch

@section('style')
<style>
    .modal .modal-dialog {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%)!important;
    }
    input[type=number] {
        width: 3em;
        padding: 0.25rem;
    }

    .img-fluid {
        margin: 0 auto;
        max-width: 100%;
        max-height: 100%;
    }

    .list-group-item {
        padding: 0.25rem 1.25rem;
        height: 50px;
        width: auto;
    }

    .list-group-item img {
        height: 50px;
        width: auto;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .reply .list-group-item {}

    .author-data {
        font-size: 1rem;
    }

    @media ( min-width: 992px) {
        .list-group-item {
            height: auto;
            width: 100%;
        }
        .list-group-item img {
            height: auto;
            width: 100%;
        }
        #image-overview img {
            /* height: 30vw; */
            max-height: 400px;
        }
    }
</style>
@endsection
 
@section('script')
<script>
    $(function() {
    var product_datas = {!! $datas !!};
    var product_id = product_datas[0].id;
    showImage({!! $imgs !!});
    getAllData(product_id);
    console.log(product_id)
    $('#chat-form').submit(function (event) {
        event.preventDefault();
        var message = $('#message').val();
        $.post('/chat',{ 'message': message, 'product_id': product_id }, function (resp) {
            console.log('post response ',resp);
        });
        $('#message').val('');
        $('#message').focus();            
    })
    @auth
    $('.add-to-cart').on('click',function(e){
        e.preventDefault();
        var qty = $('input[name=qty]')[0].value
        var user_id = '{{Auth::user()->id}}'
        $.post('./cart',{ 'qty': qty, 'product_id': product_id, 'user_id': user_id }, function (resp) {
            console.log(resp);
            if(resp.status=='success'){
                // 加入購物車成功
                $('#result .modal-title').text('成功通知')
                $('#result .modal-body').text('已成功加入購物車')
                $('#result').modal('toggle')
                setTimeout(() => {                    
                    $('#result').modal('toggle')
                }, 1250);                       
                var num = resp.number
                console.log(num)     
                $('.shopping-cart-bubble').text(num)
            }
            else {
                $('#result .modal-title').text('失敗通知')
                $('#result .modal-body').text('加入購物車失敗')
                $('#result').modal('toggle')
            }
        }).fail(function(){
            $('#result .modal-title').text('失敗通知')
            $('#result .modal-body').text('加入購物車失敗')
            $('#result').modal('toggle')
        })
    })
    @endauth
});
// 取得圖片
function showImage(php_datas) {
    var thumbnail = ''
    var overview = ''
    php_datas.forEach(function (img) {
        // console.log(img)
        thumbnail += '<a class="list-group-item list-group-item-action p-0 mb-lg-2" id="'+img.id+'" data-toggle="tab" href="#list-'+img.id+'">\
                        <img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid">\
                    </a>'
        overview += '<div class="tab-pane fade zooming" id="list-'+img.id+'">\
                        <img src="/storage/images/'+img.product_id+'/'+img.filename+'" alt="'+img.filename+'" class="img-fluid ">\
                    </div>'
    })        
    $('#image-thumbnail').html(thumbnail)
    $('#image-overview').html(overview)
    $($('.tab-content')[0].firstChild).addClass('active show')
    $('.zooming').zoom({magnify: 1});
};
// 取得所有聊天資料並更新 textarea
function getAllData(product_id) {
    $.getJSON('/chat/all/'+product_id, function (json) {
        var str='';
        var floar = 1;
        var reply = document.querySelector('.reply');
        json.forEach(function (data) {
            var listGroupItem = document.createElement('li');
            var authorData = document.createElement('div');
            var dataMessage = document.createElement('div');
            listGroupItem.setAttribute('class', 'list-group-item rounded-0');
            authorData.setAttribute('class', 'author-data');
            authorData.textContent = (data.author)+' ['+floar+']'+'樓';
            dataMessage.textContent = data.message;            
            listGroupItem.appendChild(authorData).appendChild(dataMessage);
            reply.appendChild(listGroupItem);
            floar++
        })        
    })
};

</script>
@endsection
 
@section('content') {!! $datas[0]->topSection !!}
<div class="container @unless($datas[0]->topSection) spacing @endunless">
    {{-- 產品區 --}}
    <div class="row">
        <div class="col-lg-8">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-2 pt-3 pt-lg-0">
                    <div class="list-group flex-row flex-lg-column" id="image-thumbnail">
                        <div class="loading"></div>
                    </div>
                </div>
                <div class="col-lg-10 img-overview px-0 d-flex justify-content-center align-items-center">
                    <div class="tab-content border" id="image-overview">
                        <div class="loading"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 pt-3 pt-lg-0">
            <div class="d-flex justify-content-between flex-column h-100">
                <div>
                    <h2>{{$datas[0]->name}}</h2>
                    <h4>NT. {{$datas[0]->price}}</h4>
                    <div class="row py-3">
                        @if($datas[0]->series)
                        <div class="col-lg-6">
                            <div>系列: {{$datas[0]->series}}</div>
                        </div>@endif @if($datas[0]->category)
                        <div class="col-lg-6">
                            <div>分類: {{$datas[0]->category}}</div>
                        </div>@endif @if($datas[0]->rank)
                        <div class="col-lg-6">
                            <div>等級: {{$datas[0]->rank}}</div>
                        </div>@endif @if($datas[0]->brand)
                        <div class="col-lg-6">
                            <div>品牌: {{$datas[0]->brand}}</div>
                        </div>@endif
                    </div>
                    <div class="border p-3">{!! $datas[0]->detail !!}</div>
                    <form class="d-flex align-items-center mt-3" id="product-info" method="post">
                        <input type="number" min="1" value="1" name="qty" size="4">
                        <input type="hidden" value="{{$datas[0]->price}}" name="price">
                        <input type="hidden" value="{{$datas[0]->name}}" name="name">
                        <input type="submit" class="btn btn-primary rounded-0 ml-3 add-to-cart" value="加入購物車" formaction="./cart">
                        <input type="submit" class="btn btn-primary rounded-0 ml-3" value="立即購買" formaction="{{url('/')}}/payment/order">
                    </form>
                </div>
                <div>最後編輯: {{$datas[0]->created_at}}</div>
            </div>
        </div>
    </div>
    {!! $datas[0]->middleSection !!} {{-- 留言區 --}}
    <div class="row py-5">
        <div class="col-lg-8" style="max-height: 15rem; min-height: 10rem">
            <ul class="list-group h-100">
                <li class="list-group-item d-flex justify-content-between align-items-center border" style="z-index: 2;">查看留言<span class="badge badge-primary badge-pill reply-number"></span></li>
                <div style="overflow: auto;" class="border h-100 reply">
                    @unless (Auth::check())
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center ">您尚未登入，請先登入才能查看留言~</div>
                    @endunless
                </div>
            </ul>
        </div>
        @if(Auth::check())
        <div class="col-lg-4" style="max-height: 15rem; min-height: 10rem">
            <form id="chat-form" class="h-100">
                <ul class="list-group h-100">
                    <li class="list-group-item d-flex justify-content-between align-items-center">留言牆<span>發言人: {{Auth::user()->name}} </span></li>
                    <div class="form-group mb-0 h-100">
                        <textarea id="message" class="form-control rounded-0 h-100"></textarea>
                    </div>
                    <input class="btn btn-sm rounded-0 w-100" type="submit" value="留下評論">
                </ul>
            </form>
        </div>
        @else
        <div class="col-lg-4" style="max-height: 15rem; min-height: 10rem">
            <ul class="list-group h-100">
                <li class="list-group-item d-flex justify-content-between align-items-center">留言牆</li>
                <div class="form-group mb-0 h-100">
                    <div class="form-control rounded-0 h-100 d-flex justify-content-center align-items-center" readonly>您尚未登入，請先登入才能留言與查看留言</div>
                </div>
                <button class="btn btn-sm rounded-0 w-100" style="cursor: not-allowed">留下評論</button>
            </ul>
        </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="result">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endsection