<?php
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WhatsAppController;
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

// Rutas para UsuarioController
Route::post('register', [UsuarioController::class, 'register']);
Route::get('listUsers', [UsuarioController::class, 'list']);
Route::post('updateUserInfo', [UsuarioController::class, 'updateUserInfoByEmail']);
Route::post('getUserByEmail', [UsuarioController::class, 'getUserByEmail']);

// Rutas para MedicamentoController
Route::get('listMedicamentos', [MedicamentoController::class, 'list']);
Route::get('listMedicamentosByCategory/{categoria}', [MedicamentoController::class, 'listByCategory']);

// Rutas para CategoriaController
Route::get('listCategorias', [CategoriaController::class, 'list']);


// Rutas para WhatsAppController
Route::post('/send-whatsapp-message', [WhatsAppController::class, 'sendMessage']);
