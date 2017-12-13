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


// Route::get('/vinculo-clients', '');

Route::get('/templates', 'TemplateController@index');
Route::get('/templates/create', 'TemplateController@create');
Route::get('/templates/edit', 'TemplateController@edit');

Route::get('/cliente-qualificacao', 'Client\QualificacaoController@index');
Route::get('/cliente-qualificacao/create', 'Client\QualificacaoController@create');

Route::get('/tokens/create', 'TokenController@create');

Route::prefix('api')->group(function() {
    Route::get('templates', 'TemplateController@getAll');
    Route::post('templates/content', 'TemplateController@getContentTemplate');
    Route::post('templates', 'TemplateController@store');
    Route::post('templates/delete', 'TemplateController@delete');

    Route::get('roles', 'Client\RolesController@getAll');
    Route::get('role/{id}/templates', 'Client\RolesController@getTemplatesByRole');

    Route::get('cliente-qualificacao', 'Client\QualificacaoController@getAll');
    Route::post('cliente-qualificacao', 'Client\QualificacaoController@store');
    Route::post('cliente-qualificacao/delete', 'Client\QualificacaoController@delete');

    Route::get('clients', 'ClientsController@getAll');
    Route::get('clients/table/columns', 'ClientsController@getTableColumns');

    Route::get('tokens', 'TokenController@getAll');
    Route::post('tokens', 'TokenController@store');

});

