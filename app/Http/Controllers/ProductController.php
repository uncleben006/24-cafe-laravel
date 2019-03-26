<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Filter;
use Log;
use Auth;

// Facades
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
    public function job(Request $request) 
    {
        // return $request->all();
        $product_data = Product::all();
        $filter_data = Filter::all();
        $order = $request->order ? $request->order : 'asc';

        if($request->productSort) {
            $product_data = Product::orderBy($request->productSort, $order)->get();            
        }
        if($request->filterSort) {
            $filter_data = Filter::orderBy($request->filterSort, $order)->get();
        }        
        return view('products.product-job-list',[
            'productDatas' => $product_data,
            'filterDatas'=>$filter_data
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
            'imgs' => $product_img,
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
        $product_data = Product::where('class', $class);

        if( $request->series ) {
            $product_data = $product_data->where('series', $request->series );
        }
        if( $request->category ) {
            $product_data = $product_data->where('category', $request->category );
        }
        if( $request->rank ) {
            $product_data = $product_data->where('rank', $request->rank );
        }
        if( $request->brand ) {
            $product_data = $product_data->where('brand', $request->brand );
        }
        if( $request->ordering ) {
            if ( $request->ordering == 'price-low' ) {
                $product_data = $product_data->orderBy('price');
            }            
            else if ( $request->ordering == 'price-high' ) {
                $product_data = $product_data->orderBy('price', 'desc');
            }
        }
        
        $product_img = ProductImage::where('class', $class)->get();
        $product_filter_data = Filter::where('product_class', $class)->orderBy('sequence')->get();
        $product_filter_class = Filter::where('product_class', $class)->select('filter_class')->get()->unique('filter_class');
        foreach ($product_filter_class as $key => $value) {
            // echo "key = $key<br>";
            // echo "value = $value<br>";
            switch ($value->filter_class) {
                case 'series':
                    $value->translation = '系列';
                    break;
                case 'category':
                    $value->translation = '分類';
                    break;
                case 'series':
                    $value->translation = '等級';
                    break;
                case 'series':
                    $value->translation = '品牌';
                    break;
                default:
                    break;
            }
        }
        // return 'complete';
        // return $request->all();
        // return $product_data->orderBy('price')->get();
        // return $product_img;
        // return $product_filter_class;
        // return $product_filter_data;
        
        return view('products.product-list',[
            'class' => $class,
            'filter_classes' => $product_filter_class,
            'filter_datas' => $product_filter_data,
            'datas' => $product_data->get(),
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
            'introduction'=>$request->introduction,
            'detail'=>$request->detail,
            'class'=>$request->class,
            'category'=>$request->category,
            'series'=>$request->series,
            'rank'=>$request->rank,
            'brand'=>$request->brand,
            'topSection'=>$request->topSection,
            'middleSection'=>$request->middleSection,
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
            'data' => $product_data
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
            'introduction' => $request->introduction,
            'detail'=>$request->detail,
            'series' => $request->series,
            'category' => $request->category,
            'rank' => $request->rank,
            'brand' => $request->brand,
            'topSection'=>$request->topSection,
            'middleSection'=>$request->middleSection
        ]);
        // 改圖
        self::updateImage($id,$request);
        return redirect('/products/job/list');
    }
    /**
     * Display the product edit form to edit the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editFilter($id)
    {
        $filter_data = Filter::where('id', $id)->get();
        return view('products.product-filter-edit', [
            'filterDatas'=>$filter_data
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFilter(Request $request, $id)
    {      
        // 改 Filter 資料庫 
        Filter::where('id', $id)
        ->update([
            'product_class' => $request->product_class,
            'filter_class' => $request->filter_class,
            'filter_name' => $request->filter_name,
            'sequence' => $request->sequence,
        ]);
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
    /**
     * Remove the filter data from database
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFilter($id)
    {
        Filter::destroy($id);
        return redirect('/products/job/list');
    }
}