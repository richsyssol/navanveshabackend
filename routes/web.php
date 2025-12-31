

    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FestivalGalleryController;   
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\HeroSlideController;

Route::prefix('/api')->controller(HomeController::class)->group(function () { 
    
Route::get('festival-gallery', [FestivalGalleryController::class, 'index']);
Route::get('festival-gallery/category/{categoryId}', [FestivalGalleryController::class, 'byCategory']);
    Route::get('/hero-slides', [HeroSlideController::class, 'index']);
    Route::get('/hero-slides/{id}', [HeroSlideController::class, 'show']);
    Route::get('/faqs', [FaqController::class, 'index']);
});
