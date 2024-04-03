<?php

use App\Models\Upload;
use App\Models\Admin\UserDetails;


if (!function_exists('mult_api_asset')) {
    function mult_api_asset($str)
    {
        $arry = [];
        foreach(explode(",",$str) as $id){
            $arry[]=asset('public/'.api_asset($id));
        }
        return $arry;
    }
}

if (!function_exists('api_asset')) {
    function api_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return $asset->file_name;
        }
        return "";
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return null;
    }
}

if (! function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if(env('FILESYSTEM_DRIVER') == 's3'){
            return Storage::disk('s3')->url($path);
        }
        else {
            return app('url')->asset('public/'.$path, $secure);
        }
    }
}

if (! function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/'.$path, $secure);
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root =(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if(env('FILESYSTEM_DRIVER') == 's3'){
            return env('AWS_URL').'/';
        }
        else {
            return getBaseURL().'public/';
        }
    }
}

if (!function_exists('getVendor')) {
    function getVendor()
    {
        $vendor = UserDetails::where('city_id', auth()->user()->retailerUserDetails->city_id)->first();
        return $vendor;
    }
}

function compress($src, $dist, $dis_width =500) {
    $img = '';
    $extension = strtolower(strrchr($src, '.'));
    switch($extension)
    {
        case '.jpg':
        case '.jpeg':
            $img = imagecreatefromjpeg($src);
            break;
        case '.gif':
            $img = imagecreatefromgif($src);
            break;
        case '.png':
            $img = imagecreatefrompng($src);
            break;
    }
    $width = imagesx($img);
    $height = imagesy($img);
    $dis_height = $dis_width * ($height / $width);
    $new_image = imagecreatetruecolor($dis_width, $dis_height);
    imagecopyresampled($new_image, $img, 0, 0, 0, 0, $dis_width, $dis_height, $width, $height);
    $imageQuality = 90;
    switch($extension)
    {
        case '.jpg':
        case '.jpeg':
            if (imagetypes() & IMG_JPG) {
                imagejpeg($new_image, $dist, $imageQuality);
            }
            break;
        case '.gif':
            if (imagetypes() & IMG_GIF) {
                imagegif($new_image, $dist);
            }
            break;
        case '.png':
            $scaleQuality = round(($imageQuality/100) * 9);
            $invertScaleQuality = 9 - $scaleQuality;
            if (imagetypes() & IMG_PNG) {
                imagepng($new_image, $dist, $invertScaleQuality);
            }
            break;
    }
    imagedestroy($new_image);
    return filesize($src);
}

if (!function_exists('mainCategory')) {
	function mainCategory()
	{
		$types = [
            [   
                'id'            => 1,
                'name'          =>'Canteen Outlet',
                'icon'          => asset('public/image/outlet.png'),
                'description'   => 'Description',
            ],
            // [ 
            //     'id'            => 2,
            //     'name'          =>'FMCG',
            //     'icon'          =>asset('public/image/cat_food.png'),
            //     'description'   => 'Description',
            // ],[ 
            //     'id'            => 3,
            //     'name'          =>'Clothing',
            //     'icon'          =>asset('public/image/cat_cloths.png'),
            //     'description'   => 'Description',
            // ],[ 
            //     'id'            => 4,
            //     'name'          =>'Electronics',
            //     'icon'          =>asset('public/image/cat_electronics.png'),
            //     'description'   => 'Description',
            // ],
        ];

		return $types;
	}
}

if (!function_exists('makeCombinations')) {
    function makeCombinations($arrays)
	{
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result; 
    }

}

if(!function_exists('convert_number_to_words')){
    function convert_number_to_words($number) {

        $hyphen      = ' ';
        $conjunction = ' ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}
?>
