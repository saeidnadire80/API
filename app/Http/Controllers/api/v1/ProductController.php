<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ResourceProduct;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function allproduct()
    {
//        use @ProductCollection
//        $product=product::all()->keyBy->id;
//        return new ProductCollection($product);
        return ResourceProduct::collection(product::all());

    }
    public function single($id)
    {
        $product=product::find($id);
        return new ResourceProduct($product);
    }

}
