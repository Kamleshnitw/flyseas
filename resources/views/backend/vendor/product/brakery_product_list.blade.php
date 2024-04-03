<div id="bakery_product_list" style="height: 400px; overflow-x: hidden;">
    @foreach ($bakeryProductList as $productList)
        
        @php
            $productCombinationLists = makeCombinations($productList->variation_options);
        @endphp
        @foreach ($productCombinationLists as $productCombination)
            @php
                $str='';
                foreach ($productCombination as $key => $productCombinationValue) {
                    $str .= '-'.str_replace(' ', '', $productCombinationValue);
                }
                $CheckVendorProductList=App\Models\Admin\Vendor\CheckVendorProductList::where('user_id', auth()->id())->where('product_id', $productList->id)->where('variation_str_value', $str)->first();
                $vendorProduct = App\Models\Admin\Vendor\VendorProduct::where('user_id', auth()->id())->where('bakery_product_id', $productList->id)->whereJsonContains('combination_name', "".$str)->first();
            @endphp
            @if (!$vendorProduct)
                <div class="row">
                    <div class="col-12">
                        
                        <div class="info-box">
                            <div class="icheck-success mt-3">
                                @if($CheckVendorProductList)
                                    <input type="checkbox" class="checkProduct" name="product_id" id="product_id{{$str}}" value="{{json_encode($productCombination)}}" onchange="checkProduct('{{$str}}', '{{$productList->id}}')" checked>
                                @else
                                    <input type="checkbox" class="checkProduct" name="product_id" id="product_id{{$str}}" value="{{json_encode($productCombination)}}" onchange="checkProduct('{{$str}}', '{{$productList->id}}')">
                                @endif
                                <label for="product_id{{$str}}">
                                </label>
                            </div>
                            <span class="info-box-icon bg-white"><img src="{{asset('public/'.api_asset($productList->thumbnail))}}"></span>
                            <div class="info-box-content">
                                
                                <span class="info-box-number">
                                    {{$productList->product_name}}{{$str}}
                                </span>
                                {{-- <span class="info-box-number">{{$productList->bakeryVariation->name}} - {{$productList->variant_value}}</span> --}}
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
    <input  id="page_on" value="{{ $bakeryProductList->currentPage() }}" hidden >
    @include('pagination',['list'=>$bakeryProductList,'page_link'=>'admin/vendor/products/create','class'=>'pagination_class'])
</div>