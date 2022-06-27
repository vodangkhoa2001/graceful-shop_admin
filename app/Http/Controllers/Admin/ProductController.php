<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Picture;
use App\Models\ProductDetail;
use App\Models\ProductType;
use App\Models\Size;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách sản phẩm';
        $products = DB::select('SELECT * FROM products ORDER BY created_at DESC');
        // $products = Product::paginate(5);
        return view('component.product.products',compact('title','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCreate()
    {
        $title = 'Thêm sản phẩm mới';
        $category = Category::all();
        $product_type = ProductType::all();
        $product = Product::all()->count();
        $brand = Brand::all();
        $count = $product++;
        $dt = Carbon::now();
        $dt->format('Y-MM-DD');
        $code = $dt->year.(($dt->month>=10)?$dt->month:'0'.$dt->month).(($dt->day>=10)?$dt->day:'0'.$dt->day);
        if($count<10){
            $productCode = $code.'00'.$count;
        }else if($count>=10 && $count<100){
            $productCode = $code.'0'.$count;
        }else{
            $productCode = $code.$count;
        }
        return view('component.product.add-product', compact('title','category','product_type','productCode','brand'));
    }
    public function postCreate( HttpRequest $request)
    {
        $data = Validator::make($request->all(),[
            'product_name'=> 'required',
            'stock'=>'required',
            'brand_id'=>'required',
            'import_price'=>'required',
            'price'=>'required',
            'discount_price'=>'required',
            'product_type_id'=>'required',
            'description'=>'required',
        ]);
        $product = Product::create([
            'product_barcode'=> $request->product_code,
            'product_name'=> $request->product_name,
            'stock'=> $request->stock,
            'brand_id'=> $request->brand,
            'import_price'=> $request->import_price,
            'price'=>$request->price,
            'discount_price'=>$request->discount_price,
            'product_type_id'=>$request->product_type,
            'description'=>$request->description,
        ]);

        $size = Size::create([
            'size_name'=>$request->size_name,
            'product_id'=>$product->id,
            'status'=>1,
        ]);

        $success = $product->save();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image){
                dd('vào for');
                $pics = new Picture();

                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/products/');
                $image->move($destinationPath,$fileNew);

                $pics->product_id = $product->id;
                $pics->picture_value = $fileNew;
                $pics->save();
            }
        }

        return view('component.product.add-product',compact('success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Chi tiết sản phẩm';
        $product = new Product();
        $product = Product::with(['pictures'])->find($id);
        $pics = DB::select("SELECT picture_value FROM pictures,products WHERE products.id = pictures.product_id and product_id ={$id}");
        return view('component.product.product-detail',compact('title','product','pics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $product = new Product();
        $product = Product::with(['pictures'])->find($id);
        $category = Category::all();
        $product_type = ProductType::all();
        $brand = Brand::all();
        $colors = Color::all();
        return view('component.product.edit-product', compact('title','brand','category','product_type','product','colors'));
    }
    public function postEdit(Request $request)
    {

        //

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
