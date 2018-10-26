<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Racket;
use App\Footwear;
use App\Bag;
use App\Apparel;
use App\Accessory;
use Log;
use Auth;
use Illuminate\Support\Facades\Storage;

use Image;
use Illuminate\Support\Str;

// Validator
use Validator;

class ProductController extends Controller
{
    /**
     * Display all products api
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        // 把各類的產品資料庫都merge起來，去掉id，sortby product_id
        $racket = Racket::all();
        $footwear = Footwear::all();
        $bag = Bag::all();
        $apparel = Apparel::all();
        $accessory = Accessory::all();
        $product = [
            'racket'=>$racket,
            'footwear'=>$footwear,
            'bag'=>$bag,
            'apparel'=>$apparel,
            'accessory'=>$accessory
        ];    
        return $product;
        
        $merge = Racket::all()->merge(Footwear::all());    
        return Racket::all();
    }
    /**
     * Display rackets api
     */
    public function filterApi(Request $request, $class)
    {
        return Product::where('class', $class)->get();   
    }
    /**
     * Display single product api
     */
    public function singleApi($id)
    {
        return Product::find($id);
    }
    /**
     * Display images api
     */
    public function imagesApi($id)
    {
        return ProductImage::where('product_id', $id)->get();
    }  
    /**
     * Display sorting api
     */
    public function sortingApi($category)
    {
        switch ($category) {
            case 'rackets':
                $table = Racket::class;
                break;
            case 'footwears':
                $table = Footwear::class;
                break;
            case 'bags':
                $table = Bag::class;
                break;
            case 'apparels':
                $table = Apparel::class;
                break;
            case 'accessories':
                $table = Accessory::class;
                break;
        }  
        $categories = $table::select('categories')->get()->unique('categories');
        foreach ($categories as $key => $value) {
            $categoriesArray []= $value->categories;
        }
        $series = $table::select('series')->get()->unique('series');
        foreach ($series as $key => $value) {
            $seriesArray []= $value->series;
        }
        $rank = $table::select('rank')->get()->unique('rank');
        foreach ($rank as $key => $value) {
            $rankArray []= $value->rank;
        }
        $brands = $table::select('brands')->get()->unique('brands');
        foreach ($brands as $key => $value) {
            $brandsArray []= $value->brands;
        }
        $sorting = [
            'categories' => $categoriesArray,
            'series' => $seriesArray,
            'rank' => $rankArray,
            'brands' => $brandsArray
        ];
        return $sorting;
    }    
    /**
     * Display product job. 
     * Including add, edit and delete function to adjust product database. 
     * Will only show on administrator's navigation.
     */
    public function job() 
    {
        return view('products.product-job');
    }
    /**
     * Display product form to create a new product.
     *
     */
    public function jobForm()
    {
        return view('products.product-job-form');
    }       
    /**
     * Display product detail page.
     *
     * @param  int  $id
     */
    public function showDetail($category, $id)
    {        
        switch ($category) {
            case 'rackets';
                $array = Product::find($id)->racket()->first();
                break;
            case 'footwears';
                $array = Product::find($id)->footwear()->first();
                break;
            case 'bags';
                $array = Product::find($id)->bag()->first();
                break;
            case 'apparels';
                $array = Product::find($id)->apparel()->first();
                break;
            case 'accessories';
                $array = Product::find($id)->accessory()->first();
                break;
        }
        return view('products.product-detail', [
            'product' => $array,
        ]);
    } 
    public function showCoffee(){
        return view('products.product-coffee');
    }
    /**
     * Display products rackets list
     */
    public function list($class)
    {        
        $product_data = Product::where('class', $class)->get();
        $product_img = ProductImage::where('class', $class)->get();
        // return $product_data;
        // return $product_img;
        
        return view('products.product-list',[
            'class' => $class,
            'datas' => $product_data,
            'imgs' => $product_img
        ]);
    }    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'class'=>$request->class,
            'category'=>$request->category,
            'series'=>$request->series,
            'rank'=>$request->rank,
            'brand'=>$request->brand
        ]);        
        $id = $product->id;
        self::storeImage($id,$request);     
        return redirect('/products/job/list');     
    } 
    /**
     * Store images into product image database.
     */
    public function storeImage($id, $request)
    {                
        $image_path = '/public/images/'.$id.'/';
        if($request->image){
            foreach ($request->image as $image) {
                $fileName = $image->getClientOriginalName();     
                $image->storeAs($image_path, $fileName);
                ProductImage::create([
                    'product_id' => $id,
                    'class' => $request->class,
                    'filename' => $fileName
                ]);
            }   
        }                      
    }
    /**
     * Display the product edit form to edit the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($category, $id)
    {
        $array = [];
        switch ($category) {
            case 'racket';
                $array = Product::find($id)->racket()->first();
                break;
            case 'footwear';
                $array = Product::find($id)->footwear()->first();
                break;
            case 'bag';
                $array = Product::find($id)->bag()->first();
                break;
            case 'apparel';
                $array = Product::find($id)->apparel()->first();
                break;
            case 'accessory';
                $array = Product::find($id)->accessory()->first();
                break;
        }
        return view('products.product-edit', [
            'product' => $array,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category, $id)
    {        
        $validate = Validator::make($request->all(), [
            'name'=>'required:',
            'price'=>'required|integer',
        ]);       
        
        if ($validate->fails()) {
            return redirect("/products/$category/$id/edit/")
                        ->withErrors($validate)
                        ->withInput();
        }     
        // 如果有上傳圖片，則刪除原本資料結構裡的圖片，
        // 同時刪除資料庫裡的圖片，並新增新的圖

        // 改 Product 資料庫 (主資料庫)
        Product::where('id', $id)
        ->update([
            'name' => $request->name,
        ]);

        // 改圖
        self::updateImage($id,$request);

        // 如果 User 選的類別汗腺在是一樣的，那就在現在這個 Model更新，若否則刪除並再新的 Model 新增
        if($request->category==$category){
            switch ($category) {
                case 'racket';
                    self::updateRacket($id, $request);     
                    break;
                case 'footwear';
                    self::updateFootwear($id, $request);
                    break;
                case 'bag':
                    self::updateBag($id, $request);
                    break;
                case 'apparel':
                    self::updateApparel($id, $request);
                    break;
                case 'accessory':
                    self::updateAccessory($id, $request);
                    break;
            }
        }
        // 若否則刪除並再新的 Model 新增
        else {
            // self::destroy($id);
            switch ($category) {
                case 'racket';
                    Racket::where('product_id', $id)->delete();
                    break;
                case 'footwear';
                    Footwear::where('product_id', $id)->delete();
                    break;
                case 'bag':
                    Bag::where('product_id', $id)->delete();
                    break;
                case 'apparel':
                    Apparel::where('product_id', $id)->delete();
                    break;
                case 'accessory':
                    Accessory::where('product_id', $id)->delete();
                    break;
            }
            switch ($request->category) {
                case 'racket':
                    self::storeRacket($id, $request);
                    break;
                case 'footwear':
                    self::storeFootwear($id, $request);
                    break;
                case 'bag':
                    self::storeBag($id, $request);
                    break;
                case 'apparel':
                    self::storeApparel($id, $request);
                    break;
                case 'accessory':
                    self::storeAccessory($id, $request);
                    break;
            }
        }
        return redirect('/products/job/list');
    }
    /**
     *  Update racket
     */
    public function updateRacket($id, $request)
    {              
        $racket = Racket::where('product_id', $id)
        ->update([
            'product_id'=>$id,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description? $request->description : '無',
            'series'=>$request->series? $request->series : '其他',
            'categories'=>$request->categories? $request->categories : '其他',
            'rank'=>$request->rank? $request->rank : '其他',
            'brands'=>$request->brands? $request->brands : '其他'
        ]);
    }
    /**
     *  Update footwear
     */
    public function updateFootwear($id, $request)
    {    
        $racket = Footwear::where('product_id', $id)
        ->update([
            'product_id'=>$id,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description? $request->description : '無',
            'series'=>$request->series? $request->series : '其他',
            'categories'=>$request->categories? $request->categories : '其他',
            'rank'=>$request->rank? $request->rank : '其他',
            'brands'=>$request->brands? $request->brands : '其他'
        ]);
    }
    /**
     *  Update bag
     */
    public function updateBag($id, $request)
    {    
        $racket = Bag::where('product_id', $id)
        ->update([
            'product_id'=>$id,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description? $request->description : '無',
            'series'=>$request->series? $request->series : '其他',
            'categories'=>$request->categories? $request->categories : '其他',
            'rank'=>$request->rank? $request->rank : '其他',
            'brands'=>$request->brands? $request->brands : '其他'
        ]);
    }
    /**
     *  Update apparel
     */
    public function updateApparel($id, $request)
    {    
        $racket = Apparel::where('product_id', $id)
        ->update([
            'product_id'=>$id,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description? $request->description : '無',
            'series'=>$request->series? $request->series : '其他',
            'categories'=>$request->categories? $request->categories : '其他',
            'rank'=>$request->rank? $request->rank : '其他',
            'brands'=>$request->brands? $request->brands : '其他'
        ]);
    }
    /**
     *  Update accessory
     */
    public function updateAccessory($id, $request)
    {    
        $racket = Accessory::where('product_id', $id)
        ->update([
            'product_id'=>$id,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description? $request->description : '無',
            'series'=>$request->series? $request->series : '其他',
            'categories'=>$request->categories? $request->categories : '其他',
            'rank'=>$request->rank? $request->rank : '其他',
            'brands'=>$request->brands? $request->brands : '其他'
        ]);
    }
    /**
     * Update images.
     */
    public function updateImage($id, $request)
    {        
        if($request->images){
            Storage::deleteDirectory("/public/images/$id");
            $originalImages = ProductImage::where('product_id',$id);
            $originalImages->delete();     
            $image_path = '/public/images/'.$id.'/';
            foreach ($request->images as $image) {
                $fileName = $image->getClientOriginalName();                     
                $image->storeAs($image_path, $fileName);
                ProductImage::create([
                    'product_id' => $id,
                    'filename' => $fileName
                ]);
            }
        }      
    }    
    /**
     * Remove the specified file from storage, including the images inside.
     * Remove the information from products DB and product_images DB.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::deleteDirectory("/public/images/$id");
        Product::destroy($id);
        return redirect('/products/job/list');
    }
}


    // /**
    //  * Display products rackets list
    //  */
    // public function showRackets()
    // {        
    //     return view('products.product-rackets');
    // }
    // /**
    //  * Display products footwears list
    //  */
    // public function showFootwears()
    // {
    //     return view('products.product-footwears');
    // }
    // /**
    //  * Display products bags list
    //  */
    // public function showBags()
    // {
    //     return view('products.product-bags');
    // }    
    // /**
    //  * Display products apparels list
    //  */
    // public function showApparels()
    // {
    //     return view('products.product-apparels');
    // }  
    // /**
    //  * Display products accessories list
    //  */
    // public function showAccessories()
    // {
    //     return view('products.product-accessories');
    // } 

    /**
     * Display products list
     */
    // public function list()
    // {
    //     return view('products.product-list');
    // }    
    /**
     * Add product into shopping cart
     */
    // public function add_cart(Request $request, $id)
    // {
    //     $prev = $request->session()->get('cart');
    //     $arr = [];
    //     if( $prev != null ){
    //         $arr = $prev;
    //     }
    //     $arr[] = $id;
    //     $request->session()->put('cart', $arr);
    //     return (['status'=>true]);
    // }
    /**
     * Display shopping cart api
     */
    // public function list_cart(Request $request)
    // {
    //     // return json_decode($request->session()->get('cart'));
    //     // 取得當初存入 session 中的 id 陣列，然後再排序、歸類
    //     $session_value = $request->session()->get('cart');
    //     if ($session_value){
    //         sort($session_value);   
    //         $session_value = array_count_values($session_value);   
    //     } else {
    //         $session_value = array();
    //     }

    //     // 用 session id 陣列來搜尋 product，取得完整的產品資料，再傳給 $prod_list      
    //     $prod_list = [];         
    //     $i = 0;
    //     foreach($session_value as $key => $value){
    //         if(Product::find($key)){
    //             $prod_list[] = Product::find($key);
    //             $prod_list[$i]->{'quantity'} = $value;
    //         }
    //         $i++;
    //     };
    //     // echo $i;   
    //     // print_r($prod_list);
    //     return $prod_list;
    // }
    /**
     * Display shopping cart interface
     */
    // public function cart(Request $request)
    // {
    //     return view('ecommerce.product-cart');
    // }