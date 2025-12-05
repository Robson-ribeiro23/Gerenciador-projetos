<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;

// --- ROTAS PÚBLICAS (Qualquer um acessa) ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- ROTAS PROTEGIDAS (Precisa de Token) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Rotas de Projetos (CRUD automático)
    Route::apiResource('projects', ProjectController::class);
    
    // Rota de Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Rota padrão do usuário
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});