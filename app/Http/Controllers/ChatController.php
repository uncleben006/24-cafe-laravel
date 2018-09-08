<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Chat;
use Auth;

class ChatController extends Controller
{
    // 代表經過這個 controller 要先通過用戶認證
    public function __construct(){
        $this->middleware('auth');
    }
    // show chat.blade.php
    public function index() {
        return view('chat');
    }
    // 印出所有聊天內容
    public function all() {
        $chat = Chat::all();
        // 取得關聯
        foreach ($chat as $key => $value) {
            $value->author = $value->author()->first()->name;
            // echo "key = $key<br>";
            // echo "value = $value<br><br>";            
        }
        return $chat;
    }
    // 印出最後一個聊天內容
    public function last(){
        $count = Chat::count();
        $data = Chat::find($count);
        $data->author = $data->author()->first()->name;
        return $data;
    }
    // 輸入所有聊天內容
    public function create(Request $request){
        $message = $request->input('message');
        $data = [
            'message'=>$message,
            'author'=>Auth::user()->id
        ];
        return Chat::create($data);
    }
}