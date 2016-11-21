<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        realpath(base_path('resources/views')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),
    'paginate' => 5,

    'count_news_in_one_category' => 4,
    'count_hot_news' => 4,
    'count_news_is_title' => 4,
    'count_readest_news' => 5,
    'count_other_news' => 4,
    'offset_of_news_is_title' => 5,
    'offset_of_news_is_other' => 10,

    'count_hot_news_in_news_category' => 4,
    'count_title_news_in_news_category' => 5,
    'count_news_in_news_category' => 15,
    'count_readest_news_in_news_category' => 9,

    'hot_default' => 1,

    'status' => ['New', 'Process', 'Finish', 'Destroy']
];
