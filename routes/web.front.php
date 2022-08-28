<?php

// Facades.
use Illuminate\Support\Facades\Route;

// Controllers.
// Common controllers.
use App\Http\Controllers\Front\SitemapController;

// Module controllers.
use App\Http\Controllers\Front\Modules\HomeController;
use App\Http\Controllers\Front\Modules\ExpertisesController;
use App\Http\Controllers\Front\Modules\AboutController;
use App\Http\Controllers\Front\Modules\ContactController;
use App\Http\Controllers\Front\Modules\PageController;

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

// Redirect the routes if the users accidentally go to a wrong url.
Route::redirect('/', '/admin/login');
