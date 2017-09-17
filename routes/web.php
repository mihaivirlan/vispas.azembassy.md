<?php
require_once 'frontend.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['guest','web','lang']],function(){
    Route::post('admin/login',['as'=>'admin/login','uses'=>'RegisterController@AdminLogin']);
    Route::get('admin/login',['as'=>'admin/login',function(){
        return view('admin.login.login');
    }]);
});
$router->group(['middleware' => ['web','admin','lang']], function () {
    Route::get('admin',['as'=>'admin','uses'=>'AdminController@Admin']);
    Route::get('admin/logout',['as'=>'admin/logout','uses'=>'RegisterController@AdminLogout']);




    //===========================================NEWS=======================================//

    Route::get('admin/news',['as'=>'admin/news',function(){
        $news=App\News::orderBy('id','desc')->get();
        return view('admin.news.news',compact('news'));
    }]);
    Route::delete('admin/news',['as'=>'admin/news','uses'=>'AdminController@NewsDelete']);
    Route::get('admin/new/{slug?}',['as'=>'admin/new','uses'=>'AdminController@NewGet']);
    Route::post('admin/new/{slug?}',['as'=>'admin/new','uses'=>'AdminController@NewPost']);
    //===========================================NEWS=======================================//




    //===========================================SETTINGS=======================================//
    Route::get('admin/contacts',['as'=>'admin/contacts','uses'=>'AdminController@Contacts']);
    Route::post('admin/contacts',['as'=>'admin/contacts','uses'=>'AdminController@ContactsPost']);
    //===========================================SETTINGS=======================================//



    //===========================================Pages=======================================//
    Route::get('admin/pages',['as'=>'admin/pages','uses'=>'AdminController@Pages']);
    Route::get('admin/pages/add',['as'=>'admin/pages/add','uses'=>'AdminController@Add']);
    Route::post('admin/pages/add',['as'=>'admin/pages/add','uses'=>'AdminController@Save']);
    Route::get('admin/pages/delete/{id}',['as'=>'admin/pages/delete','uses'=>'AdminController@PageDelete']);

    Route::delete('admin/pages',['as'=>'admin/pages','uses'=>'AdminController@PagesDelete']);
    Route::get('admin/page/{id}',['as'=>'admin/page','uses'=>'AdminController@Page']);
    Route::post('admin/page/{id}',['as'=>'admin/page','uses'=>'AdminController@PagePost']);
    //===========================================SETTINGS=======================================//




    //==========================TRANSLATER====================//
    Route::get('admin/translation',['as' => 'admin/translation','uses' => 'AdminController@test']);
    Route::post('admin/translation',['as' => 'admin/translation/set','uses' => 'AdminController@set']);
    //==========================TRANSLATER====================//




    //==========================ADMINS====================//
    Route::get('admin/register',['as'=>'admin/register','uses'=>'RegisterController@GetRegister']);
    Route::post('admin/register',['as'=>'admin/register','uses'=>'RegisterController@PostRegisterAdmin']);
    //==========================ADMINS====================//



    //=========================================SLIDER ========================================//
    Route::get('admin/sliders',['as'=>'admin/sliders','uses'=>'AdminController@Sliders']);
    Route::post('admin/slider/{id?}',['as'=>'admin/slider/{id?}','uses'=>'AdminController@PostSlider']);
    Route::get('admin/slider/{id?}',['as'=>'admin/slider','uses'=>'AdminController@Slider']);
    Route::delete('admin/sliders',['as'=>'admin/sliders','uses'=>'AdminController@DeleteSlider']);
    //=========================================SLIDER========================================//




    //=========================================HOTEL ROOMS========================================//
    Route::get('admin/hotel_rooms',['as'=>'admin/hotel_rooms','uses'=>'AdminController@HotelRooms']);
    Route::delete('admin/hotel_rooms',['as'=>'admin/hotel_rooms','uses'=>'AdminController@HotelRoomsDelete']);
    Route::post('admin/hotel_room/{id?}',['as'=>'admin/hotel_room','uses'=>'AdminController@HotelRoomPost']);
    Route::get('admin/hotel_room/{id?}',['as'=>'admin/hotel_room','uses'=>'AdminController@HotelRoom']);
    //=========================================HOTEL ROOMS========================================//





    //=========================================CATEGORIES========================================//
    Route::get('admin/categories',['as'=>'admin/categories','uses'=>'AdminController@Categories']);
    Route::get('admin/categories/{id?}',['as'=>'admin/categories','uses'=>'AdminController@CategoriesDelete']);

    Route::get('admin/category/{id}',['as'=>'admin/category','uses'=>'AdminController@Category']);
    Route::post('admin/category/{id}',['as'=>'admin/category','uses'=>'AdminController@CategoryPost']);

    Route::get('admin/category',['as'=>'admin/category/add','uses'=>'AdminController@AddCategory']);
    Route::post('admin/category',['as'=>'admin/category/save','uses'=>'AdminController@SaveCategory']);




    //=========================================HOTELROOM========================================//


    //=======================================Booking===========================================//







    //=========================================PARTNERS========================================//
    Route::get('admin/partners',['as'=>'admin/partners','uses'=>'AdminController@Partners']);
    Route::delete('admin/partners',['as'=>'admin/partners','uses'=>'AdminController@PartnersDelete']);
    Route::post('admin/partner/{id?}',['as'=>'admin/partner','uses'=>'AdminController@PartnerPost']);
    Route::get('admin/partner/{id?}',['as'=>'admin/partner','uses'=>'AdminController@Partner']);
    //=========================================PARTNERS========================================//




    //=========================================GALLERY========================================//

    Route::get('admin/gallery',['as'=>'admin/gallery','uses'=>'AdminController@Gallery']);
    Route::post('admin/gallery',['as'=>'admin/gallery','uses'=>'AdminController@GalleryPost']);
    Route::post('admin/gallery/delete',['as'=>'admin/gallery/delete','uses'=>'AdminController@GalleryDelete']);
    //=========================================GALLERY========================================//




    //=========================================ROOMBOOK========================================//
    Route::get('admin/room_books',['as'=>'admin/room_books','uses'=>'AdminController@RoomBooks']);
    Route::delete('admin/room_books',['as'=>'admin/room_books','uses'=>'AdminController@RoomBooksDelete']);
    Route::get('admin/room_book/{id?}',['as'=>'admin/room_book','uses'=>'AdminController@RoomBook']);
    Route::post('admin/room_book/{id?}',['as'=>'admin/room_book','uses'=>'AdminController@RoomBookPost']);
    //=========================================ROOMBOOK========================================//




    //=========================================CONFERENTIAL HOOL========================================//
    Route::get('admin/conference_halls',['as'=>'admin/conference_halls','uses'=>'AdminController@ConferenceHalls']);
    Route::delete('admin/conference_halls',['as'=>'admin/conference_halls','uses'=>'AdminController@ConferenceHallsDelete']);
    Route::get('admin/conference_hall/{id?}',['as'=>'admin/conference_hall','uses'=>'AdminController@ConferenceHall']);
    Route::post('admin/conference_hall/{id?}',['as'=>'admin/conference_hall','uses'=>'AdminController@ConferenceHallsPost']);
    //=========================================CONFERENTIAL HOOL========================================//





    //=========================================CONFERENTIAL HOOL========================================//
    Route::get('admin/achivements',['as'=>'admin/achivements','uses'=>'AdminController@Achivements']);
    Route::delete('admin/achivements',['as'=>'admin/achivements','uses'=>'AdminController@AchivementsDelete']);
    Route::get('admin/achivement/{id}',['as'=>'admin/achivement','uses'=>'AdminController@Achivement']);
    Route::post('admin/achivement/{id}',['as'=>'admin/achivement','uses'=>'AdminController@AchivementPost']);
    //=========================================CONFERENTIAL HOOL========================================//
});