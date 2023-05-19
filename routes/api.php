<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    AuthController,
    RegionController,
    UploadFileController,
    EmailVerificationCodeController,
    AboutController,
    CarouselController,
    CompanyNewController,
    PartnerController,
    ProductController,
    ServiceController,
    SettingController,
    TranslationController,
};

Route::post('login', [AuthController::class , 'login']);
Route::post('reset-password', [AuthController::class , 'resetPassword']);
Route::post('email-verification', [EmailVerificationCodeController::class, 'sendEmailVerification']);
Route::post('check-email-verification', [EmailVerificationCodeController::class, 'checkEmailVerification']);

Route::middleware(['auth:sanctum', 'auth.permission'])->group(function () {
    Route::get('logout', [AuthController::class , 'logout']);
    Route::get('check-user-token', [AuthController::class , 'checkUserToken']);
    Route::apiResource('user', UserController::class);
    Route::get('role', [UserController::class , 'roles'])->name('roles');
    Route::post('/upload-file', [UploadFileController::class , 'upload'])->name('upload-image.index');
    Route::apiResource('abouts', AboutController::class);
    Route::apiResource('carousels', CarouselController::class);
    Route::apiResource('companies', CompanyNewController::class);
    Route::apiResource('partners', PartnerController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('settings', SettingController::class);
    Route::apiResource('translations', TranslationController::class);
});

Route::prefix('ui')->name('ui.')->group(function () {
    Route::apiResource('abouts', AboutController::class)->only(['index', 'show']);
    Route::apiResource('carousels', CarouselController::class)->only(['index', 'show']);
    Route::apiResource('companies', CompanyNewController::class)->only(['index', 'show']);
    Route::apiResource('partners', PartnerController::class)->only(['index', 'show']);
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    Route::apiResource('services', ServiceController::class)->only(['index', 'show']);
    Route::apiResource('settings', SettingController::class)->only(['index', 'show']);
    Route::apiResource('translations', TranslationController::class)->only(['index', 'show']);
});

Route::get('token-status', function () { return "not authorized"; })->name('token-status');