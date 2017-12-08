<?php

Auth::routes();

Route::get('', function () {
    if (! Auth::check()) {
        return redirect('login');
    }
    return view('welcome');
})->name('home');

Route::get('/logout', function () {
    auth()->logout();

    return redirect('');
});

Route::resource('/clients', 'ClientsController');

Route::resource('/client-roles', 'Client\RolesController');

Route::get('/templates', 'TemplateController@index');

Route::get('/templates/create', 'TemplateController@create');
Route::get('/templates/edit', 'TemplateController@edit');

Route::prefix('api')->group(function() {
	Route::get('templates', 'TemplateController@getAll');
	Route::post('templates', 'TemplateController@store');
	Route::post('templates/delete', 'TemplateController@delete');

	Route::get('roles', 'Client\RolesController@getAll');

});
