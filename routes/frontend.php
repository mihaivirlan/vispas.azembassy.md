<?php 
Route::group(array('namespace' => 'Frontend'), function(){

	Route::get('/', ['as'=>'/','uses' => 'IndexController@index']);
	Route::get('hotel', [ 'as' => 'hotel', 'uses' => 'IndexController@hotel']);
	Route::get('room/{id}', [ 'as' => 'room', 'uses' => 'IndexController@room']);
	Route::post('room/{id}', [ 'as' => 'room', 'uses' => 'IndexController@roomPost']);
	Route::get('contacts', [ 'as' => 'contacts', 'uses' => 'IndexController@contacts']);   //
	Route::get('news/{slug?}', [ 'as' => 'news', 'uses' => 'IndexController@news']);
	Route::get('about', [ 'as' => 'about', 'uses' => 'IndexController@about']);
	Route::get('booking', [ 'as' => 'booking', 'uses' => 'IndexController@booking']);
	Route::get('page/{slug}', [ 'as' => 'page', 'uses' => 'IndexController@Page']);
    Route::get('conference/{slug?}', [ 'as' => 'conference', 'uses' => 'IndexController@conference']);
    Route::get('faq', [ 'as' => 'faq', 'uses' => 'IndexController@faq']);
    Route::get('terms', [ 'as' => 'terms', 'uses' => 'IndexController@terms']);
    Route::get('category/{slug}', [ 'as' => 'category', 'uses' => 'IndexController@category']);


});

Route::post('contacts', [ 'as' => 'contacts', 'uses' => 'ContactsFormsController@store']);   //

Route::get('instagram', 'InstagramController@index');
