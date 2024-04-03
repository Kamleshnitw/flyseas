<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice | {{$data->order_id}}</title>
    <style>
        body {
            position: relative;
            width: 24cm;
            height: 26.2cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            padding: 10px;
            font-family: sans-serif;
            letter-spacing: 0.1px;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .logobox {
            position: relative;
            float: left;
            width: 60%;
        }

        .paymentbox {
            position: relative;
            float: left;
            width: 40%;
        }

        .paymentbox img {
            float: right;
        }

        .paymentbox p {
            text-align: right;
        }

        .paymentbox h3 {
            text-align: right;
            font-size: 20px;
        }

        .headbox {
            width: 100%;
            position: relative;
            float: left;
        }

        .headbox h1 {
            text-align: center;
            color: #e2218f;
            font-size: 24px;
        }

        .main-content {
            width: 100%;
            position: relative;
            float: left;
            margin-top: 15px;
        }

        table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        th {
            font-size: 20px;
            color: gray;
        }

        td {
            font-size: 18px;
        }

        td,
        th {
            vertical-align: top;
            text-align: left;
            padding: 5px 10px;
            font-size: 12px;
        }

        th {
            background-color: #e2218f;
            color: white;
        }

        .signature img {
            width: 160px;
            margin-right: 140px;
        }

        .btn {
            text-decoration: none;
            color: gray;
            background: #e7e2e2;
            padding: 8px;
            border-radius: 3px;
            text-align: center;
        }

        @media print {
            .headbox h1 {
                color: #e2218f;
            }

            table th {
                background-color: #e2218f;
                color: white;
            }

            a.btn {
                display: none;
            }

        }
    </style>
</head>

<body>

    <header style="margin-top: 3%;margin-bottom: 3%;">
        <div class="logobox">
            <h3 style="margin-bottom: 0px;margin-top:0px;"><b>Flyseas</b></h3>
            <p style="font-size: 12px; margin-bottom: 5px;margin-top:5px;">4th Floor, "C" Block, planco Shanti Awas,
                Boring Rd, New Patliputra Colony, Patna, Bihar 800013</p>
            <p style="font-size: 12px;margin-bottom: 5px;margin-top:5px;">Phone no.: 9341502581</p>
            <p style="font-size: 12px;margin-bottom: 5px;margin-top:5px;">Email : info@flyseas.in</p>
            <p style="font-size: 12px;margin-bottom: 5px;margin-top:5px;">GSTIN : 10AAOCM2287N1Z3</p>
            <p style="font-size: 12px;margin-bottom: 5px;margin-top:5px;">State : 10-Bihar</p>
        </div>

        <div class="paymentbox">
            <img src="{{ asset('public/image/logo.png') }}" title="logo" width="70px">
        </div>
        <div class="headbox">
            <h1><b>Tax Invoice</b></h1>
        </div>
        <div class="logobox">
            <p style="font-size: 12px; margin-bottom: 5px;margin-top:5px;"><b>Bill TO</b></p>
            <p style="font-size: 12px; margin-bottom: 5px;margin-top:5px;"><b>{{$data->user_name}}</b></p>
            <p style="font-size: 12px; margin-bottom: 5px;margin-top:5px; line-height: 16px;">{{$data->address->address}}<br>{{$data->address->city}}, {{$data->address->state}}, {{$data->address->country}} - {{$data->address->pincode}}</p>
            <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">Conatct No.: {{$data->user_phone}}</p>
            {{-- <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">GSTIN : 10AAUCS5079A1ZE</p>  --}}
            <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">State : {{$data->address->state}}</p>
        </div>

        <div class="paymentbox">
            <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">Place Of Supply: {{ $data->address->city }}</p>
            <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;"><b>Invoice No.: {{ $data->order_id }}</b></p>
            <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;"><b>Date :
                    {{ $data->created_at->format('d/m/Y') }}</b></p>
            {{-- <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">SALES PRESON : {{ $data->user_name }}</p> --}}
            {{-- <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">E-way Bill number: 862516215536</p> --}}
        </div>
    </header>

    <div class="main-content">
        <table>
            <thead>
                <tr>
                    <th style="width: 20px;">#</th>
                    <th>Item name</th>
                    <th>HSN/SAC Name</th>
                    <th>MRP</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th style="text-align: center;">GST</th>
                    <th style="text-align: right;">Selling Price</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $i = 1;
                    $sellingPrice = 0; 
                    $discountedSubTotal = 0;
                @endphp
                @foreach (json_decode($data->product_details) as $productDetails)
                    @php 
                        $sellingPrice+=$productDetails->selling_price*$productDetails->quantity;
                        $discountedSubTotal+=$productDetails->purchase_price*$productDetails->quantity;
                    @endphp
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$productDetails->product_name}} {{$productDetails->combination_name}}</td>
                        <td>{{$productDetails->product_id}}</td>
                        <td>₹ {{$productDetails->mrp_price}}</td>
                        <td>{{$productDetails->quantity}}</td>
                        <td>PC</td>
                        @php
                            $gst = 0;
                            $totalGst = 0;
                            if(isset($productDetails->gst)){
                                $gst = $productDetails->selling_price-($productDetails->selling_price*100)/(100+$productDetails->gst);
                                $totalGst += $gst;
                            }else{
                                $productDetails->gst = 0;
                            }
                        @endphp
                        <td style="text-align: center;">₹ {{round($gst, 2)}} ({{$productDetails->gst}}%)</td>
                        <td style="text-align: right;">₹ {{$productDetails->selling_price}}</td>
                    </tr>
                @endforeach
                <tr style="border-top: 1px solid black; border-bottom: 1px solid black;">
                    <td></td>
                    <td>
                        <h3 style="margin: 0px;"><b>Total</b></h3>
                    </td>
                    <td></td>
                    <td>
                        {{-- <h3 style="margin: 0px;"><b>50</b></h3> --}}
                    </td>
                    <td colspan="2"></td>
                    <td style="text-align: center;">
                        <h3 style="margin: 0px;"><b>₹ {{round($totalGst, 2)}}</b></h3>
                    </td>
                    <td style="text-align: right;">
                        <h3 style="margin: 0px;"><b>₹ {{$sellingPrice}}</b></h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="logobox">
        <p style="width: 90%; font-size: 12px; margin-bottom: 5px;margin-top:5px; color: #615d5d;"><b>Invoice Amount In
                Words</b></p>
        <p
            style="width: 90%; font-size: 12px; margin-bottom: 5px;margin-top:5px;background-color: #f6f3f3; 
	  			padding: 5px 10px 5px 5px; color: #615d5d;">
            {{ucwords(convert_number_to_words($data->grand_amount))}} Rupees</p>

        <p style="width: 90%; font-size: 12px; margin-bottom: 5px;margin-top:15px; color: #615d5d;"><b>Terms and
                Conditions</b></p>
        <p
            style="width: 90%; font-size: 12px; margin-bottom: 5px;margin-top:5px;background-color: #f6f3f3; 
	  			padding: 5px 10px 5px 5px; color: #615d5d;">
            Flyseas is a B2B Marketplace that empowers Retailers/ Wholesalers/ Small Shop Owners by providing them all
            the products with innovative Supply Chain Solutions.
            <br>
            <br>
            Flyseas is a B2B Marketplace that empowers Retailers/ Wholesalers/ Small Shop Owners by providing them all
            the products with innovative Supply Chain Solutions.
            <br>
            <br>
            Flyseas is a B2B Marketplace that empowers Retailers/ Wholesalers/ Small Shop Owners by providing them all
            the products with innovative Supply Chain Solutions.
            <br>
            <br>
            Flyseas is a B2B Marketplace that empowers Retailers/ Wholesalers/ Small Shop Owners by providing them all
            the products with innovative Supply Chain Solutions.
        </p>

        <p style="width: 90%; font-size: 12px; margin-bottom: 5px;margin-top:15px; color: #615d5d;"><b>Pay To-</b></p>
        <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">Bank Name : ........</p>
        <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">Bank Account No. : .........</p>
        <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">Bank IFSC Code : ...........</p>
        <p style="font-size: 12px;margin-bottom: 8px;margin-top:8px;">Account Holder's name : .........</p>

    </div>

    <div class="paymentbox">
        <table>
            <tbody>
                <tr>
                    <td>Sub Total</td>
                    <td style="text-align: right;">₹ {{round($sellingPrice-$totalGst, 2)}}</td>
                </tr>
                <tr>
                    <td>Coupon Discount</td>
                    <td style="text-align: right;">₹ {{$data->coupon_discount}}</td>
                </tr>

                <tr>
                    <td>Shipping</td>
                    <td style="text-align: right;">₹ 0.00</td>
                </tr>
                <tr>
                    <td>SGST@6%</td>
                    <td style="text-align: right;">₹ {{round($totalGst/2, 2)}}</td>
                </tr>
                <tr>
                    <td>CGST@2.5%</td>
                    <td style="text-align: right;">₹ {{round($totalGst/2, 2)}}</td>
                </tr>
                <tr style="background-color: #e2218f; color: white;">
                    <td>Total</td>
                    <td style="text-align: right;">₹ {{$data->grand_amount}}</td>
                </tr>
                <tr>
                    {{-- <td>Received</td>
                    <td style="text-align: right;">₹ 0.00</td> --}}
                </tr>

                <tr>
                    {{-- <td>Balance</td>
                    <td style="text-align: right;">₹ 0.00</td> --}}
                </tr>

                <tr style="border-bottom: 1.5px solid #e1d9d9;">
                    {{-- <td>Current Balance</td>
                    <td style="text-align: right;">₹ 0.00</td> --}}
                </tr>
            </tbody>
        </table>

        <div class="signature">
            <p style="font-size: 12px;margin-bottom: 5px;margin-top:50px; text-align: center;">For, Flyseas</p>
            <img src="{{ asset('public/image/sign.png') }}" title="signature">
            <p
                style="font-size: 13px;margin-bottom: 5px;margin-top:5px; text-align: center; width: 100%; position: relative;float: left;">
                Authorized Signature</p>
        </div>

    </div>
    <div class="footer"
        style="margin-top: 20px; margin-bottom: 40px;text-align: center; width: 100%;position: relative;float: left;">
        <a href="javascript:window.print()" class="btn">Print</a>
    </div>
</body>

</html>
