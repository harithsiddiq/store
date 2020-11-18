<?php

const PAGINATE = 10;

function cssFolder() {
    if (app()->getLocale() == 'ar') {
        return 'css-rtl';
    } else {
        return 'css';
    }
}
function activeToString($val) {
    return $val ? 'active' : 'dis active';
}

function active_link($link) {
    if (preg_match('/'.$link.'/i', request()->segment(2))) {
        return ['open', 'is-shown'];
    } else {
        return ['',''];
    }
}

function segment() {
    return request()->segment(3);
}

function uploadImage($folder, $image) {

    $image->store('/', $folder);

    $filename = $image->hashName();

    $path = "images/{$folder}/{$filename}";

    return $path;

}

function is_active($request) {
    return $request->has('is_active') ? 1 : 0;
}

function load_categories() {

    $category_list = [];
    $category_array = [];
    $category = \App\Models\Dashboard\Category::selectRaw('id as id')
    ->selectRaw('parent_id as parent')
    ->get(['id', 'parent']);

    foreach ($category as $cat):
        $category_list['id'] = $cat->id;
        $category_list['parent'] = $cat->parent !== null ? $cat->parent : "#";
        $category_list['text'] = $cat->name;

        array_push($category_array, $category_list);
    endforeach;

    return json_encode($category_array, JSON_UNESCAPED_UNICODE);

}
