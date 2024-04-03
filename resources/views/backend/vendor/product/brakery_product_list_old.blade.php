<div id="bakery_product_list" style="height: 400px; overflow-x: hidden;">
    @php
        $vendorProduct = App\Models\Admin\Vendor\VendorProduct::where('user_id', auth()->id())->pluck('bakery_product_id')->toArray();
    @endphp
    @foreach ($bakeryProductList as $productList)
        @if(!in_array($productList->id, $vendorProduct))
            @php
                $CheckVendorProductList=App\Models\Admin\Vendor\CheckVendorProductList::where('user_id', auth()->id())->where('product_id', $productList->id)->first();
            @endphp
            <div class="row">
                <div class="col-12">
                    
                    <div class="info-box">
                        <div class="icheck-success mt-3">
                            @if($CheckVendorProductList)
                                <input type="checkbox" class="checkProduct" name="product_id" id="product_id_{{$productList->id}}" value="{{$productList->id}}" checked>
                            @else
                                <input type="checkbox" class="checkProduct" name="product_id" id="product_id_{{$productList->id}}" value="{{$productList->id}}">
                            @endif
                            <label for="product_id_{{$productList->id}}">
                            </label>
                        </div>
                        <span class="info-box-icon bg-white"><img src="{{asset('public/'.api_asset($productList->thumbnail))}}"></span>
                        <div class="info-box-content">
                            <span class="info-box-number">{{$productList->product_name}} </span>
                            <span class="info-box-number">{{$productList->bakeryVariation->name}} - {{$productList->variant_value}}</span>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    
    @endforeach
    <input  id="page_on" value="{{ $bakeryProductList->currentPage() }}" hidden >
    @include('pagination',['list'=>$bakeryProductList,'page_link'=>'admin/vendor/products/create','class'=>'pagination_class'])
</div>