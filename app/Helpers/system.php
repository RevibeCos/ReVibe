<?php

use Illuminate\Support\Facades\File;

function empObj()
{
    return new stdClass();
}


function version_api()
{
    return '/v1';
}

function namespace_api()
{
    return 'Api';
}

function message($status_code)
{
    switch ($status_code) {
        case 200:
            return __('app.success');
        case 400:
            return __('app.not_data_found');
        case 401:
            return __('app.failure_authorization');
        case 404:
            return __('app.invalid_route');
        case 407:
            return __('app.verify_code');
        case 422:
            return __('app.client_input_error');//'Client input error.';
        case 500:
            return __('app.server_error');//'Something went wrong. Please try again later.';
    }
    return 'Sorry! You do not have permission.';
}

function authAdmin()
{
    if (auth()->guard('admin')->check())
        return auth()->guard('admin')->user();
    return null;
}

function authApi()
{
    if (auth()->guard('api')->check())
        return auth()->guard('api')->user();
    return null;
}

function authWeb()
{
    if (auth()->guard('web')->check())
        return auth()->guard('web')->user();
    return null;
}

function authWebId()
{
    if (auth()->guard('web')->check())
        return auth()->guard('web')->user()->id;
    return null;
}

function authApiId()
{
    if (auth()->guard('api')->check())
        return auth()->guard('api')->user()->id;
    return null;
}

function max_pagination($record = 10.0)
{
    return $record;
}

function page_count($num_object, $page_size)
{
    return ceil($num_object / (doubleval($page_size)));
}

function response_api($status, $statusCode, $message = null, $object = null, $page_count = null, $page = null, $count = null, $errors = null, $another_data = null)
{

    $message = isset($message) ? $message : message($statusCode);
    $error = ['status' => false, 'statusCode' => $statusCode, 'message' => $message];
    $success = ['status' => true, 'statusCode' => $statusCode, 'message' => $message];

    if ($status && isset($object)) {
        if (isset($page_count) && isset($page))
            $success['data'] = ['data' => $object, 'total_pages' => $page_count, 'current_page' => $page + 1, 'total_records' => $count];
        else
            $success['data'] = $object;


    } else if (!$status && isset($errors))
        $error['errors'] = $errors;
    else if (isset($object) || (is_array($object) && empty($object)))
        $error['data'] = $object;
    else
        $success['data'] = null;

    if (isset($another_data))
        foreach ($another_data as $key => $value)
            $success [$key] = $value;

    $response = ($status) ? $success : $error;

    return response()->json($response);
}

function myFilter($var)
{
    return ($var !== NULL && $var !== FALSE && $var !== '');
}


// function getPublicImage($size, $folder, $file)
// {
//     $path = storage_path('app/public/' . $folder . '/' . $file);

//     if (!File::exists($path))
//         $path = storage_path('app/uploads/images/default_image.png');

//     if (!File::exists($path)) abort(404);

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $sizes = explode("x", $size);

//     if (is_numeric($sizes[0]) && is_numeric($sizes[1])) {

//         $manager = new \Intervention\Image\ImageManager();
//         $image = $manager->make($file)->fit($sizes[0], $sizes[1], function ($constraint) {
//             $constraint->upsize();
//         });

//         $response = response()->make($image->encode($image->mime), 200);

//         $response->header("CF-Cache-Status", 'HIF');
//         $response->header("Cache-Control", 'max-age=604800, public');
//         $response->header("Content-Type", $type);

//         return $response;

//     } else {
//         abort(404);
//     }
// }

function google_api_key()
{
    return 'AIzaSyAmT6GrixHoX14Pk0cz0m_W8YkblFgm-3w';
}

function distance($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'K', $decimals = 2)
{
    // Calculate the distance in degrees
    $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));

    // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
    switch ($unit) {
        case 'K':
            $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
            break;
        case 'mi':
            $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
            break;
        case 'nmi':
            $distance = $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
    }
    return round($distance, $decimals);
}

function carCode($code)
{

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://car-code.p.rapidapi.com/obd2/" . $code,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: car-code.p.rapidapi.com",
            "X-RapidAPI-Key: 8107d28185mshbb985230b9ceb0fp136d31jsn897c837657b2"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return json_decode($response, true);
    }


}
