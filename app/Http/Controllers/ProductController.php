<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        // $products=DB::select('SELECT 
        // p.id id, p.title, p.description, p.created_at, v.title variant_type, pv.variant, pvp.price,pvp.stock
        // FROM products p, variants v, product_variants pv, product_variant_prices pvp
        // where p.id=pv.product_id
        // and p.id=pvp.product_id
        // and v.id=pv.variant_id
        // and p.id=pvp.Product_id group by v.id');

        $products=Product::all();
        $variants=Variant::all();
        $product_variants=ProductVariant::all();
       
        return view('products.index', compact('products','variants','product_variants'));
        //print_r($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
   
        $products=new Product;
		$products->title=$request['title'];
		$products->description=$request['description'];
		$products->sku=$request['sku'];
        $products->created_at=now();
        $products->updated_at=now();
        $products->save();
        $product_last_id= $products->id;
        

        $variant_data=$request['product_variant'];

        foreach ($variant_data as $value) {
            //print_r($value);
            //print_r($value['option']);
            //print_r($value['tags']);

            $variant_id=$value['option'];

            foreach ($value['tags'] as $value) {

                //print_r($value);
                
                $variant=new ProductVariant();

                $variant->variant=$value;
                $variant->variant_id=$variant_id;
                $variant->product_id=$product_last_id;
                $variant->created_at=now();
                $variant->updated_at=now();

               $variant->save();
                echo "product_saved";

            }

        }
        
//==========================================================================

		// if(isset($request->filePhoto)){
		// $products->photo=$request->filePhoto;
		// }

		

		// if(isset($request->filePhoto)){
		// 	$imageName = $products->id.'.'.$request->filePhoto->extension();
		// 	$products->photo=$imageName;
		// 	$products->update();
		// 	$request->filePhoto->move(public_path('img'),$imageName);
		// }
       print_r($request->all());
		//return back()->with('success','Created Successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
