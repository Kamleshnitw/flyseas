<tr id="product_row_{{$product->id}}{{$variationStrValue}}">
    <input type="hidden" name="bakery_product_id[]" value="{{$product->id}}">
    <input type="hidden" name="variation_value[]" value="{{$variationValue}}">
    <input type="hidden" name="combination_name[]" value="{{$variationStrValue}}">
    {{-- <input type="hidden" name="category_id[]" value="{{$product->category_id}}">
    <input type="hidden" name="sub_category_id[]" value="{{$product->sub_category_id}}">
    <input type="hidden" name="product_name[]" value="{{$product->product_name}}"> --}}
    <input type="hidden" name="thumbnail[]" value="{{$product->thumbnail}}">
    <input type="hidden" name="gallery[]" value="{{$product->gallery}}">
    <input type="hidden" name="tax[]" value="{{$product->tax}}">
    <input type="hidden" name="hsn_code[]" value="{{$product->hsn_code}}">
    <input type="hidden" name="description[]" value="{{$product->description}}">

    <td>
        {{$product->product_name}}{{$variationStrValue}}
    </td>
    <td><input type="number" class="form-control" name="purchase_price[]" placeholder="Purchase Price" required></td>
    <td><input type="number" class="form-control" name="mrp_price[]" id="mrp_price_{{$product->id}}{{$variationStrValue}}" placeholder="MRP Price" required></td>
    <td><input type="number" class="form-control" name="selling_price[]" id="selling_price_{{$product->id}}{{$variationStrValue}}" placeholder="Seller Price" required></td>
    <td><input type="number" class="form-control" name="discount_price[]" placeholder="Discount Price" required></td>
    <td>
        <select name="discount_type[]" class="form-control">
            <option value="%">%</option>
            <option value="fixed">fixed</option>
        </select>
    </td>
    <td><input type="text" class="form-control" name="sku_code[]" placeholder="SKU code" required></td>
    <td><input type="number" class="form-control" name="quantity[]" placeholder="Product Quantity" required></td>
</tr>

<script>
    $(document).ready(function(){
        $("#selling_price_{{$product->id}}{{$variationStrValue}}").on('keyup',function(){
            var mrp_price = parseInt($('#mrp_price_{{$product->id}}{{$variationStrValue}}').val());
            var selling_price = parseInt($('#selling_price_{{$product->id}}{{$variationStrValue}}').val());
           
            if(mrp_price < selling_price){
                alert('Selling Price is not greater than MRP Price !!');
                $('#selling_price_{{$product->id}}{{$variationStrValue}}').val('');
            }
        });

        $("#mrp_price_{{$product->id}}{{$variationStrValue}}").on('keyup',function(){
            var mrp_price = $('#mrp_price_{{$product->id}}{{$variationStrValue}}').val();
            $('#selling_price_{{$product->id}}{{$variationStrValue}}').val('');
        });
    });
</script>