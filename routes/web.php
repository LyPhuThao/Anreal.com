<?php

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
/*the routes will appear on the url. We can navigate to a page quickly.
For example, when we type "/UserUps" after the set homepage, 
it will display the page set forth UserUps*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('myposts','MypostController');
//Route::get('/home', 'HomeController@index')->name('home'); //thực tế ko có dùng HomeController nhưng cứ để


/*create for redirect to admin panel using middleware 
(we have changes in AdminMiddleware,kernel,LoginController files
 here auth and admin indicate to folder)*/
Route::group(['middleware'  => ['auth','admin']], function() {
	// you can use "/admin" instead of "/dashboard"
	Route::get('/dashboard', function () {
    	return view('admin.dashboard');
	});
	Route::get('dashboard','Admin\DashboardController@registered');
		//for the register on the welcome blade to appear and work
	Route::get('/role-register','Admin\DashboardController@registered');
	
	//below route for edit the users detail and update.
	Route::get('/role-edit/{id}','Admin\DashboardController@registeredit');
	//update button route
	Route::put('/role-register-update/{id}','Admin\DashboardController@registerupdate');
	//delete route
	Route::delete('/role-delete/{id}','Admin\DashboardController@registerdelete');
	/*route for dashboardv3 to active after adding <a href="{{url('/admin/dashboardv3')}}" class="nav-link">
	to the resources/views/layouts/dashboard.blade.php*/
	//Route::get('dashboardv','Admin\DashboardController@Dashboard0');
	Route::get('dashboardv1','Admin\DashboardController@Dashboard1');
	Route::get('dashboardv2','Admin\DashboardController@Dashboard2');
	Route::get('dashboardv3','Admin\DashboardController@Dashboard3');
	Route::resource('products','ProductController');
	
	

});

//
/* display supply form from resources/view/products/SupplyForm.blade.php 
When clicking on the <li><a href="UserUps">You sell</a> 
in welcome page, the EstateController@create will return the SupplyForm.blade 
(in views/products/SupplyForm). */
Route::get('/UserUps', 'EstateController@create');
/*In this form, we have 
<form action= "/UserUps" method = "POST" enctype = "multipart/form-data">...
When we click submit,EstateController@store will be executed to		
store users' uploads from the supply form*/
Route::post('/UserUps', 'EstateController@store');
/*show the products from the database, tương tự 'userSearch' is form action in 'welcome' page*/
Route::get('/userSearch', 'EstateController@show');

/* products below has path: views/products
For the following resource controller to work:  
	function index in ProductController has to return view('products.index')
	(index.blade.php in folder resources/views/products). The naming "index" here
	is critical             
	*/
//Route::resource('products','ProductController');

/* Linking to another blade view in CRUD panel
( EX: Route::resource('products','ProductController');
 + In ProductController we have function create() {return view ('products.SupplyForm')},
 +In folder views/products we have SupplyForm.blade.php
 +In another view, in another folder, say: dashboardv.blade.php in folder views/admin, 
 we can embed form SupplyForm as follows:
<a class="btn btn-success" href="{{ route('products.create') }}">Add</a> )
Upon click on Add, the command set forth in function create of ProductController
 should be applied and prompt us to SupplyForm.*/
 // without {id}, the route below would shed errors: too few arguments...
 
 Route::get('myposts/inactiv/{id}','MypostController@inactiv')->name('myposts.inactiv');

 Route::resource('myposts','MypostController');








