<?php



#法人
Route::get('/corps/create', 'CorpsController@create');
Route::get('/corps', 'CorpsController@index');
Route::get('/corps/{id}', 'CorpsController@show');
Route::get('/corps/register', 'CorpController@register');

Route::post('/corps/store', 'CorpsController@store');
Route::get('/corps/edit/{id}', 'CorpsController@edit');
Route::patch('/corps/{id}', 'CorpsController@update');
Route::delete('/corps/{id}', 'CorpsController@destroy');

#法人ユーザー
Route::get('/corp_users/create', 'CorpUsersController@create');
Route::post('/corp_users', 'CorpUsersController@store');
Route::get('/corp_users/{corp_user}', 'CorpUsersController@detail');
Route::get('/corp_users/edit/{corp_user}', 'CorpUsersController@edit');




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
