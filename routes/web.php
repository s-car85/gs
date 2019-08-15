<?php


Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/register', function () {
    return redirect()->to('/');
})->name('register');

Route::get('/', 'PageController@index')->name('index');
Route::get('/politika-privatnosti', function () {
    return view('pages.privatnost');
});
Route::get('/uslovi-koriscenja', function () {
    return view('pages.uslovi');
});
Route::get('/dostava-povracaj', function () {
    return view('pages.dostava');
});
Route::get('/velicine', function () {
    return view('pages.velicine');
});

//KONTAKT
Route::get('/kontakt', function () {
    return view('pages.kontakt');
});
Route::post('/kontakt', 'PageController@sendQuestion');
Route::get('/hvala-kontakt', function () {
    return view('pages.thanks');
});
Route::get('/hvala-na-pitanju', function () {
    return view('pages.thanks');
});

Route::get('/pretraga', function () {
    return view('pages.search');
});
//STORE
Route::get('/gs-kutija', function () {
    return view('pages.upoznaj-stilistu');
});
Route::get('/sivenje-po-meri', 'PageController@spm');
Route::get('/gs-kutija', 'PageController@storeIndex');
Route::get('/gs-kutija/{name}/{id}', 'PageController@store');
Route::get('/prodavnica', 'PageController@storeIndex');
Route::get('/prodavnica/{name}/{id}', 'PageController@store');

//PRETRAGA
Route::get('pretraga', 'PageController@searchByTermPaginated');
Route::get('/proizvod/{name}/{id}', 'PageController@product');

//CART
Route::post('/proizvod/add/{id}', 'PageController@addCart')->name('addCart');
Route::post('/proizvod/remove/{id}', 'PageController@removeCart')->name('removeCart');
Route::get('/korpa', 'PageController@showCart');

//CHECKOUT
Route::get('/placanje', 'PageController@checkout');
Route::get('/hvala-uplatnica', 'PageController@tnxUplatnica');
Route::get('/hvala', 'PageController@tnx');

//PLACANJE
Route::post('/placanje', 'PaymentController@payment')->name('payment');
Route::post('/bank', 'PaymentController@index');
Route::post('/bankok', 'PaymentController@ok');
Route::post('/banknok', 'PaymentController@notok');

//KORISNICKI PROFIL
Route::get('/profil', 'ProfileController@profile');
Route::get('/izmena-podataka', 'ProfileController@profileData');
Route::put('/izmena-podataka', 'ProfileController@updateProfileData');
Route::get('/izmena-lozinke', 'ProfileController@userPassword');
Route::put('/izmena-lozinke', 'ProfileController@updatePassword');
Route::get('/status-porudzbenica', 'ProfileController@status');
Route::get('/status-porudzbenice/{orderId}', 'ProfileController@statusDetail');



// Admin
Route::group(['prefix' => 'ci-admin'],  function () {

    Route::get('login', 'admin\HomeController@login')->name('adminLogin');

    Route::group(['middleware' => ['auth', 'admin']], function() {
        Route::get('/', 'admin\HomeController@index')->name('home');
        Route::resource('gallery', 'admin\ImageGalleryController');
        Route::post('gallery/sort', 'admin\ImageGalleryController@sort');

        Route::resource('categories', 'admin\CiCategoriesController');
        Route::post('categories/sort', 'admin\CiCategoriesController@sort');
        Route::put('categories/visible/{id}', 'admin\CiCategoriesController@visible');
        Route::resource('products', 'admin\ProductsController');
        Route::get('products/create-prooduct/{id}', 'admin\ProductsController@createProduct');
        Route::get('productsData/{id}', 'admin\ProductsController@productsData')->name('productsData');
        Route::put('products/visible/{id}', 'admin\ProductsController@visible');
        Route::post('reorderDataProducts',['as' => 'products.order', 'uses' => 'admin\ProductsController@reorderData']);

        Route::resource('element', 'admin\ElementController');

        Route::resource('orders', 'admin\OrdersController');
        Route::get('ordersData/', 'admin\OrdersController@OrdersData')->name('ordersData');
        Route::put('ordersStatus/{id}', 'admin\OrdersController@update')->name('ordersStatus');

        // upload image products
        Route::post('/images-save', 'admin\UploadImagesController@store')->name('uplImgPro');
        Route::delete('/images-delete/{id}', 'admin\UploadImagesController@destroy');
        // settings
        Route::post('settings/set_img', 'admin\SettingsController@setImage')->name('setImage');

         //Slider photos
        Route::resource('sliders', 'admin\SlidersController',  ['except' => ['show']]);
        //Slider data
        Route::get('slidersData',['as' => 'sliders.data', 'uses' => 'admin\SlidersController@slidersData']);
         //Edit ajax photo
        Route::get('sliders/edit',['as'=>'sliders.editphoto', 'uses'=> 'admin\SlidersController@editPhoto']);
         //Delete ajax photo
        Route::delete('sliders',['as'=>'sliders.deletephoto', 'uses'=> 'admin\SlidersController@destroySlider']);
        Route::delete('/image-photos', 'admin\SlidersController@imageDelete');
        Route::post('reorderData',['as' => 'sliders.order', 'uses' => 'admin\SlidersController@reorderData']);



        // Users
        Route::resource('/users', 'admin\UsersController');
        Route::get('usersData',['as' => 'users.data', 'uses' => 'admin\UsersController@usersData']);
    });
});


