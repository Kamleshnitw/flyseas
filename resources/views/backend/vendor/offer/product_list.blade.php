<div id="product_lists">
    @if($edit_data_id != null)
        @php
            $selected_product = App\Models\Admin\Vendor\VendorOffer::where('id', $edit_data_id)->first();
        @endphp
    @endif
    <label>Products</label>
    <div class="row">
        @foreach ($products as $data)
            <div class="col-md-1">
                <div class="icheck-primary">
                    <input type="checkbox" @if($offer_type=="category")checked="" @elseif(isset($selected_product) && in_array($data->id, $selected_product->product_id))checked=""@endif name="product_id[]" value="{{$data->id}}" id="checkboxSuccess_{{$data->id}}">
                    <label for="checkboxSuccess_{{$data->id}}">
                    </label>
                </div>
                {{$data->product_name}}<br>
                ({{$data->variant_value}})
            </div>
        @endforeach
    </div>
</div>