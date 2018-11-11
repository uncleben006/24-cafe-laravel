<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function all(Request $request) {
        $chat = Chat::where('product_id', $request->id)->get();
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
        $data = Chat::orderBy('created_at', 'desc')->first();
        $data->author = $data->author()->first()->name;
        return $data;
    }
    // 輸入所有聊天內容
    public function create(Request $request){
        $data = [
            'message'=>$request->input('message'),
            'product_id'=>$request->input('product_id'),
            'author'=>Auth::user()->id,
        ];
        return Chat::create($data);
    }
}