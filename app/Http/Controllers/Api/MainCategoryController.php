<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    public function mainCategory()
    {
        $mainCategory = mainCategory();
        return response([
            'success'=> true,
            'main_category' => $mainCategory
        ],200);
    }
}
