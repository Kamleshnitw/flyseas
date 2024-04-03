<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\Vendor\CouponController;
use App\Http\Controllers\Admin\Vendor\VendorController;
use App\Http\Controllers\Admin\Bakery\ProductController;
use App\Http\Controllers\Admin\Vendor\RetailerController;
use App\Http\Controllers\Admin\Vendor\RetailerKycController;
use App\Http\Controllers\Admin\Vendor\VendorOfferController;
use App\Http\Controllers\Admin\Vendor\VendorBannerController;
use App\Http\Controllers\Admin\Vendor\VendorCouponController;
use App\Http\Controllers\Admin\Vendor\VendorSliderController;
use App\Http\Controllers\Admin\Bakery\BakeryProductController;
use App\Http\Controllers\Admin\Vendor\GroupProductsController;
use App\Http\Controllers\Admin\Vendor\VendorProductController;
use App\Http\Controllers\Admin\Bakery\BakeryCategoryController;
use App\Http\Controllers\Admin\Bakery\BakeryVariationController;
use App\Http\Controllers\Admin\Bakery\BakerySubCategoryController;

Route::prefix("admin")->group(function(){

    Auth::routes();

    Route::group(['middleware' => ['auth']], function() {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        //Bakery
        Route::prefix('bakery')->group(function() {

            //Category
            Route::resource('categories', BakeryCategoryController::class)->except('destroy');
            Route::get('categories-featured/{id}', [BakeryCategoryController::class,'featured'])->name('categories.featured');
            Route::get('categories-delete/{id}', [BakeryCategoryController::class,'destroy'])->name('categories.destroy');

            //Sub Category
            Route::resource('subcategories', BakerySubCategoryController::class)->except('destroy');
            Route::get('subcategories-delete/{id}', [BakerySubCategoryController::class,'destroy'])->name('subcategories.destroy');
            Route::get('subcategories-by-categories/{category_id}', [BakerySubCategoryController::class,'subcategoriesByCategories'])->name('subcategoriesByCategories');


            //Variation
            Route::resource('variations', BakeryVariationController::class)->except('destroy');          
            Route::resource('variations', BakeryVariationController::class)->except('destroy');
            Route::get('variations-delete/{id}', [BakeryVariationController::class,'destroy'])->name('variations.destroy');

            // Product
            Route::get('category-variations/{categorie_id}', [BakeryProductController::class,'categoryVariations'])->name('category-variations');
            Route::get('variations-value/{id}', [BakeryProductController::class,'VariationsValue'])->name('variations-value');
            Route::resource('products', BakeryProductController::class)->except('destroy');
            Route::get('products-featured/{id}', [BakeryProductController::class,'featured'])->name('products.featured');
            Route::get('products-delete/{id}', [BakeryProductController::class,'destroy'])->name('products.destroy');
           

        });

        // Vendor
        Route::prefix('vendor')->group(function() {

            // Product
            Route::resource('products', VendorProductController::class,['as'=>'vendor'])->except('destroy');
            Route::get('products-delete/{id}', [VendorProductController::class,'destroy'])->name('vendor.products.destroy');
            Route::post('product-filter', [VendorProductController::class, 'productsFilter'])->name('products_filter');
            Route::get('getProducts', [VendorProductController::class, 'getProducts'])->name('get_products');

            // Slider
            Route::resource('slider', VendorSliderController::class,['as'=>'vendor']);

            // Banner
            Route::resource('banner', VendorBannerController::class,['as'=>'vendor']);

            // Offer
            Route::get('get-all-category', [VendorOfferController::class,'getCategory'])->name('vendor.getAllCategory');
            Route::get('get-products', [VendorOfferController::class,'getProductbyCategory'])->name('vendor.getProductbyCategory');
            Route::resource('offer', VendorOfferController::class,['as'=>'vendor']);
            
            // Coupon
            Route::resource('coupon', VendorCouponController::class,['as'=>'vendor']);

            // Group Product
            Route::resource('group-product', GroupProductsController::class,['as'=>'vendor']);

            // Retailer Kyc
            Route::resource('retailer-kyc', RetailerKycController::class,['as'=>'vendor']);
            Route::resource('retailers', RetailerController::class,['as'=>'vendor']);

            // Order
            Route::resource('orders', App\Http\Controllers\Admin\Vendor\OrdersController::class,['as'=>'vendor']);

        });

        // City
        Route::resource('city', CityController::class)->except('destroy');
        Route::get('city-delete/{id}', [CityController::class,'destroy'])->name('city.destroy');

        //Role Management
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);


        // Upload multiple Images
        Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
        Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
        Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
        Route::delete('/aiz-uploader/destroy/{id}', [AizUploadController::class, 'destroy']);
        Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
        Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');

    });

});
