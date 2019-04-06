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
        foreach ($chat as $value) {
            
            if ( isset($value->author()->first()->name) ) {
                $value->author = $value->author()->first()->name;
            }else {
                $value->author = '此用戶已經被刪除了';
            }
        }
        return $chat;
    }
    // 輸入所有聊天內容
    public function create(Request $request){
        
        $count_first = Chat::count();
        $data = Chat::create([
            'message'=>$request->message,
            'product_id'=>$request->product_id,
            'author'=>Auth::user()->id,
        ]);
        $count_second = $data->count();
        if ($count_second>$count_first){
            $chat = Chat::where('product_id',$request->product_id)->get();
            // 取得關聯
            foreach ($chat as $key => $value) { 
                if ( isset($value->author()->first()->name) ) {
                    $value->author = $value->author()->first()->name;
                }else {
                    $value->author = '此用戶已經被刪除了';
                }
            }
            return [ 'status'=>'success', 'data'=> $chat ];
        }else {
            return 'fail';
        }
        
    }
}