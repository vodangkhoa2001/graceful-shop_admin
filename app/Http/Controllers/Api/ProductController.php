<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Like;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductDetail;
use App\Models\PictureRate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;
use File;
use Hash;

class ProductController extends Controller
{   
    //DS sản phẩm mới
    public function getAllNewProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }
    
    //DS sản phẩm nổi bật
    public function getAllPopularProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->where('products.popular', '=', 1)
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);
        
        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }
    
    //Chi tiết sản phẩm
    public function getProductDetailById($id)
    {
        $color = Color::select(['*', DB::raw('CONCAT("assets/img/products/",picture) AS picture')])
        ->where('status', '=', 1)->where('product_id', '=', $id)->get();

        $size = Size::where('status', '=', 1)->where('product_id', '=', $id)->get();

        $quantityOfType = ProductDetail::where('product_id', '=', $id)->get();

        $productDetail = array('colors' => $color, 'sizes' => $size, 'quantityOfType' => $quantityOfType);

        return response()->json(['status'=>0, 'data'=>$productDetail, 'message'=>'']);
    }

    //DS sản phẩm theo tất cả loại trong danh mục
    public function getProductByProductCategory(HttpRequest $request, $id)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
        ->select('products.*')
        ->where('categories.id', '=', $id)
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->where('categories.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //DS sản phẩm theo loại
    public function getProductByProductType(HttpRequest $request, $id)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->select('products.*')
        ->where('product_types.id', '=', $id)
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Tìm kiếm sản phẩm
    public function searchProduct(HttpRequest $request, $key_search)
    {
        $num = (int) $request->num;
        
        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->join('categories', 'categories.id', '=', 'product_types.categorie_id')
        ->select('products.*')
        ->orWhere('products.product_name', 'like' , '%'.$key_search.'%')
        ->orWhere('product_types.product_type_name', 'like' , '%'.$key_search.'%')
        ->orWhere('categories.category_name', 'like' , '%'.$key_search.'%')    
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->where('categories.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Yêu thích sản phẩm
    public function likeProduct(HttpRequest $request)
    {
        try {
            $product_id = (int) $request->product_id;
        
            $user = Auth::user();

            $like = Like::where('user_id', '=', $user->id)
            ->where('product_id', '=', $product_id)
            ->first();

            $product = Product::where('id', $product_id)->first();

            if($like == null){
                Like::insert([
                    'product_id'=> $product_id,
                    'user_id'=> $user->id,
                ]);                
                $product->update(['num_like' => $product->num_like + 1]);
            }else{
                $like->delete();
                $product->update(['num_like' => $product->num_like - 1]);
            }

            return response()->json(['status'=>0, 'data'=>'', 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Danh sách sản phẩm yêu thích
    public function getAllProductLike()
    {
        try {        
            $user = Auth::user();

            $products = Like::with(['product'])
            ->where('likes.user_id', '=', $user->id)
            ->orderBy('likes.id', 'DESC')
            ->get();

            return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Danh sách đánh giá
    public function getAllRateOfProduct(HttpRequest $request)
    {
        $product_id = (int) $request->product_id;

        $rates = Rate::with(['pictures_rate'=> function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/rates/",picture_value) AS picture_value')]);
        }])
        ->with(['user'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/users/",avatar) AS avatar')]);
        }])
        ->where('rates.product_id', '=', $product_id)
        ->orderBy('rates.id', 'DESC')
        ->get();

        return response()->json(['status'=>0, 'data'=>$rates, 'message'=>'']);
    }

    //Đánh giá sản phẩm
    public function rateProduct(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'product_id' => 'required', 
                'num_rate' => 'required',
                'description' => 'required',
                'images' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = Auth::user();

            $rate = Rate::where('product_id', $request->product_id)
            ->where('user_id', $user->id)
            ->first();

            if ($rate) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Sản phẩm chỉ được đánh giá một lần!']); 
            }

            $rate = Rate::create([
                'product_id' => $request->product_id, 
                'user_id' =>  $user->id,
                'num_rate' => $request->num_rate,
                'description' => $request->description,
            ]);

            $num_rate = Rate::where('product_id', $request->product_id)
            ->avg('num_rate');

            $product = Product::where('id', $request->product_id)
            ->first();

            $product->update([
                'num_rate' => $num_rate,
            ]);
             
            if($request->hasFile('images')){
                $images = $request->file('images');      

                foreach ($images as $image){
                    $picture_rate = new PictureRate;
                
                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/rates/');
                    $image->move($destinationPath,$fileNew);

                    $picture_rate->rate_id = $rate->id;
                    $picture_rate->picture_value = $fileNew;
                    $picture_rate->save();
                }    
            } 
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Đánh giá thành công!']); 
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
    
    //Chỉnh sửa đánh giá
    public function editRateProduct(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'id' => 'required',  
                'product_id' => 'required', 
                'num_rate' => 'required',
                'description' => 'required',
                'images' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = Auth::user();

            $rate = Rate::where('product_id', $request->product_id)
            ->where('user_id', $user->id)
            ->where('id', $request->id)
            ->first();

            if (!$rate) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy đánh giá!']); 
            }

            $rate->update([
                'num_rate' => $request->num_rate,
                'description' => $request->description,
            ]);

            $num_rate = Rate::where('product_id', $request->product_id)
            ->avg('num_rate');

            $product = Product::where('id', $request->product_id)
            ->first();

            $product->update([
                'num_rate' => $num_rate,
            ]);

            if($request->hasFile('images')){
                $picture_rate_lst = PictureRate::where('rate_id', $rate->id)->get();
                foreach ($picture_rate_lst as $pic){
                    unlink(public_path('/assets/img/rates/'.$pic->picture_value));
                    $pic->delete();
                }
                $images = $request->file('images');
                foreach ($images as $image){
                    $picture_rate = new PictureRate;

                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/rates/');
                    $image->move($destinationPath,$fileNew);

                    $picture_rate->rate_id = $rate->id;
                    $picture_rate->picture_value = $fileNew;
                    $picture_rate->save();
                }
            } 
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Sửa đánh giá tin thành công!']); 
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
}
