<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Admin\UserDetails;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\GroupProduct;
use App\Models\Admin\Vendor\VendorBanner;
use App\Models\Admin\Vendor\VendorSlider;
use App\Models\Admin\Vendor\VendorProduct;
use App\Http\Resources\Api\ProductResource;
use App\Models\Admin\Bakery\BakeryCategory;
use App\Http\Resources\Api\BannerApiResource;
use App\Http\Resources\Api\SliderApiResource;
use App\Http\Resources\Api\GroupProductResource;
use App\Http\Resources\Api\BakeryCategoryResource;

class HomeApiController extends Controller
{
    public function home()
    {
        // try{

            $vendor = getVendor();
            if($vendor){
                return response([
                    'success'           => true,
                    'kyc_status'        => auth()->user()->retailerUserDetails->kyc_status,
                    'sliders'           => SliderApiResource::collection(VendorSlider::where('user_id', $vendor->user_id)->get()),
                    'banners'           => BannerApiResource::collection(VendorBanner::where('user_id', $vendor->user_id)->get()),
                    'new_arrivals'      => ProductResource::collection(VendorProduct::where('user_id', $vendor->user_id)->orderBy('created_at', 'desc')->limit(5)->get()),
                    'category'          => BakeryCategoryResource::collection(BakeryCategory::orderBy('name','asc')->get()),
                    //'best_selling_item' => ProductResource::collection(VendorProduct::where('user_id', $vendor->user_id)->orderBy('created_at', 'desc')->inRandomOrder()->limit(5)->get()),
                    //'best_rated_item'   => ProductResource::collection(VendorProduct::where('user_id', $vendor->user_id)->orderBy('created_at', 'desc')->inRandomOrder()->limit(5)->get()),
                    'group_product'     => GroupProductResource::collection(GroupProduct::where('user_id', $vendor->user_id)->get())
                ],200);
            }else{
                return response([
                    'message' => 'No vendor available.'
                ], 400);
            }

        // }catch(Exception $exception){

        //     return response([
        //         'message'=> 'Something went wrong.',
        //     ], 400);

        // }
    }
}
