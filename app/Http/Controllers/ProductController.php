<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Filter;
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
        return Product::all();
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
     * Display product job. 
     * Including add, edit and delete function to adjust product database. 
     * Will only show on administrator's navigation.
     */
    public function job() 
    {
        $product_data = Product::all();
        return view('products.product-job-list',[
            'datas' => $product_data
        ]);
    }
    /**
     * Display product form to create a new product.
     *
     */
    public function createJob()
    {
        return view('products.product-job-new');
    } 
    /**
     * Display filter form to create a new filter tag.
     *
     */
    public function createFilter()
    {
        return view('products.product-job-filter-new');
    }             
    /**
     * Display product detail page.
     *
     * @param  int  $id
     */
    public function showDetail($class, $id)
    {      
        $product_img = ProductImage::where('product_id',$id)->get();
        $product_data =  Product::where('id',$id)->get();  
        return view('products.product-detail', [
            'class' => $class,
            'datas' => $product_data,
            'imgs' => $product_img
        ]);
    } 
    public function showCoffee(){
        return view('products.product-coffee');
    }
    /**
     * Display products rackets list
     */
    public function list(Request $request, $class)
    {        
        if ($request->series && $request->category && $request->rank && $request->brand){
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('category', $request->category )
                ->where('rank', $request->rank )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->series && $request->category && $request->rank) {
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('category', $request->category )
                ->where('rank', $request->rank )
                ->get();
        }else if ($request->series && $request->category && $request->brand) {
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('category', $request->category )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->series && $request->rank && $request->brand){
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('rank', $request->rank )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->category && $request->rank && $request->brand){
            $product_data = Product::where('class', $class)
                ->where('category', $request->category )
                ->where('rank', $request->rank )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->series && $request->category){
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('category', $request->category )
                ->get();
        }else if ($request->series && $request->rank){
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('rank', $request->rank )
                ->get();
        }else if ($request->series && $request->brand){
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->series && $request->rank){
            $product_data = Product::where('class', $class)
                ->where('category', $request->category )
                ->where('rank', $request->rank )
                ->get();
        }else if ($request->category && $request->brand){
            $product_data = Product::where('class', $class)
                ->where('category', $request->category )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->rank && $request->brand){
            $product_data = Product::where('class', $class)
                ->where('rank', $request->rank )
                ->where('brand', $request->brand )
                ->get();
        }else if ($request->series){
            $product_data = Product::where('class', $class)
                ->where('series', $request->series )
                ->get();
        }else if ($request->category){
            $product_data = Product::where('class', $class)
                ->where('category', $request->category )
                ->get();
        }else if ($request->rank){
            $product_data = Product::where('class', $class)
                ->where('rank', $request->rank )
                ->get();
        }else if ($request->brand){
            $product_data = Product::where('class', $class)
                ->where('brand', $request->brand )
                ->get();
        }else {
            $product_data = Product::where('class', $class)
                ->get();
        }
        
        $product_img = ProductImage::where('class', $class)->get();
        $product_filter_data = Filter::where('product_class', $class)->orderBy('sequence')->get();
        $product_filter_class = Filter::where('product_class', $class)->select('filter_class')->get()->unique('filter_class');
        
        // return $request->all();
        // return $product_data;
        // return $product_img;
        // return $product_filter;
        
        return view('products.product-list',[
            'class' => $class,
            'filter_classes' => $product_filter_class,
            'filter_datas' => $product_filter_data,
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
    public function storeJob(Request $request)
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
     * Store a newly created filter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFilter(Request $request)
    {
        $product = Filter::create([
            'product_class'=>$request->product_class,
            'filter_class'=>$request->filter_class,
            'filter_name'=>$request->filter_name,
            'sequence'=>$request->sequence
        ]);        
        return redirect('/products/job/list');     
    } 
    /**
     * Display the product edit form to edit the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_data = Product::where('id', $id)->get();
        // return $product_data;
        return view('products.product-edit', [
            'data' => $product_data,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $validate = Validator::make($request->all(), [
            'name'=>'required:',
            'price'=>'required|integer',
        ]);          
        if ($validate->fails()) {
            return redirect("/products/job/$id/edit/")
                        ->withErrors($validate)
                        ->withInput();
        }     
        // 改 Product 資料庫 
        Product::where('id', $id)
        ->update([
            'name' => $request->name,
            'class' => $request->class,
            'price' => $request->price,
            'description' => $request->description,
            'series' => $request->series,
            'category' => $request->category,
            'rank' => $request->rank,
            'brand' => $request->brand
        ]);
        // 改圖
        self::updateImage($id,$request);
        return redirect('/products/job/list');
    }
    /**
     * Update images.
     */
    public function updateImage($id, $request)
    {        
        // 如果有上傳圖片，則刪除原本資料結構裡的圖片，
        // 同時刪除資料庫裡的圖片，並新增新的圖
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
                    'class' => $request->class,
                    'filename' => $fileName,
                ]);
            }
        }
        else {
            ProductImage::where('product_id',$id)->update([
                'class' => $request->class
            ]);
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