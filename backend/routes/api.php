<?php

Route::post('login', 'Api\V1\Admin\UsersApiController@login');
Route::post('driverlogin', 'Api\V1\Admin\DriversApiController@driverLogin');
Route::post('register', 'Api\V1\Admin\UsersApiController@register');
Route::post('checkPostCode', 'Api\V1\Admin\PostCodeController@checkPostCode');
Route::post('postcode_request', 'Api\V1\Admin\PostCodeController@postcodeRequest');
Route::post('upload-image', 'Api\V1\Admin\UsersApiController@imageUpload');

//Reset Password Routes
Route::post('resetpassword', 'Api\V1\Admin\PasswordResetApiController@checkEmailAndSendResetLink');


Route::post('getpaginationproducts/{id?}',   'Api\V1\Admin\CategoryProductsController@getCategoryList');


Route::group(['middleware' => 'auth:api'], function(){
Route::post('changepassword', 'Api\V1\Admin\ChangePasswordController@ChangePassword');
Route::get('user',   'Api\V1\Admin\UsersApiController@details');
Route::put('userupdate', 'Api\V1\Admin\UsersApiController@UpdateUserData');
Route::post('getcategory_list',   'Api\V1\Admin\CategoryProductsController@getCategoryListByUserId');
Route::post('searchproduct_byname',   'Api\V1\Admin\CategoryProductsController@searchProducts');
Route::get('logout', 'Api\V1\Admin\UsersApiController@logout');

Route::post('add_and_remove_cart', 'Api\V1\Admin\OrdersController@addOrRemoveToCart');
Route::get('getcart_item/{user_id}', 'Api\V1\Admin\OrdersController@getCartItem');
// Route::post('getPost', 'Api\V1\Admin\PostCodeController@geoLocate');
Route::post('gettimeslot', 'Api\V1\Admin\OrdersController@getTimeSlot');


Route::post('getcurrentorders', 'Api\V1\Admin\OrdersController@getOrderHistory');

Route::post('addcarddetails', 'Api\V1\Admin\PaymentController@addCardDetails');


Route::post('placeorder', 'Api\V1\Admin\PaymentController@chargeOrder');

Route::post('chargeorder', 'Api\V1\Admin\PaymentController@chargeOrder');

Route::post('cancelorder', 'Api\V1\Admin\PaymentController@cancelOrder');

Route::post('reorder', 'Api\V1\Admin\OrdersController@reOrder');

Route::post('applycoupon', 'Api\V1\Admin\OrdersController@applyCoupon');


// ----------------------------- Driver Routes-------------------------------------------------------------------
Route::post('changestatus', 'Api\V1\Admin\DriversApiController@onlineOffline');

Route::post('getassignedjobs', 'Api\V1\Admin\GetDriverJobs@getAssignedJobList');

Route::post('getacceptedjobs', 'Api\V1\Admin\GetDriverJobs@getAcceptedJobList');

Route::post('getjobhistory', 'Api\V1\Admin\GetDriverJobs@getJobHistory');

Route::post('getjobsbymonth', 'Api\V1\Admin\GetDriverJobs@getJobsByMonth');

Route::post('jobaccept_reject', 'Api\V1\Admin\DriversApiController@acceptOrReject');

Route::post('upload_signature', 'Api\V1\Admin\DriversApiController@signatureAndImageUpload');

Route::post('uploadimage', 'Api\V1\Admin\DriversApiController@signatureAndImageUpload');


Route::get('getnotifications', 'Api\V1\Admin\NotificationController@getNotifications');
Route::get('getcoupons', 'Api\V1\Admin\CouponContoller@getcoupons');

Route::post('onmyway', 'Api\V1\Admin\DriversApiController@onMyWay');

Route::post('sendpush', 'Api\V1\Admin\DriversApiController@sendPush');
// ----------------------------- Driver Routes End-------------------------------------------------------------------


});

Route::get('push', 'Api\V1\Admin\UsersApiController@send_method_in_apn_service');
Route::post('createtimeslot', 'Admin\TimeslotsController@collectionTime');


// ---------------------------------------------------------------------------------------------------

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');
    Route::apiResource('roles', 'RolesApiController');
    Route::apiResource('users', 'UsersApiController');
    Route::apiResource('products', 'ProductsApiController');
});
