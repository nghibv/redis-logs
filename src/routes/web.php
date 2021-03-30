<?php

/*Route::get('contact', function(){
    return view('activity::activity');
});*/

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

});

Route::get('contact', 'Nghibv\Redislogs\Http\Controllers\ActivityController@store');


?>
