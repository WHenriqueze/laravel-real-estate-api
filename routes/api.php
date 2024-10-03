<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\VisitController;

Route::post('login', [LoginController::class, 'login']);

Route::apiResource('personas', PersonController::class)
      ->middleware('auth:sanctum');

Route::apiResource('propiedades', PropertyController::class)
      ->middleware('auth:sanctum');

Route::apiResource('solicitudes', VisitController::class)
      ->middleware('auth:sanctum');
