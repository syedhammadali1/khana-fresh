<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CopenController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FlavourController;
use App\Http\Controllers\FormEntriesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\UserPlanController;
use App\Mail\AdminNewOrderNotify;
use App\Mail\ClientEditProductBeforeDelivery;
use App\Mail\ClientNewOrderNotify;
use App\Mail\ProductOutOfStock;
use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\Zip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

// Route::get('/createusernow', function () {
//     User::create([
//         'name' => 'test',
//         'email' => 'test@gmail.com',
//         'status' => 1,
//         'password' => Hash::make('test@gmail.com'),
//     ]);
// });





Route::get('/sales', function () {
    return view('index2');
});
Route::get('/ecommerce', function () {
    return view('index3');
});
Route::get('/alternate', function () {
    return view('index4');
});
Route::get('/hospitality', function () {
    return view('index5');
});
/*App*/
Route::get('/app-emailbox', function () {
    return view('app-emailbox');
});
Route::get('/app-emailread', function () {
    return view('app-emailread');
});
Route::get('/app-chat-box', function () {
    return view('app-chat-box');
});
Route::get('/app-file-manager', function () {
    return view('app-file-manager');
});
Route::get('/app-contact-list', function () {
    return view('app-contact-list');
});
Route::get('/app-to-do', function () {
    return view('app-to-do');
});
Route::get('/app-invoice', function () {
    return view('app-invoice');
});
Route::get('/app-fullcalender', function () {
    return view('app-fullcalender');
});
/*Charts*/
Route::get('/charts-apex-chart', function () {
    return view('charts-apex-chart');
});
Route::get('/charts-chartjs', function () {
    return view('charts-chartjs');
});
Route::get('/charts-highcharts', function () {
    return view('charts-highcharts');
});
/*ecommerce*/
Route::get('/ecommerce-products', function () {
    return view('ecommerce-products');
});
Route::get('/ecommerce-products-details', function () {
    return view('ecommerce-products-details');
});
Route::get('/ecommerce-add-new-products', function () {
    return view('ecommerce-add-new-products');
});
Route::get('/ecommerce-orders', function () {
    return view('ecommerce-orders');
});

/*Components*/
Route::get('/widgets', function () {
    return view('widgets');
});
Route::get('/component-alerts', function () {
    return view('component-alerts');
});
Route::get('/component-accordions', function () {
    return view('component-accordions');
});
Route::get('/component-badges', function () {
    return view('component-badges');
});
Route::get('/component-buttons', function () {
    return view('component-buttons');
});
Route::get('/component-cards', function () {
    return view('component-cards');
});
Route::get('/component-carousels', function () {
    return view('component-carousels');
});
Route::get('/component-list-groups', function () {
    return view('component-list-groups');
});
Route::get('/component-media-object', function () {
    return view('component-media-object');
});
Route::get('/component-modals', function () {
    return view('component-modals');
});
Route::get('/component-navs-tabs', function () {
    return view('component-navs-tabs');
});
Route::get('/component-navbar', function () {
    return view('component-navbar');
});
Route::get('/component-paginations', function () {
    return view('component-paginations');
});
Route::get('/component-popovers-tooltips', function () {
    return view('component-popovers-tooltips');
});
Route::get('/component-progress-bars', function () {
    return view('component-progress-bars');
});
Route::get('/component-spinners', function () {
    return view('component-spinners');
});
Route::get('/component-notifications', function () {
    return view('component-notifications');
});
Route::get('/component-avtars-chips', function () {
    return view('component-avtars-chips');
});
/*Content*/
Route::get('/content-grid-system', function () {
    return view('content-grid-system');
});
Route::get('/content-typography', function () {
    return view('content-typography');
});
Route::get('/content-text-utilities', function () {
    return view('content-text-utilities');
});
/*Icons*/
Route::get('/icons-line-icons', function () {
    return view('icons-line-icons');
});
Route::get('/icons-boxicons', function () {
    return view('icons-boxicons');
});
Route::get('/icons-feather-icons', function () {
    return view('icons-feather-icons');
});
/*Authentication*/
Route::get('/authentication-signin', function () {
    return view('authentication-signin');
});
Route::get('/authentication-signup', function () {
    return view('authentication-signup');
});
Route::get('/authentication-signin-with-header-footer', function () {
    return view('authentication-signin-with-header-footer');
});
Route::get('/authentication-signup-with-header-footer', function () {
    return view('authentication-signup-with-header-footer');
});
Route::get('/authentication-forgot-password', function () {
    return view('authentication-forgot-password');
});
Route::get('/authentication-reset-password', function () {
    return view('authentication-reset-password');
});
Route::get('/authentication-lock-screen', function () {
    return view('authentication-lock-screen');
});
/*Table*/
Route::get('/table-basic-table', function () {
    return view('table-basic-table');
});
Route::get('/table-datatable', function () {
    return view('table-datatable');
});
/*Pages*/
Route::get('/user-profile', function () {
    return view('user-profile');
});
Route::get('/timeline', function () {
    return view('timeline');
});
Route::get('/pricing-table', function () {
    return view('pricing-table');
});
Route::get('/errors-404-error', function () {
    return view('errors-404-error');
});
Route::get('/errors-500-error', function () {
    return view('errors-500-error');
});
Route::get('/errors-coming-soon', function () {
    return view('errors-coming-soon');
});
Route::get('/error-blank-page', function () {
    return view('error-blank-page');
});
Route::get('/faq', function () {
    return view('faq');
});
/*Forms*/
Route::get('/form-elements', function () {
    return view('form-elements');
});

Route::get('/form-input-group', function () {
    return view('form-input-group');
});
Route::get('/form-layouts', function () {
    return view('form-layouts');
});
Route::get('/form-validations', function () {
    return view('form-validations');
});
Route::get('/form-wizard', function () {
    return view('form-wizard');
});
Route::get('/form-text-editor', function () {
    return view('form-text-editor');
});
Route::get('/form-file-upload', function () {
    return view('form-file-upload');
});
Route::get('/form-date-time-pickes', function () {
    return view('form-date-time-pickes');
});
Route::get('/form-select2', function () {
    return view('form-select2');
});
/*Maps*/
Route::get('/map-google-maps', function () {
    return view('map-google-maps');
});
Route::get('/map-vector-maps', function () {
    return view('map-vector-maps');
});
Route::get('/downloads', function () {
    return view('downloads');
});
Route::get('/earnings', function () {
    return view('earnings');
});
/*Un-found*/
Route::get('/test/content-grid-system', function () {
    return view('test/content-grid-system');
});
Route::get('/processing-status-dashboard', function (Request $request) {
    if ($request->for == 'get') {
        return json_encode(Session::get('dashboard'));
    }
    if ($request->for == 'put') {
        return Session::put('dashboard', $request->name);
    }
});

Route::get('/plantostripe', function () {
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    collect(Plan::all())->map(function ($plan) use ($stripe) {
        $stripeProduct = $stripe->products->create([
            'name' => $plan->name,
        ]);

        $stripePlanCreation = $stripe->plans->create([
            'amount' => $plan->price * $plan->limit * 100,
            'currency' => 'inr',
            'interval' => 'month',
            'product' => $stripeProduct->id,
        ]);

        $plan->update([
            'stripe_plan' => $stripePlanCreation->id
        ]);
    });

    dd('done');
});
Route::group(['as' => 'frontend.'], function () {
    Route::view('/front', 'frontend.layouts.app');
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::get('/plan', [FrontendController::class, 'plan'])->name('plan')->middleware('auth');
    Route::get('/categoryproducts', [FrontendController::class, 'categoryproducts'])->name('categoryproducts');
    Route::get('/productsbycategory/{id}', [FrontendController::class, 'productsbycategory'])->name('productsbycategory');
    Route::get('/showdataonload/{id}', [FrontendController::class, 'showdataonload'])->name('showdataonload');
    Route::get('/aboutus', [FrontendController::class, 'aboutus'])->name('aboutus');
    Route::get('/menu', [FrontendController::class, 'menu'])->name('menu');
    Route::get('/contactus', [FrontendController::class, 'contactus'])->name('contactus');
    Route::get('/latestnews', [FrontendController::class, 'latestnews'])->name('latestnews');
    Route::get('/myaccount', [FrontendController::class, 'myaccount'])->name('myaccount');
    Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/logout', [FrontendController::class, 'logout'])->name('logout');
    Route::post('/changePassword', [FrontendController::class, 'changePassword'])->name('changePassword');
    Route::post('/profileupdate', [FrontendController::class, 'profileupdate'])->name('profileupdate');
    Route::post('/oiquhr8t8qtb47yt97q2ih632tdigwb57r25fce', [FrontendController::class, 'checkPassword'])->name('pass.check');
    Route::get('/recipes/{product:slug}', [FrontendController::class, 'recipes'])->name('recipes');
    Route::post('/userdata', [FrontendController::class, 'userData'])->name('userdata');
    Route::get('/search', [FrontendController::class, 'search'])->name('search');
    Route::get('/singleblog/{blog}', [FrontendController::class, 'singleblog'])->name('singleblog');
    Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');
});



Route::group(['middleware' => ['auth']], function () {

    Route::get('menus/locale/redirect', [MenuController::class, 'menuLocale']);
    Route::get('page/template', [PageController::class, 'template']);


    Route::post('/media/upload', function (Request $request) {
        $page =  Page::updateOrCreate(['id' => $request->page_id], [
            'status' => 'media_draft'
        ]);
        $media =  $page->addMedia($request->file)->toMediaCollection();
        return responseSuccess([
            'page_id' => $page->id,
            'id' => $media->id,
            'url' => $media->getUrl()
        ], 'Upload Media successfully.');
    });


    Route::get('api/list/coach-languages', function (Request $request) {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('coach_languages')->select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    });

    Route::get('get-states', function (Request $request) {
        $states = DB::table('states')
            ->where('country_id', $request->country_id)
            ->get();
        if (count($states) > 0) {
            return response()->json($states);
        }
    })->name('getStates');

    Route::get('get-cities', function (Request $request) {
        $cities = DB::table('cities')
            ->where('state_id', $request->state_id)
            ->get();

        if (count($cities) > 0) {
            return response()->json($cities);
        }
    })->name('getCities');

    Route::group(['prefix' => 'crm'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('generate-pdf', [UserController::class, 'generatePDF'])->name('pdf.generate');
        Route::get('/recent-deliveries', [\App\Http\Livewire\Pages\Crm\Delivery::class, '__invoke'])->name('delivery'); // for livewire
        Route::get('/global-option', [\App\Http\Livewire\Pages\Crm\GlobalOption::class, '__invoke'])->name('option'); // for livewire
        Route::get('/export-excel', [UserController::class, 'exportIntoExcel'])->name('export-data');
        Route::get('zip-import', [ZipController::class, 'importCreate'])->name('zips.importcreate');
        Route::post('zip-import', [ZipController::class, 'import'])->name('zips.import');
        Route::get('/zip-export', [ZipController::class, 'export'])->name('zips.export');
        Route::resource('users', UserController::class);
        Route::resource('pages', PageController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('packages', PackageController::class);
        Route::resource('form-entries', FormEntriesController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('coaches', CoachController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('flavours', FlavourController::class);
        Route::resource('ingredients', IngredientController::class);
        Route::resource('nutritions', NutritionController::class);
        Route::resource('products', ProductController::class);
        // Route::get('/product-stock', [ProductController::class, 'productStock'])->name('product.stock');
        Route::resource('zips', ZipController::class);
        Route::resource('plans', PlanController::class);
        Route::resource('userplans', UserPlanController::class);
        Route::resource('copens', CopenController::class);
        Route::resource('terms', TermController::class);
        Route::get('/zipgroup', [UserPlanController::class, 'zipUserPlan'])->name('zipUserPlan');
        Route::get('products/{product}/stock-details', [\App\Http\Livewire\Pages\Crm\StockDetails::class, '__invoke'])->name('products.stock'); // for livewire
    });
});


Route::group(
    [
        'as' => 'frontend.',
        'middleware' => 'auth'
    ],
    function () {
        Route::post('cancel-plan/{userplan}', [FrontendController::class, 'planCancel'])->name('plancancel');
        Route::put('card-update/{card}', [CardController::class, 'update'])->name('updateCard');
        Route::get('{user:email}/plan/{plan:name}', [FrontendController::class, 'userMenu'])->name('plan.details');
        Route::get('{user:email}/plan/{plan:name}/edit', [FrontendController::class, 'userMenuEdit'])->name('plan.product.edit');
    }
);
Auth::routes();

Route::get('/mail', function () {
    // $product = Product::find(1);
    scheduleEmailSent4DaysBeforDelivery();

});
// Route::get('/mail', function () {
//     // $product = Product::find(1);
//     $userplan = UserPlan::where('status', 2)->orWhere('status', 3)->first();
//     // foreach
//     $oldProducts = [];
//     DB::table('product_user')
//         ->where('user_id', $userplan->user_id)
//         ->where('plan_id', $userplan->plan_id)
//         ->get(['product_id', 'quantity'])
//         ->map(function ($item) use (&$oldProducts) {
//             $oldProducts += [
//                 Product::find($item->product_id)->name =>
//                 $item->quantity,
//             ];
//         })->toArray();

//     $array = [
//         'old_product' => $oldProducts,
//         'btn-url' => route('frontend.plan.product.edit', ['user' => $userplan->user->email, 'plan' => $userplan->plan->name])
//     ];
//     dd($array);

//     return new ClientEditProductBeforeDelivery($array);
//     // Mail::to('muddasirali99@gmail.com')->send(new ProductOutOfStock($product));
// });

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Create Storage link:
Route::get('/storage-link', function () {
    Artisan::call("storage:link");
    return '<h1>Storage Link created</h1>  ';
});

//Create Storage link:
Route::get('/p2a', function () {
    scheduleUserPlanPendingToActive();
    return '<h1>User plan pending to active successfully</h1>';
});


//start shedular commmand:
Route::get('/scheduler-start', function () {
    Artisan::call("schedule:run");
    return '<h1>schedular start successfully</h1>  ';
});
