<?php

namespace App\Services;

use App\Mail\ProductOutOfStock;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProductService
{
    public function updateProduct($request, $product)
    {
        if ($request->stock > $product->stock) {
            $this->updateSoldStock($product);
            $product->stockDetails()
                ->attach([
                    $product->id =>
                    ['added_stock' => $request->stock - $product->stock, 'old_stock' => $product->stock]
                ]);
        } else {
            $request->stock = $product->stock;
        }
        if (!is_null($request->file)) {
            $product->addMedia($request->file)->toMediaCollection('image');
        }
        $nutritionsAmountArray = getNutrationArray($request->nutrition, $request->nutrition_amount);
        $product->update($request->validated());
        $product->ingredients()->sync($request->ingredient);
        $product->nutritions()->sync($nutritionsAmountArray);
        return true;
    }

    public function updateSoldStock($product)
    {
        $productStock = $product->stockDetails()->get();
        if ($productStock->isNotEmpty()) {
            $productStock = $productStock->toArray();
            $productStock = end($productStock);
            $oldStock = DB::table('stock_details_pivot')
                ->where('product_id', $product->id)
                ->where('added_stock', $productStock['pivot']['added_stock'])
                ->where('old_stock', $productStock['pivot']['old_stock'])
                ->where('created_at', date('Y-m-d', strtotime($productStock['pivot']['created_at'])))
                ->update([
                    'sold_stock' => $productStock['pivot']['added_stock'] + $productStock['pivot']['old_stock'] - $product->stock
                ]);
        }
    }

    public function stockProduct($id, $amount)
    {
        $product = Product::find($id);
        $product->decrement('stock', $amount);
        if ($product->stock == 5 || $product->stock == 15 || $product->stock == 0) {
            Mail::to('muddasirali99@gmail.com')->send(new ProductOutOfStock($product));
        }
    }

    //  $nutritionsAmountArray = [];
    //     $key = 0;
    //     collect($request->nutrition)->map(function ($item) use (&$nutritionsAmountArray, &$key, $request) {
    //         $nutritionsAmountArray += [$item => ['amount' => $request->nutrition_amount[$key]]];
    //         $key++;
    //     });
}
