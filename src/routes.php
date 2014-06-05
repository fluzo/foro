<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */



Route::get('admin/foro', array('before' => 'auth.admin', 'as' => 'admin-foro', function()
{
Return View::make('foro::admin');
}));
Route::get('admin/foro/pendiente', array('before' => 'auth.admin', 'as' => 'admin-foro-pendiente', 'uses' => '\Fluzo\Foro\AdminController@mostrar'));
Route::get('admin/foro/aprobar/{tipo}/{id}', array('before' => 'auth.admin', 'as' => 'admin-foro-aprobar', 'uses' => '\Fluzo\Foro\AdminController@aprobar'));
Route::get('admin/foro/eliminar/{tipo}/{id}', array('before' => 'auth.admin', 'as' => 'admin-foro-eliminar', 'uses' => '\Fluzo\Foro\AdminController@eliminar'));

App::before(function($request)
{
    Route::group(array('prefix' => 'foro'), function()
    {
        Route::get('crear-tema/{foro_id}', array('as' => 'crear-tema', 'uses' => '\Fluzo\Foro\TemaController@crear'));
        Route::post('crear-tema/{foro_id}', array('as' => 'crear-tema', 'uses' => '\Fluzo\Foro\TemaController@validarTema'), 'foro_id');

        Route::post('crear-post/{tema_id}', array('as' => 'crear-post', 'uses' => '\Fluzo\Foro\PostController@validarPost'), 'tema_id');

        Route::get('', array('as' => 'foro', 'uses' => '\Fluzo\Foro\ForoController@inicio'));
        Route::get('{nivel1}', array('as' => 'foro-level1', 'uses' => '\Fluzo\Foro\ForoController@unNivel'));
        Route::get('{nivel1}/{nivel2}', array('as' => 'foro-level2', 'uses' => '\Fluzo\Foro\ForoController@dosNiveles'));
        Route::get('{nivel1}/{nivel2}/{nivel3}', array('as' => 'foro-level3', 'uses' => '\Fluzo\Foro\ForoController@tresNiveles'));
        Route::get('{nivel1}/{nivel2}/{nivel3}/{nivel4}', array('as' => 'foro-level4', 'uses' => '\Fluzo\Foro\ForoController@cuatroNiveles'));
    });
});



