<?php

  Route::redirect('/', '/login');
  Route::redirect('/home', '/admin');
  Auth::routes(['register' => false]);

Route::post('checkemail','CheckEmailController@checkEmail');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
     Route::get('/', 'HomeController@index')->name('home');
      Route::post('checkEmailIsAlready','UsersController@checkEmailIsAlready');
      
      Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
      Route::resource('permissions', 'PermissionsController');
       

      Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
      Route::resource('roles', 'RolesController');


      Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
      Route::resource('users', 'UsersController');

      Route::delete('drivers/destroy', 'DriversController@massDestroy')->name('drivers.massDestroy');
      Route::resource('drivers', 'DriversController');
      Route::get('viewtask/{id}', 'DriversController@viewTask')->name('viewtask');

      Route::post('blockuser', 'DriversController@blockUsers')->name('blockuser');
      Route::post('post_code_publish_unpublish', 'PostCodeController@publishUnpublish')->name('post_code_publish_unpublish');


      Route::delete('clients/destroy', 'DriversController@massDestroy')->name('clients.massDestroy');
      Route::resource('clients', 'ClientsController');


      Route::resource('products', 'ProductsController');
      Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

      Route::delete('category/destroy', 'CategoryController@massDestroy')->name('category.massDestroy');
      Route::resource('category', 'CategoryController');
      
      Route::post('changeStatus', 'UsersController@changeStatus');

      Route::delete('admin/coupons', 'CouponsController@massDestroy')->name('coupons.massDestroy');
      Route::resource('coupons', 'CouponsController');

      Route::get('admin/driver_request','DriversController@showDriverRequest')->name('show.driver_request');

      Route::delete('postcode/destroy', 'PostCodeController@massDestroy')->name('postcode.massDestroy');
      Route::resource('postcode','PostCodeController');
      
      Route::delete('timeslot/destroy', 'TimeslotsController@massDestroy')->name('timeslot.massDestroy');
      Route::resource('timeslot','TimeslotsController');
      Route::post('create_time_slot','TimeslotsController@createTimeSlot');
      
      Route::resource('order','OrdersController');
      Route::post('assignjob','OrdersController@assignJob')->name('assignjob');
      // Route::post('addtimeslot','OrdersController@addTimeSlot')->name('addtimeslot');

      Route::resource('pushnotification','PushNotificationController');
      
      Route::get('skiporders','OrdersController@skipOrders');

      // Route::get('preview-image-upload', 'Admin\ImageUploadController@index');
      // Route::post('preview-image-upload', 'Admin\ImageUploadController@store')->name('preview-image-upload');
       Route::post('save-photo', 'ImageUploadController@store');

});


// *************************************************************************************************
// --------------------------------------------------------------------------------------------
  Route::get('signup/activate/{token}', 'Api\V1\Admin\UsersApiController@signupActivate');
  Route::get('find/{token}', 'Api\V1\Admin\PasswordResetApiController@find');
  Route::post('resetrequest', 'Api\V1\Admin\PasswordResetApiController@reset')->name('resetrequest');
  Route::get('wp/checkPostCode/{post_code?}', 'Admin\PostCodeController@checkPostCode');
// --------------------------------------------------------------------------------------------
// ***************************************************************************************************


   Route::get('user', 'Frontend\UsersController@index')->name('user');
   Route::get('signup', 'Frontend\UsersController@signUp')->name('signup');
   Route::post('user/register', 'Frontend\UsersController@store')->name('user/register');
   Route::get('user/login', 'Frontend\UsersController@login')->name('user/login');
   Route::post('user/userLogin', 'Frontend\UsersController@userLogin')->name('user/userLogin');
   Route::post('user/forgetpassword', 'Frontend\UsersController@sendResetLink')->name('user/forgetpassword');


  Route::get('price/list', 'Frontend\ProductCategoryController@priceList')->name('price/list');
  Route::get('products/list','Frontend\ProductCategoryController@getProducts')->name('products/list');
  Route::post('productsbyid/{id?}','Frontend\ProductCategoryController@getProductByCatId')->name('productsbyid');
  
  Route::get('productsby/{id?}','Frontend\ProductCategoryController@getProductByCatId')->name('productsbyid');

  Route::get('how-it-works', 'Frontend\UsersController@howItWorks')->name('how-it-works');
  Route::post('send-app-link', 'Frontend\MessageController@sendAppLink');
  Route::post('subscribe-newsletter', 'Frontend\MessageController@subscribeNewsLetter');


  Route::get('checkout','Frontend\UsersController@goToCheckout')->name('checkout');
  Route::post('user/check-post-code', 'Frontend\UsersController@checkPostCode')->name('user/check-post-code');


    Route::group(['middleware' => 'auth:web'], function(){
        Route::get('user/logout', 'Frontend\UsersController@logout')->name('user/logout');
        Route::get('commercial-services','Frontend\UsersController@commercialServices')->name('commercial-services');
        Route::get('refer-a-friend', 'Frontend\UsersController@referToFriend')->name('refer-a-friend');
});
        Route::get('userdashboard','Frontend\UsersController@dashboard')->name('userdashboard');

