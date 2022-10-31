<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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




Route::get('/index','App\Http\Controllers\storePagesController@index');
Route::get('/refund','App\Http\Controllers\PagesController@refund');
Route::resource('/item','App\Http\Controllers\InventoryController');
Route::get('/logout','App\Http\Controllers\LogoutController@logout');
Route::get('/historypage','App\Http\Controllers\PagesController@historypage');
Route::get('/confirmEmail','App\Http\Controllers\EmailController@index');
Route::get('/addtobag','App\Http\Controllers\BagController@addToBag');
Route::get('/search','App\Http\Controllers\storePagesController@search');
Route::resource('/checkout','App\Http\Controllers\CheckoutController')->middleware('auth');
Route::get('/checkoutsingle','App\Http\Controllers\CheckoutController@placeOrderBuyPrice')->middleware('auth');
Route::resource('/newmessage','App\Http\Controllers\MessagesController')->middleware('auth');
Route::post('/placeorder','App\Http\Controllers\CheckoutController@placeOrder')->middleware('auth');
Route::post('/placesingleorder','App\Http\Controllers\CheckoutController@placeSingleOrder')->middleware('auth');
Route::post('/retractbid','App\Http\Controllers\BiddingController@retractbid')->middleware('auth');
Route::resource('/membershippay','App\Http\Controllers\MemberPaymentController')->middleware('auth');
Route::post('/memberpay','App\Http\Controllers\fundController@memberPay')->middleware('auth');
//admin module
Route::get('/admin/index','App\Http\Controllers\PagesController@adminindex')->middleware('auth');
Route::get('/admin/refundreq','App\Http\Controllers\PagesController@refundreq')->middleware('auth');
Route::resource('/admin/usermanagement','App\Http\Controllers\UserManagementController')->middleware('auth');
Route::get('/add','App\Http\Controllers\PagesController@add')->middleware('auth');
Route::get('/fundings','App\Http\Controllers\PagesController@fundings')->middleware('auth');
Route::resource('/admin/list','App\Http\Controllers\itemListController')->middleware('auth');
Route::resource('/admin/auctionlist','App\Http\Controllers\AuctionDetailsController')->middleware('auth');
Route::resource('/admin/auction','App\Http\Controllers\AuctionDetailsController')->middleware('auth');
Route::get('/shipreq','App\Http\Controllers\PagesController@shipreq')->middleware('auth');
Route::resource('/admin/shippings','App\Http\Controllers\ToShipController')->middleware('auth');
Route::resource('/admin/shipped','App\Http\Controllers\ShippedController')->middleware('auth');
Route::resource('/admin/toPay','App\Http\Controllers\ToPayController')->middleware('auth');
Route::resource('/admin/completed','App\Http\Controllers\CompletedTransactionController')->middleware('auth');
Route::resource('/admin/blockedusers','App\Http\Controllers\BlockedUsersController')->middleware('auth');
Route::get('/admin/reports','App\Http\Controllers\reportsController@index')->middleware('auth');
Route::post('/deny','App\Http\Controllers\ToPayController@deny')->middleware('auth');
Route::post('/approve','App\Http\Controllers\ToPayController@update')->middleware('auth');
// Route::get('/search','App\Http\Controllers\itemListController@search');
Route::post('/itemimgup','App\Http\Controllers\imgController@itemImage')->middleware('auth');
Route::resource('/postItem','App\Http\Controllers\AuctionController')->middleware('auth');
Route::resource('/adminprofile','App\Http\Controllers\AdminProfileController')->middleware('auth');
Route::resource('/admin/feedback','App\Http\Controllers\FeedbackController')->middleware('auth');
Route::get('/admin/usermanagement/search','App\Http\Controllers\UserManagementController@search')->middleware('auth');
Route::resource('/admin/messages','App\Http\Controllers\AdminMessagesController')->middleware('auth');
Route::resource('/admin/biddings','App\Http\Controllers\AdminBiddingsController')->middleware('auth');

//profile module
Route::resource('/profile','App\Http\Controllers\ProfileController')->middleware('auth');
Route::resource('/bidhistory','App\Http\Controllers\BidHistoryController')->middleware('auth');
Route::resource('/biddings','App\Http\Controllers\BiddingController')->middleware('auth');
Route::post('/profiles','App\Http\Controllers\imgController@upload')->middleware('auth');
Route::resource('/messages','App\Http\Controllers\MessagesController')->middleware('auth');
Route::post('/addfunds','App\Http\Controllers\fundController@fundReq')->middleware('auth');
Route::resource('/bag','App\Http\Controllers\BagController')->middleware('auth');
Route::resource('/fundings','App\Http\Controllers\UserFundingsController')->middleware('auth');
Route::resource('/orders','App\Http\Controllers\UserOrdersController')->middleware('auth');
Route::resource('/history','App\Http\Controllers\UserPurchaseHistoryController')->middleware('auth');

//store Pages
    //preloved men
        Route::get('/store','App\Http\Controllers\storePagesController@store_index');
        Route::get('/store/PreLoved/men/tops','App\Http\Controllers\storePagesController@menTopsPL');
        Route::get('/store/PreLoved/men/bottoms','App\Http\Controllers\storePagesController@menBottomsPL');
        Route::get('/store/PreLoved/men/shorts','App\Http\Controllers\storePagesController@menShortsPL');
    //preloved women
        Route::get('/store/PreLoved/women/tops','App\Http\Controllers\storePagesController@womenTopsPL');
        Route::get('/store/PreLoved/women/bottoms','App\Http\Controllers\storePagesController@womenBottomsPL');
        Route::get('/store/PreLoved/women/shorts','App\Http\Controllers\storePagesController@womenShortsPL');

    //brandnew men
        Route::get('/store/BrandNew/men/tops','App\Http\Controllers\storePagesController@menTopsBN');
        Route::get('/store/BrandNew/men/bottoms','App\Http\Controllers\storePagesController@menBottomsBN');
        Route::get('/store/BrandNew/men/shorts','App\Http\Controllers\storePagesController@menShortsBN');
    //brandnew women
        Route::get('/store/BrandNew/women/tops','App\Http\Controllers\storePagesController@womenTopsBN');
        Route::get('/store/BrandNew/women/bottoms','App\Http\Controllers\storePagesController@womenBottomsBN');
        Route::get('/store/BrandNew/women/shorts','App\Http\Controllers\storePagesController@womenShortsBN');

    //brandnew men
        Route::get('/store/Bulk/men/tops','App\Http\Controllers\storePagesController@menTopsBK');
        Route::get('/store/Bulk/men/bottoms','App\Http\Controllers\storePagesController@menBottomsBK');
        Route::get('/store/Bulk/men/shorts','App\Http\Controllers\storePagesController@menShortsBK');
    //brandnew women
        Route::get('/store/Bulk/women/tops','App\Http\Controllers\storePagesController@womenTopsBK');
        Route::get('/store/Bulk/women/bottoms','App\Http\Controllers\storePagesController@womenBottomsBK');
        Route::get('/store/Bulk/women/shorts','App\Http\Controllers\storePagesController@womenShortsBK');

//reports
    Route::get('/invReport','App\Http\Controllers\reportsController@invreport');
    Route::post('/fndreport','App\Http\Controllers\reportsController@fndreport');


//footer
Route::get('/contactus','App\Http\Controllers\PagesController@contactus');
Route::get('/faqs','App\Http\Controllers\PagesController@faqs');
Route::get('/shipsandpayments','App\Http\Controllers\PagesController@shipsandpayments');
Route::get('/privacypolicy','App\Http\Controllers\PagesController@privacypolicy');
Route::get('/cookiepolicy','App\Http\Controllers\PagesController@cookiepolicy');
Route::get('/termsandcondition','App\Http\Controllers\PagesController@termsandcondition');
Route::get('/developers','App\Http\Controllers\PagesController@developers');
Route::get('/company','App\Http\Controllers\PagesController@company');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

