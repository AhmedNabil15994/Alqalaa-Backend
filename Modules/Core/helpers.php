<?php

use Illuminate\Support\Facades\Route;
use Modules\Installment\Entities\InstallmentPayment;
use Modules\Installment\Entities\InstallmentTransaction;
use Spatie\Valuestore\Valuestore;

if (!function_exists('convert_number_to_words')) {
    function convert_number_to_words($number)
    {
        if(strpos($number, '.') !== false && substr($number, -1) == 0) {
            $number = substr($number, 0, -1);
        }
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' and ';
        $dictionary  = array(

            "0.0"                   => 'zero',
            "0.01"                   => 'one',
            "0.02"                   => 'two',
            "0.03"                   => 'three',
            "0.04"                   => 'four',
            "0.05"                   => 'five',
            "0.06"                   => 'six',
            "0.07"                   => 'seven',
            "0.08"                   => 'eigh',
            "0.09"                   => 'nine',
            "0.1"                  => 'ten',
            "0.11"                  => 'eleven',
            "0.12"                   => 'twelve',
            "0.13"                  => 'thirteen',
            "0.14"                  => 'fourteen',
            "0.15"                  => 'fifteen',
            "0.16"                  => 'sixteen',
            "0.17"                 => 'seventeen',
            "0.18"                  => 'eighteen',
            "0.19"                  => 'nineteen',
            "0.2"                  => 'twenty',
            "0.3"                  => 'thirty',
            "0.4"                  => 'fourty',
            "0.5"                  => 'fifty',
            "0.6"                  => 'sixty',
            "0.7"                  => 'seventy',
            "0.8"                  => 'eighty',
            "0.9"                  => 'ninety',

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
            1000000000000000000 => 'quintillion',
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
            $i = 1;
            foreach (str_split((string) $fraction) as $number) {
                if($i == 1) {
                    $f = "0.";
                } elseif($i == 2) {
                    $f = "0.0";
                }
                $words[] = $dictionary[$f.$number];
                $i++;
            }
            $string .= implode(' ', $words);
            $string .= " Fils";
        }

        return $string;
    }
}
if (!function_exists('convert_number_to_wordsAR')) {
    function convert_number_to_wordsAR($number)
    {
        $hyphen = '-';
        $conjunction = ' و ';
        $separator = ', ';
        $string3 = '';
        $negative = 'سالب ';
        $decimal = ' و ';
        $dictionary = array(

            "0.0" => 'صفر',
            "0.01" => 'واحد',
            "0.02" => 'اثنان',
            "0.03" => 'ثلاثة',
            "0.04" => 'اربعة',
            "0.05" => 'خمسة',
            "0.06" => 'ستة',
            "0.07" => 'سبعة',
            "0.08" => 'ثمانية',
            "0.09" => 'تسعة',
            "0.1" => 'عشرة',
            "0.11" => 'احد عشر',
            "0.12" => 'اثنتا عشر',
            "0.13" => 'ثلاثة عشر',
            "0.14" => 'اربعة عشر',
            "0.15" => 'خمسة عشر',
            "0.16" => 'ستة عشر',
            "0.17" => 'سبعة عشر',
            "0.18" => 'ثمانية عشر',
            "0.19" => 'تسعة عشر',
            "0.2" => 'عشرون',
            "0.3" => 'ثلاثون',
            "0.4" => 'اربعون',
            "0.5" => 'خمسون',
            "0.6" => 'ستون',
            "0.7" => 'سبعون',
            "0.8" => 'ثمانون',
            "0.9" => 'تسعون',
            0 => 'صفر',
            1 => 'واحد',
            2 => 'اثنان',
            3 => 'ثلاثة',
            4 => 'اربعة',
            5 => 'خمسة',
            6 => 'ستة',
            7 => 'سبعة',
            8 => 'ثمانية',
            9 => 'تسعة',
            10 => 'عشرة',
            11 => 'احد عشر',
            12 => 'اثنتا عشر',
            13 => 'ثلاثة عشر',
            14 => 'اربعة عشر',
            15 => 'خمسة عشر',
            16 => 'ستة عشر',
            17 => 'سبعة عشر',
            18 => 'ثمانية عشر',
            19 => 'تسعة عشر',
            20 => 'عشرون',
            30 => 'ثلاثون',
            40 => 'اربعون',
            50 => 'خمسون',
            60 => 'ستون',
            70 => 'سبعون',
            80 => 'ثمانون',
            90 => 'تسعون',
            100 => 'مائة',
            200 => 'مائتان',
            300 => 'ثلاثمائة',
            400 => 'أربعمائة',
            500 => 'خمسمائة',
            600 => 'ستمائة',
            700 => 'سبعمائة',
            800 => 'ثمانمائة',
            900 => 'تسعمائة',
            1000 => 'ألف',
            1000000 => 'مليون',
            1000000000 => 'بليون',
            1000000000000 => 'تريليون',
            1000000000000000 => 'كوادرليون',
            1000000000000000000 => 'كوانتليون',
            101010 => 'آلاف ',
            101011 => 'دينار كويتي',
            101012 => ''
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {

            return $negative . convert_number_to_wordsAR(abs($number));

        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);

        }


        switch (true) {
            case $number < 21:

                $string = $dictionary[101012] . ' ' . $dictionary[$number] . '  ' . $dictionary[101011];

                break;
            case $number < 100:

                $tens = ((int)($number / 10)) * 10;

                $units = $number % 10;
                if ($units) {
                    $string = $dictionary[101012] . ' ' . $dictionary[$units] . $conjunction;
                    $string .= $dictionary[$tens] . '  ' . $dictionary[101011];
                } else {
                    $string = $dictionary[101012] . ' ' . $dictionary[$tens] . '  ' . $dictionary[101011];
                }


                break;
            case $number < 1000:

                $hundreds = $number / 100;
                $remainder = $number % 100;
                $num = (int)$hundreds . '00';

                $string = $dictionary[101012] . ' ' . $dictionary[$num];

                if ($remainder) {
                    //Check Remainder update 26-9-2018
                    if ($remainder < 21) {
                        $string3 = $dictionary[$remainder];
                    } else {
                        $tens = ((int)($remainder / 10)) * 10;

                        $units = $remainder % 10;
                        if ($units) {
                            $string3 = $dictionary[$units] . $conjunction;

                        }
                        $string3 .= $dictionary[$tens];
                    }


                    // End Update
                    $string .= $conjunction . $string3 . '  ' . $dictionary[101011];
                } else {
                    $string .= '  ' . $dictionary[101011];
                }

                break;
            default:

                $baseUnit = pow(1000, floor(log($number, 1000)));

                $numBaseUnits = (int)($number / $baseUnit);

                $remainder = $number % $baseUnit;

                if ($numBaseUnits > 1) {
                    //Check Remainder update 26-9-2018
                    if ($numBaseUnits < 21) {
                        $string3 = $dictionary[$numBaseUnits];
                    } else {
                        $tens = ((int)($numBaseUnits / 10)) * 10;

                        $units = $numBaseUnits % 10;
                        if ($units) {
                            $string3 = $dictionary[$units] . $conjunction;

                        }
                        $string3 .= $dictionary[$tens];
                    }


                    // End Update
                    if ($numBaseUnits < 11) {
                        $getthousand = $dictionary[101010];
                    } else {
                        $getthousand = $dictionary[1000];
                    }

                    $getfirstNum = $string3;

                } else {

                    $getthousand = $dictionary[$baseUnit];
                    $getfirstNum = '';
                }

                $string = $dictionary[101012] . ' ' . $getfirstNum . ' ' . $getthousand;
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $conjunction;

                    $hundreds = $remainder / 100;
                    $remainder2 = $remainder % 100;
                    $num = (int)$hundreds . '00';


                    $string2 = $dictionary[$num];

                    if ($remainder2) {
                        //Check Remainder update 26-9-2018
                        if ($remainder2 < 21) {
                            $string3 = $dictionary[$remainder2];
                        } else {
                            $tens = ((int)($remainder2 / 10)) * 10;

                            $units = $remainder2 % 10;
                            if ($units) {
                                $string3 = $dictionary[$units] . $conjunction;

                            }
                            $string3 .= $dictionary[$tens];
                        }


                        // End Update


                        $string2 .= $conjunction . $string3 . '  ' . $dictionary[101011];
                    } else {
                        $string2 .= '  ' . $dictionary[101011];
                    }


                    $string .= $string2;


                } else {
                    $string .= '  ' . $dictionary[101011];
                }

                break;
        }


        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            $i = 1;
            foreach (array_reverse(str_split((string)$fraction)) as $number) {

                if ($i == 1) {
                    $f = "0.0";
                } elseif ($i == 2) {
                    $f = "0.";
                }
                $words[] = $dictionary[$f . $number];
                $i++;
            }

            $string .= implode(' و', $words);
            $string .= " فلس ";
        }

        return $string;
    }
}

if (!function_exists('base64')) {
    function base64($imgUrl)
    {

        $folder = 'uploads/api';

        $path   = $imgUrl;
        $type   = '.jpg';
        $imgname = md5(rand() * time()) . '.' . $type;

        // Get new name of image Url & Path of folder to save in it
        $fname = $folder.'/'.$imgname;
        $img = Image::make($path);

        // End of this proccess
        $img->save($fname);

        return $fname;
    }

}

if (!function_exists('appLogger')) {
    function appLogger($message, $context = [])
    {
        if(config("app.allow_log_debug")) {
            logger($message, $context);
        }
    }

}
// Get Setting Values
if (!function_exists('setting')) {

    function setting($key, $index = null)
    {
        $value = null;
        $setting = Valuestore::make(storage_path('app/settings.json'));

        if (!is_null($index)) {

            if ($setting->get($key)) {
                $value = array_key_exists($index, $setting->get($key)) ? $setting->get($key)[$index] : null;
            }

        } else {

            $value = $setting->has($key) ? $setting->get($key) : null;

        }


        return $value ? $value : null;
    }
}

if (! function_exists('color_theme')) {

    function color_theme($category)
    {
        return $category ? $category->color : '';
    }

}

if (! function_exists('setValidationAttributes')) {

    function setValidationAttributes(array $attributes, $local = 'ar')
    {
        if(config('core.validation-attributes.'.$local)) {
            $attributes += (array)config('core.validation-attributes.'.$local);
            Illuminate\Support\Facades\Config::set('core.validation-attributes.'.$local, $attributes);
        }
    }

}

if (!function_exists('updatePaymentsPayers')) {

    function updatePaymentsPayers()
    {
        foreach(InstallmentTransaction::whereNotNull('user_id')->where('paid', 1)->get() as $transaction) {
            $instalments = $transaction->instalments()->get();
            foreach($instalments as $instalment) {
                $expectedAmount = $instalment->pivot->amount;

                $payment = $instalment->payments()
                ->where('amount', $expectedAmount)
                ->whereNotNull('transaction_date')
                ->where('pay_by_type', 'by_link')
                ->whereDate('transaction_date', '=', Carbon\Carbon::parse($transaction->updated_at)->toDateString())->first();

                if($payment) {
                    $payment->pay_by_id = $transaction->user_id;
                    $payment->save();
                }
            }
        }

        return 'done';
    }
}

if (!function_exists('ajaxSwitch')) {
    function ajaxSwitch($model, $url, $switch = 'status', $open = 1, $close = 0)
    {
        return view('apps::dashboard.components.ajax-switch', compact('model', 'url', 'switch', 'open', 'close'))->render();
    }
}

// Active Dashboard Menu
if (! function_exists('active_menu')) {
    function active_menu($routeNames)
    {
        $routeNames = (array) $routeNames;

        if(in_array(Illuminate\Support\Facades\Route::currentRouteName(), $routeNames)) {
            return 'active';
        }

        foreach ($routeNames as $routeName) {
            return (strpos(Illuminate\Support\Facades\Route::currentRouteName(), $routeName) == 0) ? '' : 'active';
        }
    }
}

if (! function_exists('active_slide_menu')) {
    function active_slide_menu($routeNames)
    {
        $response = [];
        foreach ((array)$routeNames as $name) {
            array_push($response, active_menu($name));
        }

        return in_array('active', $response) ? 'active open' : '';
    }
}

if (! function_exists('active_profile')) {

    function active_profile($route)
    {
        return (Route::currentRouteName() == $route) ? 'active' : '';
    }

}

// GET THE CURRENT LOCALE
if (! function_exists('locale')) {

    function locale()
    {
        return app()->getLocale();
    }

}

// CHECK IF CURRENT LOCALE IS RTL
if (! function_exists('is_rtl')) {

    function is_rtl($locale = null)
    {

        $locale = ($locale == null) ? locale() : $locale;

        if (in_array($locale, config('rtl_locales'))) {
            return 'rtl';
        }

        return 'ltr';
    }

}


if (! function_exists('slugfy')) {
    /**
     * The Current dir
     *
     * @param string $locale
     */
    function slugfy($string, $separator = '-')
    {
        $url = trim($string);
        $url = strtolower($url);
        $url = preg_replace('|[^a-z-A-Z\p{Arabic}0-9 _]|iu', '', $url);
        $url = preg_replace('/\s+/', ' ', $url);
        $url = str_replace(' ', $separator, $url);

        return $url;
    }
}


// if (! function_exists('path_without_domain')) {
//     /**
//      * Get Path Of File Without Domain URL
//      *
//      * @param string $locale
//      */
//     function path_without_domain($path)
//     {
//         return parse_url($path, PHP_URL_PATH);
//     }
// }


if (! function_exists('path_without_domain')) {
    /**
     * Get Path Of File Without Domain URL
     *
     * @param string $locale
     */
    function path_without_domain($path)
    {
        $url = $path;
        $parts = explode("/", $url);
        array_shift($parts);
        array_shift($parts);
        array_shift($parts);
        $newurl = implode("/", $parts);

        return $newurl;
    }
}

if (! function_exists('int_to_array')) {
    /**
     * convert a comma separated string of numbers to an array
     *
     * @param string $integers
     */
    function int_to_array($integers)
    {
        return array_map("intval", explode(",", $integers));
    }
}


if (!function_exists('combinations')) {

    function combinations($arrays, $i = 0)
    {

        if (!isset($arrays[$i])) {
            return array();
        }

        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = combinations($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }

        return $result;
    }

}


if (!function_exists('htmlView')) {
    /**
     * Access the OrderStatus helper.
     */
    function htmlView($content)
    {
        return
        '<!DOCTYPE html>
           <html lang="en">
             <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <link href="css/bootstrap.min.css" rel="stylesheet">
               <!--[if lt IE 9]>
                 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
               <![endif]-->
             </head>
             <body>
               '.$content.'
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
               <script src="js/bootstrap.min.js"></script>
             </body>
           </html>';
    }
}


if (! function_exists('currency')) {
    /**
     * The Current currency
     *
     * @param string $currency
     */
    function currency($price)
    {
        if (session()->get('currency')) {
            return convertCurrency($price) .' '. currentCurrency();
        }

        return convertCurrency($price) . ' ' . currentCurrency();
    }
}

if (! function_exists('convertCurrency')) {
    /**
     * The Convert Price
     *
     * @param string $price
     */
    function convertCurrency($price)
    {
        if (session()->get('currency')) {
            return (round(($price * session()->get('currency')['rate']) / 5) * 5);
        }

        if (Request::header('Currency-Rate')) {
            return (round(($price * \Request::header('Currency-Rate')) / 5) * 5);
        }

        return round($price);
    }
}

if (! function_exists('currentCurrency')) {
    /**
     * The Current currentCurrency
     *
     * @param string $currentCurrency
     */
    function currentCurrency()
    {
        if (session()->get('currency')) {
            return session()->get('currency')['code'];
        }

        if (Request::header('Currency-Rate')) {
            return \Request::header('Currency-Code');
        }

        return setting('default_currency');
    }
}
