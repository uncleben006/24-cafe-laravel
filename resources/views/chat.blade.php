@extends('layouts/app')

@section('chat-room-nav')
active    
@endsection

@section('script')
<script type="text/javascript">
    // $(function() {
    //     setTimeout(getUpdate, 1000);
    //     // 偵測 Form 送出事件
    //     $('#chat-form').submit(function(event) {
    //         // 阻止 Form 透過預設方法送出
    //         event.preventDefault();
    //         // 取得使用者輸入的 Message
    //         var message = $('#message').val();
    //         console.log(message);
    //         $.post('/chat', {
    //             'message': message
    //         }, function(resp) {
    //             console.log(resp);
    //         });
    //         // 清空使用者輸入框
    //         $('#message').val('');
    //         // 游標對焦
    //         $('#message').focus();
    //     });
    // });
    // function getUpdate() {
    //     $.get('/chat/all', {}, function(resp) {
    //         console.log(resp);
    //         var str = '';
    //         for( var index in resp ) {
    //             var chat = resp[index];
    //             str += chat.author + ': ' + chat.message + "\n";
    //         }
    //         $('#chat-disp').val(str);
    //     });
    //     setTimeout(getUpdate, 1000);
    // }
    
    var messages = [];
    $(function () {

        getAllData();
        getSingleData();

        // setInterval(getSingleData(), 3000);

        $('#chat-form').submit(function (event) {
            // 阻止 Form 透過預設方法送出
            event.preventDefault();
            var message = $('#message').val();
            console.log(message);
            // post 聊天內容給此頁
            $.post('/chat',{ 'message': message }, function (resp) {
                console.log('post response ',resp);
            });
            // 清空使用者輸入框
            $('#message').val('');
            // 游標對焦
            $('#message').focus();            
        })
    })

    // 取得所有聊天資料並更新 textarea
    function getAllData() {
        $.getJSON('/chat/all', function (json) {            
            messages = json;
            var str='';
            json.forEach(function (data) {
                str+=data.author+': '+data.message+'\n';
            })
            $('#chat-disp').val(str);
        })
    }

    // 取得最後一筆聊天資料並更新 textarea
    function getSingleData() {
        $.getJSON('/chat/last/', function (json) {
            if(json.id>messages.length){
                messages.push(json);
                var str = '';
                messages.forEach(function (data) {
                    str+=data.author+': '+data.message+'\n';
                })
                $('#chat-disp').val(str);                
            }            
            setTimeout(getSingleData(),100);            
        })
    }
</script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="h2 mb-0 card-heading">Chat Room</div>
                </div>
                <div class="card-body">                    
                    <form id="chat-form">
                        <div class="form-group">
                            <textarea class="form-control" rows="10" id="chat-disp" readonly="true"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="message" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection