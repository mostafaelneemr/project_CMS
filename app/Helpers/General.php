<?php

use App\Models\backend\home\page;
use App\Models\backend\setting;
use App\Models\viewer;


/**
 * 
 * @return global function image
 */
function uploadImage($folder , $image)
{
    $image->store('/',$folder);
    $filename = $image->hashName();
    $path = 'image/' . $folder . '/' . $filename;
    return $path;
}

function getPages()
{
    $pages = page::where('is_published', '1')->get();
    return $pages;
}

/**
 * @return global function to return setting data in website
 */
function setting($name) 
{
    $settings = setting::where('name', $name)->select('name', 'value')->first();
    return $settings->value;
}

/**
 * 
 * @return global function count home page to review in dashboard
 */
function getCount()
{
    $view = viewer::first();
    return $view->viewer;
}