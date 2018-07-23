<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('api/:version/banner/:id', 'api/:version.banner/getBanner');

Route::get('api/:version/categorys', 'api/:version.category/getCategorys');
Route::get('api/:version/category/:category_id', 'api/:version.category/getGoodsByCategory');


Route::get('api/:version/goods/news', 'api/:version.goods/getGoodsByDate');
Route::get('api/:version/goods/:goods_id', 'api/:version.goods/getDetailById');

Route::get('api/:version/themes', 'api/:version.theme/getTheme');
Route::get('api/:version/theme/:theme_id', 'api/:version.theme/getThemeById');


