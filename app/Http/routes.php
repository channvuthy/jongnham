<?php
/*****************Route for administrator***************/
Route::get('dropzone', 'DropZoneController@dropzone');
Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'DropZoneController@dropzoneStore']);

Route::group(['prefix'=>'admin'],function(){
    Route::get('login',[
            'uses'=>'AdminController@index',
            'as'=>'login'
    ])->middleware('guest');
    Route::post('profile',[
        'uses'=>'AdminController@profile',
        'as'=>'profile'
    ]);
    
    Route::get('remove-all-store',[
        'uses'=>'AdminController@getRemoveRestaurantRequest',
        'as'=>'removeall.store'
    ]);
    
    Route::get('approall-store',[
        'uses'=>'AdminController@getApprovallRestaurantRequest',
        'as'=>'approall.store'
    ]);
    

    Route::get('store-request',[
        'uses'=>'AdminController@getStoreRequest',
        'as'=>'getStoreRequest'
    ]);
    
    Route::get('store-approval/{key}',[
       'uses'=>'AdminController@getApproval',
       'as'=>'store.approve'
    ]);

    Route::get('delete-store-request/{id}',[
        'uses'=>'AdminController@getDeleteStoreRequest',
        'as'=>'store.delete.request'
    ]);

    Route::get('logout',function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::group(['middleware'=>'auth'],function(){
        Route::get('dashboard',[
            'uses'=>'AdminController@dashboard',
            'as'=>'dashboard'
        ]);
      Route::get('store-recommend',[
          'uses'=>'AdminController@getRecommended',
          'as'=>'store.recommended'
      ]);

        Route::get('store-unrecommended/{id}',function($id){
          $store=\App\Models\Store::find($id);
           $store->recommended="0";
           $store->save();
            return redirect()->back();
        });
     
     Route::get('recommend-now/{id}',function($id){
           $store=\App\Models\Store::find($id);
           $store->recommended="1";
           $store->save();
            return redirect()->back();
     });

        Route::get('profile/{id}',[
            'uses'=>'AdminController@updateprofile',
            'as'=>'updateprofile'
        ]);
        Route::post('update-user',[
            'uses'=>'AdminController@updateuser',
            'as'=>'updateuser'
        ]);

        Route::get('users',[
            'uses'=>'AdminController@user',
            'as'=>'user'
        ]);

        Route::post('add_user',[
            'uses'=>'AdminController@add_user',
            'as'=>'add_user'
        ]);

        Route::get('update-permission',[
            'uses'=>'AdminController@updatePermission',
            'as'=>'updatePermission'
        ]);
        Route::get('permission',[
            'uses'=>'AdminController@getPermission',
            'as'=>'permission'
        ]);
        Route::get('delete-image-category',[
            'uses'=>'AdminController@getDeleteImageCategory',
            'as'=>'deleteImageCategory'
        ]);

        Route::get('update-action',[
            'uses'=>'AdminController@updateAction',
            'as'=>'updateAction'
        ]);

        Route::get('ajax-update-food',[
            'uses'=>'UserController@getAjaxUpdateFood',
            'as'=>'getAjaxUpdateFood'
        ]);

        Route::post('change-image-food',[
            'uses'=>'UserController@postChangeImageFood',
            'as'=>'postChangeImageFood'
        ]);

        Route::get('delete-post-image-store',[
            'uses'=>'UserController@deletepostimagestore',
            'as'=>'deletepostimagestore'
        ]);

        Route::get('category',[
            'uses'=>'AdminController@CategoresOfFoods',
            'as'=>'CategoresOfFoods'
        ]);

         Route::get('update-category/{id}',[
            'uses'=>'AdminController@getUpdateCategory',
            'as'=>'getupdatecategory'
        ]);

        Route::post('post-category',[
            'uses'=>'AdminController@postCategory',
            'as'=>'postCategory'
        ]);
      

        Route::post('update-category',[
            'uses'=>'AdminController@updateCategory',
            'as'=>'postUpdateCategory'
        ]);

        Route::get('delete-category/{id}',[
            'uses'=>'AdminController@getDeleteCategory',
            'as'=>'getdeletecategory'
        ]);

        
        Route::get('delete-food/{id}',[
            'uses'=>'AdminController@getDeleteFood',
            'as'=>'deletefood'
        ]);

        Route::get('edit-food/{id}',[
            'uses'=>'AdminController@getEditFood',
            'as'=>'editfood'
        ]);

        Route::get('delete-image-food',[
            'uses'=>'AdminController@getDeleteImageFood',
            'as'=>'deleteimage'
        ]);

        Route::post('update-food',[
            'uses'=>'AdminController@getUpdateFood',
            'as'=>'postupdatefood'
        ]);
        Route::get('ajaxUpdateCat',[
            'uses'=>'AdminController@ajaxUpdateCat',
            'as'=>'ajaxUpdateCat'
        ]);
        Route::get('food',[
             'uses'=>'AdminController@foods',
             'as'=>'getFoods'
        ]);

        Route::post('postFood',[
            'uses'=>'AdminController@postFood',
            'as'=>'postFood'
        ]);

        Route::get('Edit/{id}',[
            'uses'=>'AdminController@Edit',
            'as'=>'Edit'
        ]);

        Route::get('deleteFile/{id}/{key}/{file}',[
            'uses'=>'AdminController@deleteFile',
            'as'=>'deleteFile'
        ]);

        Route::post('post-update-food',[
            'uses'=>"AdminController@postUpdateFood",
            'as'=>'postUpdateFood'
        ]);
        Route::get('get-delete-food/{id}',[
            'uses'=>'AdminController@getDeleteFood',
            'as'=>'getDeleteFood'
        ]);

        Route::get('locations',[
            'uses'=>'AdminController@getLocation',
            'as'=>'getLocation'
        ]);


        Route::get('get-region',[
            'uses'=>'AdminController@getRegion',
            'as'=>'getRegion'
        ]);

        Route::post('post-to-region',[
            'uses'=>'AdminController@postRegion',
            'as'=>'postRegion'
        ]);

        Route::post('post-update-region',[
            'uses'=>"AdminController@postUpdateRegion",
            'as'=>'postUpdateRegion'
        ]);
        Route::get('delete-region',[
            'uses'=>'AdminController@deleteRegion',
            'as'=>'deleteRegion'
        ]);
        Route::post('locations',[
        'uses'=>'AdminController@postLocation',
        'as'=>'postLocation'
        ]);

        Route::post('update-location',[
            'uses'=>'AdminController@postUpdateLocation',
            'as'=>'postUpdateLocation'
        ]);

        Route::get('delete-location',[
            'uses'=>'AdminController@deleteLocation',
            'as'=>'deleteLocation'
        ]);

        Route::get('get-all-store',[
            'uses'=>'AdminController@getStore',
            'as'=>'getStore'
        ]);

        Route::get('get-edit-store/{id}',[
            'uses'=>'AdminController@getEditStore',
            'as'=>'get.edit.store'
        ]);

        Route::get('get-store-type',[
            'uses'=>'AdminController@getStoreType',
            'as'=>'getStoreType'
        ]);

        Route::post('post-to-store',[
            'uses'=>'AdminController@postStore',
            'as'=>'postStore'
        ]);

        Route::get('get-delete-image-store/{key}/{file}/{id}',[
            'uses'=>'AdminController@deleteImageStore',
            'as'=>'deleteImageStore'
        ]);

        Route::post('post-store-type',[
            'uses'=>'AdminController@postStoreType',
            'as'=>'postStoreType'
        ]);

        Route::post('post-update-store',[
            'uses'=>'AdminController@postUpdateStore',
            'as'=>'postUpdateStore'
        ]);


        Route::get('get-delete-store/{id}',[
            'uses'=>"AdminController@getDeleteStore",
            'as'=>'getDeleteStore'
        ]);


        Route::get('get-bookmark',[
            'uses'=>'AdminController@getBookmark',
            'as'=>'getBookmark'
        ]);
        Route::post('post-update-store-type',[
            'uses'=>'AdminController@postUpdateStoreType',
            'as'=>'postUpdateStoreType'
        ]);

        Route::get('delete-type',[
            'uses'=>'AdminController@deleteType',
            'as'=>'deleteType'
        ]);

        Route::get('get-list',[
            'uses'=>'AdminController@getListFood',
            'as'=>'getListFood'
        ]);

        Route::post('post-list',[
            'uses'=>'AdminController@postList',
            'as'=>'postList'
        ]);

        Route::get('get-delete-list/{id}',[
            'uses'=>'AdminController@getEditList',
            'as'=>'getEditList'
        ]);

        Route::get('delete-image-list/{key}/{file}/{id}',[
            'uses'=>'AdminController@deleteImageList',
            'as'=>'deleteImageList'
        ]);

        Route::post('get-update-list',[
            'uses'=>'AdminController@getUpdateList',
            'as'=>'getUpdateList'
        ]);

        Route::get('de;ete-list/{id}',[
            'uses'=>'AdminController@deleteList',
            'as'=>'deleteList'
        ]);
        Route::get('slider',[
        'uses'=>'SliderController@getSlider',
        'as'=>'getslider' 
        ]);
        Route::post('slider',[
            'uses'=>'SliderController@postSlider',
            'as'=>'postSlider'
        ]);
        Route::get('edit-slider/{id}',[
            'uses'=>'SliderController@getEditSlider',
            'as'=>'getEditSlider'
        ]);
        
        Route::get('delete-slider/{id}',[
            'uses'=>'SliderController@getDeleteSilder',
            'as'=>'getDeleteSilder'
        ]);
        
        Route::post('update-slider',[
            'uses'=>'SliderController@postUPdateSlider',
            'as'=>'postUpdateSlider'
        ]);
        
        Route::get('get-backgroun',[
            'uses'=>'BackgroundController@getBackground',
            'as'=>'getBackground'
        ]);
        
        Route::post('postbackgroundnormal',[
            'uses'=>'BackgroundController@postBackgroundNormal',
            'as'=>'postBackgroundNormal'
        ]);
        
        Route::post('postbackgroundimage',[
            'uses'=>'BackgroundController@postBackgroundImage',
            'as'=>'postBackgroundImage'
        ]);
        Route::get('viewbackgroundimage',[
            'uses'=>'BackgroundController@getViewBackgroundImage',
            'as'=>'viewbackgroundimage'
        ]);
        
        Route::get('deletebackgroundimage/{key}/{name}',[
            'uses'=>'BackgroundController@getDeleteBackgroundImage',
            'as'=>'getDeleteBackgroundImage'
        ]);
        Route::post('changebackgroundimage',[
            'uses'=>'BackgroundController@postChangeBackgroundImage',
            'as'=>'postChangeBackgroundImage'
        ]);
        
        Route::get('get-about',[
            'uses'=>'AboutController@getAbout',
            'as'=>'getAbout'
        ]);
        
        Route::post('post-update',[
            'uses'=>'AboutController@postAbout',
            'as'=>'postAbout'
        ]);
        Route::get('get-edit-about/{id}',[
        'uses'=>'AboutController@getEditAbout',
            'as'=>'getEditAbout'
        ]);
        
        Route::get('get-delete-about/{id}',[
            'uses'=>'AboutController@getDeleteAbout',
            'as'=>'getDeleteAbout'
        ]);
        
        Route::post('post-udate-account',[
            'uses'=>'AboutController@postUpdateAbout',
            'as'=>'postUpdateAbout'
        ]);
        
        Route::get('get-type-of-food',[
            'uses'=>'AdminController@getTypeofFood',
            'as'=>'getTypeofFood'
        ]);
        Route::get('addtypeoffood',[
            'uses'=>'AdminController@addtypeoffood',
            'as'=>'addtypeoffood'
        ]);
        Route::post('post-add-type-of-food',[
            'uses'=>'AdminController@postAddTypeofFood',
            'as'=>'postaddtypeoffood'
        ]);
        Route::get('get-view-type-of-food/{id}',[
            'uses'=>'AdminController@getViewTypeofFood',
            'as'=>'getViewTypeofFood'
        ]);
        
        Route::post('post-update-type-of-food',[
            'uses'=>'AdminController@postUpdateTypeofFood',
            'as'=>'postUpdateTypeofFood'
        ]);
        
        Route::get('get-delete-type-of-food/{id}',[
            'uses'=>'AdminController@getDeleteTypeofFood',
            'as'=>'getDeleteTypeofFood'
        ]);
        
        Route::get('get-type-of-place',[
            'uses'=>'AdminController@getTypeofPlace',
            'as'=>'getTypeofPlace'
        ]);
        
        Route::get('add-type-of-food',[
            'uses'=>'AdminController@addtypeofplace',
            'as'=>'addtypeofplace'
        ]);
        
        Route::post('post-save-type-of-place',[
            'uses'=>'AdminController@postSaveTypeofPlace',
            'as'=>'postSaveTypeofPlace'
        ]);
        
        Route::get('get-view-type-of-place/{id}',[
            'uses'=>'AdminController@getViewTypeofPlace',
            'as'=>'getViewTypeofPlace'
        ]);
        
        Route::get('get-delete-type-of-place/{id}',[
            'uses'=>'AdminController@getDeleteTypeofPlace',
            'as'=>'getDeleteTypeofPlace'
        ]);
        
        Route::post('post-update-type-of-place',[
            'uses'=>'AdminController@postUpdateTypeofPlace',
            'as'=>'postUpdateTypeofPlace'
        ]);

        Route::get('checktoactivate/{id}',[
            'uses'=>'AdminController@getCheckToActivate',
            'as'=>'checktoactivate'
        ]);

        Route::get('upload-csv-file-to-store',[
            'uses'=>'CsvController@getCsv',
            'as'=>'csv'
        ]);

        Route::post('upload-csv',[
            'uses'=>'CsvController@postCsv',
            'as'=>'upload.csv'
        ]);

        Route::get('export',[
            'uses'=>'CsvController@getExport',
            'as'=>'export'
        ]);

       
        
    }); 
});


/*
/-------------------------------------------------------------------------

/ Route User
*/

Route::group(['prefix'=>'user'],function(){
        Route::get('get-calenda',[
            'uses'=>'RestaurantController@getCalendar',
            'as'=>'getCalendar'
        ]);
        Route::get('time-working',[
                'uses'=>'RestaurantController@getWorkingTime',
                'as'=>'titme.working'
        ]);
        Route::post('search-result',[
            'uses'=>'SearchController@postSearchAllStore',
            'as'=>'search.store'
        ]);
        Route::get('gallery',[
            'uses'=>'GalleryController@getGallery',
            'as'=>'gallery'
        ]);

        Route::get('user.review',[
            'uses'=>'ReviewController@getUserReview',
            'as'=>'user.review'
        ]);
        Route::get('delete-image-store',[
            'uses'=>'GalleryController@getDeleteImage',
            'as'=>'delete.gallery'
        ]);
        Route::get('search-result',[
            'uses'=>'SearchController@getSearchAllStore',
            'as'=>'search.store'
        ]);
        Route::post('register',[
            'as'=>'user.register',
            'uses'=>'UserController@postRegister'
        ]);
        Route::post('postSaveRestaurant',[
            'uses'=>'UserController@postSaveRestaurant',
            'as'=>'postSaveRestaurant'
        ]);
          Route::get('reomovegallery',[
            'uses'=>'AdminController@getRemoveGallery',
            'as'=>'reomovegallery'
        ]);
        Route::get('confirm/email/key/{keygenerate}',[
            'uses'=>'HomeControllerVersion2@getUserConfirmationEmail',
            'as'=>'user.confirmation.email'
        ]);

        Route::get('restaurant-confirm',[
            'uses'=>'UserController@getRestuarantConfirm',
            'as'=>'restaurant.confirm'
        ]);
        
        Route::get('account',[
            'uses'=>'HomeControllerVersion2@getUserProfile',
            'as'=>'getUserProfile'
        ])->middleware('IsAdmin');

        Route::get('edit-store',[
            'uses'=>'HomeControllerVersion2@getEditStore',
            'as'=>'getEditStore'
        ]);

        Route::post('update-store-user',[
            'uses'=>'HomeControllerVersion2@postUpdateStoreUser',
            'as'=>'postUpdateStoreUser'
        ]);

        Route::get('add-user-manage-page',[
            'uses'=>'HomeControllerVersion2@postAddManageUserPage',
            'as'=>'postAddManageUserPage'
        ]);

        Route::get('check-user-exist',[
            'uses'=>'HomeControllerVersion2@getCheckExistUsrnameOrEmail',
            'as'=>'getCheckExistUsrnameOrEmail'
        ]);

        Route::get('save-user-manage-page',[
            'uses'=>'HomeControllerVersion2@getSaveUserManagmentPage',
            'as'=>'getSaveUserManagmentPage'
        ]);

        Route::get('remove-user-from-page',[
            'uses'=>'HomeControllerVersion2@getRemoveUserFromPage',
            'as'=>'getRemoveUserFromPage'
        ]);

        Route::post('login',[
            'uses'=>'HomeControllerVersion2@postUserLogin',
            'as'=>'user.login'
        ]);
        Route::post('update/profile',[
            'uses'=>'UserController@postUserUpdateProfile',
            'as'=>'postUserUpdateProfile'
        ]);
        
        Route::post('postUserChangeImage',[
            'uses'=>'UserController@postUserChangeImage',
            'as'=>'postUserChangeImage'
        ]);
        
        Route::get('logout',function(){
             Auth::logout();
             return redirect()->route('index');
            
        })->name('user.logout');

        Route::post('post-save-food',[
            'uses'=>'UserController@postSaveFood',
            'as'=>'postSaveFood'
        ]);
});
Route::get('login/', 'Auth\AuthController@redirectToProvider')->name('facebook.login');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

// =================================== version2 =======================================
Route::group(['prefix'=>''],function(){
    Route::get('/',[
        'uses'=>'HomeControllerVersion2@index',
        'as'=>'home'
        // home.version2.index
    ]);

    Route::get('restuarant-detail',[
        'uses'=>'RestaurantController@getRestaurantDetail',
        'as'=>'getRestaurantDetail'
    ]);
    Route::get('rating',[
        'uses'=>'RatingController@getRating',
        'as'=>'rating'
    ]);

   
    Route::get('store-view',[
        'uses'=>'RestaurantController@getView',
        'as'=>'store.view'
    ]);

    Route::get('store-save',[
        'uses'=>'SaveController@getSave',
        'as'=>'store.save'
    ]);
    Route::get('store-destroy',[
        'uses'=>'SaveController@getDestroy',
        'as'=>'store.destory'
    ]);

    Route::get('store-review',[
        'uses'=>'ReviewController@getReview',
        'as'=>'store.review'
    ]);

    Route::get('store-list-review',[
        'uses'=>'ReviewController@getListReview',
        'as'=>'store.getListReview'
    ]);

    Route::get('store-review-preview',[
        'uses'=>'ReviewController@getPreviewStore',
        'as'=>'store.reviewpreview'
    ]);

    Route::post('store-comment',[
        'uses'=>'ReviewController@getComment',
        'as'=>'store.comment'
    ]);

    Route::post('store-update-comment',[
        'uses'=>'ReviewController@postUpdateComment',
        'as'=>'store.updatecomment'
    ]);

    Route::get('store-search-update-comment',[
        'uses'=>'ReviewController@poseSearchUpdateComment',
        'as'=>'search.update.comment'
    ]);
     Route::get('store-search-comment',[
        'uses'=>'ReviewController@getStoreSearchComment',
        'as'=>'search.comment'
    ]);

    Route::get('store-all-save',[
        'uses'=>'SaveController@getSaveAll',
        'as'=>'store.all.save'
    ]);

    Route::post('clear.allsaved',[
        'uses'=>'SaveController@postClearAllSaved',
        'as'=>'clear.allsaved'
    ]);

    Route::get('clearsaveonebyonce',[
        'uses'=>'SaveController@getClearOnceByOnce',
        'as'=>'clearsaveonebyonce'
    ]);

    Route::get('search-review',[
        'uses'=>'SearchController@getSearchReview',
        'as'=>'search.review'
    ]);

    Route::get('search-user',[
        'uses'=>'SearchController@getSearchUser',
        'as'=>'search.user'
    ]);

      /*
    Route Search Version2
    */

    Route::get('search',[
        'uses'=>'SearchController@postGlobleSearch',
        'as'=>'search.globle'
    ]);

    Route::get('search-filter',[
        'uses'=>'SearchController@getSearchFilter',
        'as'=>'searchFilter'
    ]);

    Route::get('update-distance-location',[
        'uses'=>'SearchController@getUpdateDistance',
        'as'=>'update.distance'
    ]);

    Route::get('angular-search',[
        'uses' =>'SearchController@getAngularSeach',
        'as'=>'angularSearch'
    ]);
    Route::get('angular-search-sort-by-ranking',[
        'uses'=>'SortController@getSortByRanking',
        'as'=>'angularSearchSortByRanking'
    ]);
    Route::get('angular-search-sort-by-view',[
        'uses'=>'SortController@getSortByView',
        'as'=>'angularSearchSortByView'
    ]);
    Route::get('angular-search-sort-by-price',[
        'uses'=>'SortController@getSortByPrice',
        'as'=>'angularSearchSortByPrice'
    ]);

    Route::get('angular-search-sort-by-distance',[
        'uses'=>'SortController@getSortByDistance',
        'as'=>'angularSearchSortByDistance'
    ]);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('contact',[
    'uses'=>'MailController@html_email',
    'as'=>'contact'
]);
// Route::get('/',[
//     'uses'=>'HomeController@getHome',
//     'as'=>'home'
// ]);

Route::get('all-category',[
    'uses'=>'HomeController@getCategory',
    'as'=>'Categories'
]);


Route::get('/{name}/{id}',[
    'uses'=>'HomeController@Category',
    'as'=>'Category'
]);

Route::get('/{category_name}/{name}/{id}',[
    'uses'=>'HomeController@food_description',
    'as'=>'food_description'
]);

Route::post('search-result',[
    'uses'=>'SearchController@search',
    'as'=>'search'
]);

Route::get('search-result',function(){
    return redirect()->route('home');
})->name('search');



Route::get('autocomplete',[
    'uses'=>'HomeController@autocomplete',
    'as'=>'autocomplete'
]);

/*===Route Rating Jquery====*/
Route::post('jquery-rating',[
    'uses'=>'JqueryRaing@getRating',
    'as'=>'jqueryRating'
]);