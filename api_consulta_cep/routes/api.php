<?php 
use App\Http\Controllers\EnderecoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('enderecos',EnderecoController::class);

?>