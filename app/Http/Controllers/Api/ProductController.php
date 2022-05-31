<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request as HttpRequest;

class ProductController extends Controller
{   
    //DS sản phẩm mới
    public function getAllNewProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("img/products/",picture_value) AS picture_value')]);
        }])
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'error'=>'']);
    }
    //DS sản phẩm nổi bật
    public function getAllPopularProduct(HttpRequest $request)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("img/products/",picture_value) AS picture_value')]);
        }])
        ->where('products.popular', '=', 1)
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);
        
        return response()->json(['status'=>0, 'data'=>$products, 'error'=>'']);
    }
    //Chi tiết sản phẩm
    public function getProductDetailById($id)
    {
        $color = Color::select(['*', DB::raw('CONCAT("img/products/",picture) AS picture')])
        ->where('status', '=', 1)->where('product_id', '=', $id)->get();

        $size = Size::where('status', '=', 1)->where('product_id', '=', $id)->get();

        $quantityOfType = ProductDetail::where('product_id', '=', $id)->get();

        $productDetail = array('colors' => $color, 'sizes' => $size, 'quantityOfType' => $quantityOfType);

        return response()->json(['status'=>0, 'data'=>$productDetail, 'error'=>'']);
    }
    //DS sản phẩm theo loại
    public function getProductByProductType(HttpRequest $request, $id)
    {
        $num = (int) $request->num;

        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("img/products/",picture_value) AS picture_value')]);
        }])
        ->join('product_types', 'product_types.id', '=', 'products.product_type_id')
        ->select('products.*')
        ->where('product_types.id', '=', $id)
        ->where('products.status', '=', 1)
        ->where('product_types.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->paginate($num);

        return response()->json(['status'=>0, 'data'=>$products, 'error'=>'']);
    }
    //Tìm kiếm sản phẩm
    public function searchProduct(HttpRequest $request, $key_search)
    {
        $num = (int) $request->num;
        
        $products = Product::with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("img/products/",picture_value) AS picture_value')]);
        }])
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

        return response()->json(['status'=>0, 'data'=>$products, 'error'=>'']);
    }
}
