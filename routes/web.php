<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController; // Pastikan namespace sesuai
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CouncilEquipmentController;
use App\Http\Controllers\CouncilMemberController;
use App\Http\Controllers\CouncilStructureController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrganizationDataController;
use App\Http\Controllers\PublicAspirationController;
use App\Http\Controllers\RegionPhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/alat-kelengkapan/{slug}', [LandingController::class, 'showEquipment'])->name('landing.equipment.show');

Route::get('/kirim-aspirasi', [PublicAspirationController::class, 'create'])->name('public.aspirations.create');
Route::post('/kirim-aspirasi', [PublicAspirationController::class, 'store'])->name('public.aspirations.store');

// Route Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware(['guest', 'throttle:5,1']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('/news/{id}/track-view', [NewsController::class, 'trackView'])->name('news.track_view');

// Route Admin (Wajib Login)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/hero/edit', [HeroSectionController::class, 'edit'])->name('hero.edit');
    Route::put('/hero/update', [HeroSectionController::class, 'update'])->name('hero.update');

    Route::resource('regions', RegionPhotoController::class)->except(['create', 'edit', 'show']);
    Route::resource('members', CouncilMemberController::class)->except(['create', 'edit', 'show']);
    Route::resource('activities', ActivityController::class)->except(['create', 'edit', 'show']);
    Route::resource('organizations', OrganizationDataController::class)->except(['create', 'edit', 'show']);

    Route::resource('council-equipments', CouncilEquipmentController::class)->except(['create', 'edit', 'show']);
    Route::get('/council-structure', [CouncilStructureController::class, 'index'])->name('council-structures.index');
    Route::put('/council-structure/update', [CouncilStructureController::class, 'update'])->name('council-structures.update');

    Route::resource('news', NewsController::class)->except(['create', 'edit', 'show']);
    Route::resource('aspirations', AspirationController::class)->only(['index', 'update', 'destroy'])->names('aspirations');

    Route::get('/analytics', [AnalyticsController::class, 'analytics'])->name('analytics.index');
});
