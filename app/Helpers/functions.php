<?php

use Illuminate\Support\Facades\Storage;

function storePhoto($folder,  $image)
{
    $filename =  time() . '.' . $image->getClientOriginalExtension();

    $storagePath = Storage::disk('public')->path($folder);
    $image->move($storagePath, $filename);

    return $filename;
}

function deleteAllBetween($beginning, $end, $string)
{
    $beginningPos = strpos($string, $beginning);
    $endPos = strpos($string, $end);
    if ($beginningPos === false || $endPos === false) {
        return $string;
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

    return deleteAllBetween($beginning, $end, str_replace($textToDelete, '', $string));// recursion to ensure all occurrences are replaced
}

function getSystemLanguages($is_all = null, $get_name = null)
{
    if ($is_all)
        return \App\Models\SystemLanguage::pluck('name', 'iso')->toArray();
    else {
        if ($get_name)
            return \App\Models\SystemLanguage::pluck('name', 'iso')->toArray();
        else
            return \App\Models\SystemLanguage::pluck('iso')->toArray();
    }

}

function settingByKey($key)
{
    $setting = \App\Models\Setting::where('key', $key)->first();
    if (isset($setting)) {
        if ($setting->has_translation) {
            return $setting->translation()->value;
        }
        return $setting->value;
    }

    return 0;
}

function sortArrayByIndex($arr, $selIndex, $originArr)
{
    $d1 = [];
    $d2 = [];

    foreach ($arr as $k => $value) {
        if ($k >= $selIndex)
            $d1[] = $value;
        else
            $d2[] = $value;
    }
    return array_values(array_intersect(array_merge($d1, $d2), $originArr));
}
