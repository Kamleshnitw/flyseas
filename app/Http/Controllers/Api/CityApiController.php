<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityApiController extends Controller
{
    public function city()
    {
        return response([
            'success'=> true,
            'city' => City::orderBy('name','asc')->get(['id', 'name'])
        ],200);
    }
}
