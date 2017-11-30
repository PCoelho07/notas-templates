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
