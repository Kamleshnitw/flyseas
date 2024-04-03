<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Bakery\BakeryCategory;

class BakeryCategoryApiController extends Controller
{
    public function category()
    {
        $list = BakeryCategory::orderBy('name','asc')->get(['id', 'name', 'thumbnail_image']);
        foreach($list as $data){
            $data->thumbnail_image = asset('public/'.api_asset($data->thumbnail_image));
        }
        return response([
            'success'=> true,
            'category' => $list
        ],200);
    }
}
