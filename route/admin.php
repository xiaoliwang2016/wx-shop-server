<?php
Route::post('admin/login', 'admin/Admin/login');
Route::get('admin/logout', 'admin/Admin/logout');

Route::get('admin/banner/list', 'admin/banner/list');
Route::post('admin/banner/add', 'admin/banner/add');
Route::get('admin/banner/delete/:id', 'admin/banner/delete');

Route::post('admin/category/add', 'admin/category/add');
Route::get('admin/category/delete/:id', 'admin/category/delete');

Route::post('admin/goods/add', 'admin/goods/add');
Route::get('admin/goods/delete/:id', 'admin/goods/delete');

Route::post('admin/theme/edit', 'admin/theme/modifyTheme');
