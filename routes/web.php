<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    die();
    return view('welcome');
});
Route::get('/sitemap.xml', [SitemapController::class, 'generateSitemap']);

Route::get('/article/{any}', [ContentController::class, 'generate']);

