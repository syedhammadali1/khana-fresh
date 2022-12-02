<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Flavour;
use App\Models\Ingredient;
use App\Models\Nutrition;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $products = Product::search($request->keyword);
            $pagination = $products->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(10);
        }


        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $ingredients = Ingredient::all();
        $flavours = Flavour::all();
        $nutritions = Nutrition::all();
        return view('products.create', compact('categories', 'ingredients', 'flavours', 'nutritions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        $product->stockDetails()->attach([$product->id => ['added_stock' => $request->stock, 'old_stock' => 0]]);
        $product->addMedia($request->file)->toMediaCollection('image');
        $product->ingredients()->attach($request->ingredient);
        $nutritionsAmountArray = getNutrationArray($request->nutrition, $request->nutrition_amount);
        $product->nutritions()->attach($nutritionsAmountArray);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        $flavours = Flavour::all();
        $nutritions = Nutrition::all();
        $nutrition_amount = [];
        collect($product->nutritions)->map(function ($item) use (&$nutrition_amount) {
            array_push($nutrition_amount, $item->pivot->amount);
        });

        return view('products.show', compact('categories', 'ingredients', 'flavours', 'nutritions', 'product', 'nutrition_amount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        $flavours = Flavour::all();
        $nutritions = Nutrition::all();
        $nutrition_amount = [];
        collect($product->nutritions)->map(function ($item) use (&$nutrition_amount) {
            array_push($nutrition_amount, $item->pivot->amount);
        });

        return view('products.edit', compact('categories', 'ingredients', 'flavours', 'nutritions', 'product', 'nutrition_amount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, ProductService $service)
    {

        $service->updateProduct($request, $product);

        return redirect()->route('products.index')->with('class', 'success')->with('message', 'Product update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if (!$product->users()->exists()) {
            $product->ingredients()->detach();
            $product->nutritions()->detach();
            $product->delete();
            return redirect()->back();
        } else {
            return redirect()->back()->with('class', 'danger')->with('message', 'Product ' . $product->name . ' is in use with ' . $product->users()->count() . ' users, You Cannot Delete It.')
                ->with(['error' => 'Product ' . $product->name . ' is in use with ' . $product->users()->count() . ' users, You Cannot Delete It.']);
        }

        // $item =  DB::table('product_user')->where('product_id', $product->id)->first();

        // if (isset($item)) {
        //     return redirect()->route('products.index')->with(['error' => 'you can not delete this product ']);
        // } else {
        //     $product->ingredients()->detach();
        //     $product->nutritions()->detach();
        //     $product->delete();
        //     return redirect()->route('products.index')->with(['success' => 'Product has been deleted ']);
        // }
    }

    // public function productStock()
    // {

    //     $products = Product::paginate(10);
    //     $today =  Carbon::today()->format('Y-m-d');

    //     return view('products.productStock', compact('products', 'today'));
    // }
}
