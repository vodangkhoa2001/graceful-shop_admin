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

use function PHPSTORM_META\type;

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
        $product_type =  DB::select('SELECT product_types.* FROM product_types,categories WHERE product_types.categorie_id = categories.id and categories.status=1 and product_types.status =1  ORDER BY product_types.categorie_id DESC');
        $product = Product::all()->count();
        $brand = Brand::where('status','=',1)->get();
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
        ],[
            'required'=>':attribute không được bỏ trống'
        ],[

        ]

    );

        // dd($request->all());

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

        // dd($request->image_colors[0]->getClientOriginalName());
        $product->save();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image){
                // dd('vào for');
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
        //nhap size
        for($i = 0;$i<count($request->size_name);$i++){
            $size = new Size();
            $size->size_name = $request->size_name[$i];
            $size->product_id = $product->id;
            $size->status = 1;
            $size->save();
        }
        //nhap ten mau va hinh sp cua mau
        for($i = 0;$i<count($request->color_name);$i++){
            //luu hinh
            $color = new Color();
            if($request->hasFile('image_colors')){
                foreach ($request->file('image_colors') as $image){
                    // dd('vào for');
                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/product_colors/');
                    $image->move($destinationPath,$fileNew);

                    $color->picture = $fileNew;
                }

            }
            //luu ten mau
            $color->color_name = $request->color_name[$i];
            $color->product_id = $product->id;
            $color->status = 1;
            $color->save();
        }
        return redirect()->route('products')->with('msg','Tạo thành công sản phẩm '.$request->product_name);
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
        $product = Product::with(['pictures'])->find($id);
        $pics = DB::select("SELECT picture_value FROM pictures,products WHERE products.id = pictures.product_id and product_id ={$id}");
        // dd($pics);
        return view('component.product.product-detail',compact('title','product','pics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($id)
    {

        // $product = Product::with(['pictures','sizes'=>function($query){
        //     $query->select(['*',DB::raw("size_name")]);
        // }])
        // ->find($id);
        $product = DB::table('products')->find($id);
        $size = DB::select("SELECT sizes.size_name FROM sizes WHERE product_id = {$id}");
        // dd($size);
        $category = Category::all();
        $product_type = ProductType::all();
        $brand = Brand::all();
        $colors = DB::select("SELECT colors.color_name,colors.picture from colors WHERE colors.product_id = {$id}");
        $pics = DB::select("SELECT pictures.picture_value from pictures WHERE pictures.product_id ={$id}");
        // dd($pics);

        return view('component.product.edit-product', compact('brand','category','product_type','product','size','colors','pics'));
    }
    public function postEdit($id,HttpRequest $request)
    {
        $data = Validator::make($request->all(),[
            'product_name'=> 'required','min:2',
            'stock'=>'required',
            'import_price'=>'required',
            'price'=>'required',
            'discount_price'=>'required',
            'description'=>'required',
        ],
        [
            'product_name.required'=>'Vui lòng nhập tên sản phẩm.',
            'product_name.min'=>'Tên sản phẩm quá ngắn',
        ]
    );
        $product = Product::find($id);
        dd($request->all());
        for($i = 0;$i<count($request->size_name);$i++){
            $size = DB::table('sizes')->where("product_id",'=',$id)->get();
            $size->size_name = $request->size_name[$i];
            $size->product_id = $product->id;
            $size->status = 1;
            $size->udpate();
        }
        dd($size);
        //nhap ten mau va hinh sp cua mau
        for($i = 0;$i<count($request->color_name);$i++){
            //luu hinh

            $color = DB::table('colors')->where("product_id",'=',$id)->get();
            if($request->hasFile('image_colors')){
                foreach ($request->file('image_colors') as $image){
                    // dd('vào for');
                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/product_colors/');
                    $image->move($destinationPath,$fileNew);

                    $color->picture = $fileNew;
                }
                $color->color_name = $request->color_name[$i];
                $color->product_id = $product->id;
            }
            else{
                $color->status = 0;

            }
            $color->update();
        }

        if($request->hasFile('images')){
            foreach ($request->file('images') as $image){
                // dd('vào for');
                $pics = Picture::where('product_id','=',$id)->get();

                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/products/');
                $image->move($destinationPath,$fileNew);

                $pics->product_id = $product->id;
                $pics->picture_value = $fileNew;
                $pics->update();
            }
            $product->product_name = $request->product_name;
            $product->brand_id = $request->brand;
            $product->product_type_id = $request->product_type;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->import_price = $request->import_price;
            $product->discount_price = $request->discount_price;

        }else{

            $product->product_name = $request->product_name;
            $product->brand_id = $request->brand;
            $product->product_type_id = $request->product_type;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->import_price = $request->import_price;
            $product->discount_price = $request->discount_price;
            $product->status = $request->status;
        }
        $product->update();

        return view('component.product.edit-product',compact('success'));

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
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $name = $product->product_name;
        $product->update();
        return redirect()->route('products')->with('msg','Đã xóa thành công sản phẩm '.$name);
    }
}
