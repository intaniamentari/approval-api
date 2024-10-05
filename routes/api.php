<?php

use App\Http\Controllers\API\ApprovalController;
use App\Http\Controllers\API\ApprovalStageController;
use App\Http\Controllers\API\ApproverController;
use App\Http\Controllers\API\ExpenseController;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('kategori-berita', [ExpenseController::class, 'listKategoriBerita']);
Route::post('approvers', [ApproverController::class, 'store']);
Route::post('approval-stages', [ApprovalStageController::class, 'store']);
Route::put('approval-stages/{id}', [ApprovalStageController::class, 'update']);
Route::post('expense', [ExpenseController::class, 'store']);
Route::patch('expense/{id}/approve', [ApprovalController::class, 'update']);
Route::get('expense/{id}', [ExpenseController::class, 'show']);
