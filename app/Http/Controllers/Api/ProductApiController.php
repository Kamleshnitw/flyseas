<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorProduct;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ProductDescriptionResource;

class ProductApiController extends Controller
{
    public function allProducts(Request $request)
    {
        $list = VendorProduct::where('user_id', getVendor()->user_id);
        if($request->search){
            $list = $list->where('product_name', 'like', '%' . $request->search . '%');
        }
        $list = $list->orderBy('product_name','asc')->get();

        return response([
            'success'           => true,
            'products_list'     => ProductResource::collection($list),
        ],200);
    }

    public function productDescription($id)
    {
        return response([
            'success'               => true,
            'product_description'   => new ProductDescriptionResource(VendorProduct::find($id)),
        ],200);
    }

    public function productsByCategory($category_id)
    {
        return response([
            'success'           => true,
            'products_list'     => ProductResource::collection(VendorProduct::where('user_id', getVendor()->user_id)->where('category_id', $category_id)->orderBy('product_name','asc')->get()),
        ],200);
    }
}
