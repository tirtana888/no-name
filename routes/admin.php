<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'admin']], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');
    Route::get('/dashboard/statistics', 'DashboardController@index');

    // Settings - CRITICAL
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@index')->name('admin.settings');
        Route::get('/update-app', 'UpdateController@index')->name('admin.settings.update_app');
        Route::get('/{page}', 'SettingsController@page')->name('admin.settings.page');
        Route::post('/{name}/store', 'SettingsController@store')->name('admin.settings.store');
        Route::get('/seo/{page}', 'SettingsController@page');
        Route::post('/seo/metas', 'SettingsController@storeSeoMetas');
        Route::get('/socials/{key}/edit', 'SettingsController@editSocials');
        Route::post('/socials/store', 'SettingsController@storeSocials');
        Route::get('/socials/{key}/delete', 'SettingsController@deleteSocials');
        Route::get('/personalization/{name}', 'SettingsController@personalizationPage');
        Route::post('/notifications/metas', 'SettingsController@notificationsMetas');
    });

    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.users.index');
        Route::get('/create', 'UserController@create')->name('admin.users.create');
        Route::post('/', 'UserController@store')->name('admin.users.store');
        Route::get('/{id}', 'UserController@show')->name('admin.users.show');
        Route::get('/{id}/edit', 'UserController@edit')->name('admin.users.edit');
        Route::post('/{id}/update', 'UserController@update')->name('admin.users.update');
        Route::get('/{id}/delete', 'UserController@destroy')->name('admin.users.destroy');
        Route::get('/{id}/impersonate', 'UserController@impersonate');
        Route::get('/{id}/financial', 'UserController@financial');
        Route::post('/{id}/financial', 'UserController@updateFinancial');
    });

    // Staffs/Admins
    Route::group(['prefix' => 'staffs'], function () {
        Route::get('/', 'UserController@staffs')->name('admin.staffs.index');
        Route::get('/create', 'UserController@create');
        Route::post('/', 'UserController@store');
    });

    // Students
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', 'UserController@students')->name('admin.students.index');
    });

    // Instructors
    Route::group(['prefix' => 'instructors'], function () {
        Route::get('/', 'UserController@instructors')->name('admin.instructors.index');
    });

    // Organizations
    Route::group(['prefix' => 'organizations'], function () {
        Route::get('/', 'UserController@organizations')->name('admin.organizations.index');
    });

    // Webinars/Courses
    Route::group(['prefix' => 'webinars'], function () {
        Route::get('/', 'WebinarController@index')->name('admin.webinars.index');
        Route::get('/create', 'WebinarController@create')->name('admin.webinars.create');
        Route::post('/', 'WebinarController@store')->name('admin.webinars.store');
        Route::get('/{id}', 'WebinarController@show')->name('admin.webinars.show');
        Route::get('/{id}/edit', 'WebinarController@edit')->name('admin.webinars.edit');
        Route::post('/{id}/update', 'WebinarController@update')->name('admin.webinars.update');
        Route::get('/{id}/delete', 'WebinarController@destroy')->name('admin.webinars.destroy');
        Route::get('/{id}/students', 'WebinarController@students');
        Route::get('/{id}/export-students-list', 'WebinarController@exportStudentsList');
    });

    // Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.categories.index');
        Route::get('/create', 'CategoryController@create')->name('admin.categories.create');
        Route::post('/', 'CategoryController@store')->name('admin.categories.store');
        Route::get('/{id}/edit', 'CategoryController@edit')->name('admin.categories.edit');
        Route::post('/{id}/update', 'CategoryController@update')->name('admin.categories.update');
        Route::get('/{id}/delete', 'CategoryController@destroy')->name('admin.categories.destroy');
    });

    // Filters
    Route::group(['prefix' => 'filters'], function () {
        Route::get('/', 'FilterController@index')->name('admin.filters.index');
        Route::get('/create', 'FilterController@create');
        Route::post('/', 'FilterController@store');
        Route::get('/{id}/edit', 'FilterController@edit');
        Route::post('/{id}/update', 'FilterController@update');
        Route::get('/{id}/delete', 'FilterController@destroy');
    });

    // Quizzes
    Route::group(['prefix' => 'quizzes'], function () {
        Route::get('/', 'QuizController@index')->name('admin.quizzes.index');
        Route::get('/create', 'QuizController@create');
        Route::post('/', 'QuizController@store');
        Route::get('/{id}/edit', 'QuizController@edit');
        Route::post('/{id}/update', 'QuizController@update');
        Route::get('/{id}/delete', 'QuizController@destroy');
        Route::get('/results', 'QuizController@results');
    });

    // Certificates
    Route::group(['prefix' => 'certificates'], function () {
        Route::get('/', 'CertificateController@index')->name('admin.certificates.index');
        Route::get('/create', 'CertificateController@create');
        Route::post('/', 'CertificateController@store');
        Route::get('/{id}/edit', 'CertificateController@edit');
        Route::post('/{id}/update', 'CertificateController@update');
        Route::get('/{id}/delete', 'CertificateController@destroy');
    });

    // Financial 
    Route::group(['prefix' => 'financial'], function () {
        Route::get('/sales', 'SaleController@index')->name('admin.financial.sales');
        Route::get('/sales/export', 'SaleController@export');
        Route::get('/payouts', 'PayoutController@index')->name('admin.financial.payouts');
        Route::get('/payouts/{id}/confirm', 'PayoutController@confirm');
        Route::get('/payouts/{id}/reject', 'PayoutController@reject');
        Route::get('/offline-payments', 'OfflinePaymentController@index');
        Route::get('/offline-payments/{id}/approve', 'OfflinePaymentController@approve');
        Route::get('/offline-payments/{id}/reject', 'OfflinePaymentController@reject');
        Route::get('/documents', 'DocumentController@index');
        Route::get('/subscribes', 'SubscribeController@index');
        Route::get('/registration-packages', 'RegistrationPackagesController@index');
        Route::get('/discounts', 'DiscountController@index');
        Route::get('/discount/create', 'DiscountController@create');
        Route::post('/discount', 'DiscountController@store');
    });

    // Marketing
    Route::group(['prefix' => 'marketing'], function () {
        Route::get('/promotions', 'PromotionController@index');
        Route::get('/promotions/create', 'PromotionController@create');
        Route::post('/promotions', 'PromotionController@store');
        Route::get('/promotions/{id}/edit', 'PromotionController@edit');
        Route::post('/promotions/{id}/update', 'PromotionController@update');
        Route::get('/promotions/{id}/delete', 'PromotionController@destroy');
        Route::get('/advertising', 'AdvertisingBannersController@index');
        Route::get('/newsletters', 'NewsletterController@index');
        Route::get('/notifications', 'NotificationsController@index');
        Route::get('/featured', 'FeaturedTopicsController@index');
    });

    // Blog
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', 'BlogController@index')->name('admin.blog.index');
        Route::get('/create', 'BlogController@create');
        Route::post('/', 'BlogController@store');
        Route::get('/{id}/edit', 'BlogController@edit');
        Route::post('/{id}/update', 'BlogController@update');
        Route::get('/{id}/delete', 'BlogController@destroy');
        Route::get('/categories', 'BlogCategoriesController@index');
    });

    // Pages
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', 'AdditionalPageController@index')->name('admin.pages.index');
        Route::get('/create', 'AdditionalPageController@create');
        Route::post('/', 'AdditionalPageController@store');
        Route::get('/{id}/edit', 'AdditionalPageController@edit');
        Route::post('/{id}/update', 'AdditionalPageController@update');
        Route::get('/{id}/delete', 'AdditionalPageController@destroy');
    });

    // Testimonials
    Route::group(['prefix' => 'testimonials'], function () {
        Route::get('/', 'TestimonialsController@index');
        Route::get('/create', 'TestimonialsController@create');
        Route::post('/', 'TestimonialsController@store');
        Route::get('/{id}/edit', 'TestimonialsController@edit');
        Route::post('/{id}/update', 'TestimonialsController@update');
        Route::get('/{id}/delete', 'TestimonialsController@destroy');
    });

    // FAQ
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/', 'FAQController@index');
        Route::get('/create', 'FAQController@create');
        Route::post('/', 'FAQController@store');
        Route::get('/{id}/edit', 'FAQController@edit');
        Route::post('/{id}/update', 'FAQController@update');
        Route::get('/{id}/delete', 'FAQController@destroy');
    });

    // Supports/Tickets
    Route::group(['prefix' => 'supports'], function () {
        Route::get('/', 'SupportsController@index');
        Route::get('/{id}', 'SupportsController@show');
        Route::post('/{id}/reply', 'SupportsController@reply');
        Route::get('/{id}/close', 'SupportsController@close');
        Route::get('/departments', 'SupportDepartmentController@index');
    });

    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', 'CommentsController@index');
        Route::get('/webinars', 'CommentsController@webinars');
        Route::get('/bundles', 'CommentsController@bundles');
        Route::get('/blog', 'CommentsController@blog');
        Route::get('/products', 'CommentsController@products');
        Route::get('/{id}/toggle-status', 'CommentsController@toggleStatus');
        Route::get('/{id}/edit', 'CommentsController@edit');
        Route::get('/{id}/reply', 'CommentsController@reply');
        Route::get('/{id}/delete', 'CommentsController@destroy');
    });

    // Reports
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportsController@index');
        Route::get('/reasons', 'ReportReasonsController@index');
        Route::get('/webinars', 'ReportsController@webinars');
        Route::get('/comments', 'ReportsController@comments');
    });

    // Contacts
    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/', 'ContactController@index');
        Route::get('/{id}', 'ContactController@show');
        Route::get('/{id}/delete', 'ContactController@destroy');
    });

    // Notifications
    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationsController@index');
        Route::get('/create', 'NotificationsController@create');
        Route::post('/', 'NotificationsController@store');
        Route::get('/{id}/edit', 'NotificationsController@edit');
        Route::post('/{id}/update', 'NotificationsController@update');
        Route::get('/{id}/delete', 'NotificationsController@destroy');
    });

    // Noticeboard
    Route::group(['prefix' => 'noticeboard'], function () {
        Route::get('/', 'NoticeboardController@index');
        Route::get('/create', 'NoticeboardController@create');
        Route::post('/', 'NoticeboardController@store');
        Route::get('/{id}/edit', 'NoticeboardController@edit');
        Route::post('/{id}/update', 'NoticeboardController@update');
        Route::get('/{id}/delete', 'NoticeboardController@destroy');
    });

    // Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RolesController@index');
        Route::get('/create', 'RolesController@create');
        Route::post('/', 'RolesController@store');
        Route::get('/{id}/edit', 'RolesController@edit');
        Route::post('/{id}/update', 'RolesController@update');
        Route::get('/{id}/delete', 'RolesController@destroy');
    });

    // Groups
    Route::group(['prefix' => 'groups'], function () {
        Route::get('/', 'GroupsController@index');
        Route::get('/create', 'GroupsController@create');
        Route::post('/', 'GroupsController@store');
        Route::get('/{id}/edit', 'GroupsController@edit');
        Route::post('/{id}/update', 'GroupsController@update');
        Route::get('/{id}/delete', 'GroupsController@destroy');
    });

    // Badges
    Route::group(['prefix' => 'badges'], function () {
        Route::get('/', 'BadgesController@index');
        Route::get('/create', 'BadgesController@create');
        Route::post('/', 'BadgesController@store');
        Route::get('/{id}/edit', 'BadgesController@edit');
        Route::post('/{id}/update', 'BadgesController@update');
        Route::get('/{id}/delete', 'BadgesController@destroy');
    });

    // Regions
    Route::group(['prefix' => 'regions'], function () {
        Route::get('/countries', 'RegionController@countries');
        Route::get('/provinces', 'RegionController@provinces');
        Route::get('/cities', 'RegionController@cities');
        Route::get('/districts', 'RegionController@districts');
    });

    // Products (Store)
    Route::group(['prefix' => 'store'], function () {
        Route::get('/products', 'ProductController@index');
        Route::get('/products/create', 'ProductController@create');
        Route::post('/products', 'ProductController@store');
        Route::get('/products/{id}/edit', 'ProductController@edit');
        Route::post('/products/{id}/update', 'ProductController@update');
        Route::get('/products/{id}/delete', 'ProductController@destroy');
        Route::get('/categories', 'ProductCategoryController@index');
        Route::get('/orders', 'ProductOrderController@index');
        Route::get('/reviews', 'ProductReviewController@index');
    });

    // Bundles
    Route::group(['prefix' => 'bundles'], function () {
        Route::get('/', 'BundleController@index');
        Route::get('/create', 'BundleController@create');
        Route::post('/', 'BundleController@store');
        Route::get('/{id}/edit', 'BundleController@edit');
        Route::post('/{id}/update', 'BundleController@update');
        Route::get('/{id}/delete', 'BundleController@destroy');
    });

    // Forums
    Route::group(['prefix' => 'forums'], function () {
        Route::get('/', 'ForumsController@index');
        Route::get('/topics', 'ForumsTopicController@index');
        Route::get('/posts', 'ForumsTopicPostController@index');
    });

    // Assignments
    Route::group(['prefix' => 'assignments'], function () {
        Route::get('/', 'AssignmentController@index');
        Route::get('/history', 'AssignmentHistoryController@index');
    });

    // Enrollments
    Route::group(['prefix' => 'enrollments'], function () {
        Route::get('/manual', 'EnrollmentController@manual');
        Route::post('/manual', 'EnrollmentController@storeManual');
        Route::get('/history', 'EnrollmentController@history');
    });

    // AI Content
    Route::group(['prefix' => 'ai-contents'], function () {
        Route::get('/', 'AIContentsController@index');
        Route::get('/templates', 'AIContentTemplatesController@index');
    });

    // Reviews/Ratings
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('/', 'ReviewsController@index');
        Route::get('/webinars', 'ReviewsController@webinars');
        Route::get('/bundles', 'ReviewsController@bundles');
        Route::get('/{id}/toggle-status', 'ReviewsController@toggleStatus');
        Route::get('/{id}/delete', 'ReviewsController@destroy');
    });

    // Consultants/Meetings
    Route::group(['prefix' => 'consultants'], function () {
        Route::get('/', 'ConsultantsController@index');
        Route::get('/appointments', 'AppointmentsController@index');
    });

    // Reward Points
    Route::group(['prefix' => 'rewards'], function () {
        Route::get('/', 'RewardPointsController@index');
        Route::get('/settings', 'RewardPointsController@settings');
    });

    // Become Instructor
    Route::group(['prefix' => 'become-instructors'], function () {
        Route::get('/', 'BecomeInstructorController@index');
        Route::get('/{id}/reject', 'BecomeInstructorController@reject');
        Route::get('/{id}/accept', 'BecomeInstructorController@accept');
    });

    // Waiting Lists
    Route::group(['prefix' => 'waiting-lists'], function () {
        Route::get('/', 'WaitingListsController@index');
    });

    // Licenses (BYPASS - always returns valid)
    Route::group(['prefix' => 'licenses'], function () {
        Route::get('/', 'LicensesController@index')->name('admin.licenses.index');
        Route::post('/verify', 'LicensesController@verify');
        Route::post('/store', 'LicensesController@store')->name('admin.licenses.store');
    });

    // Plugin License
    Route::get('/plugin-license', 'LicensesController@index')->name('admin.plugin.license');
    Route::post('/plugin-license/store', 'LicensesController@store')->name('admin.plugin.license.store');

    // Mobile App License  
    Route::get('/mobile-license', 'LicensesController@index')->name('admin.mobile_app.license');
    Route::post('/mobile-license/store', 'LicensesController@store')->name('admin.mobile_app.license.store');

    // Theme Builder License
    Route::get('/theme-license', 'LicensesController@index')->name('admin.theme-builder.license');
    Route::post('/theme-license/store', 'LicensesController@store')->name('admin.theme-builder.license.store');

    // Update Application
    Route::group(['prefix' => 'update'], function () {
        Route::get('/', 'UpdateController@index');
        Route::post('/basic-update', 'UpdateController@basicUpdate');
        Route::post('/custom-update', 'UpdateController@customUpdate');
        Route::post('/database-update', 'UpdateController@databaseUpdate');
    });

    // Mobile App Settings
    Route::group(['prefix' => 'settings/mobile-app'], function () {
        Route::get('/', 'MobileAppSettingsController@index');
        Route::get('/{name}', 'MobileAppSettingsController@index');
        Route::post('/store', 'MobileAppSettingsController@store');
    });

    // Mobile App License
    Route::group(['prefix' => 'mobile-app-license'], function () {
        Route::get('/', 'MobileAppLicenseController@index');
        Route::post('/store', 'MobileAppLicenseController@store');
    });

    // Catch-all for any other admin routes
    Route::any('{any}', function () {
        return view('admin.errors.404');
    })->where('any', '.*');
});