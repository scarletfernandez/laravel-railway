<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;


//RUTA DE  DOCENTES
Route::get('/students',[StudentController::class,'index']);
Route::get('/students/{id}',[StudentController::class,'show']);
Route::post('/students',[StudentController::class,'store']);
Route::put('/students/{id}',[StudentController::class,'update']);
Route::patch('/students/{id}',[StudentController::class,'updatePartial']);
Route::delete('/students/{id}',[StudentController::class,'destroy']);
//RUTAS DE  LOS DOCENTES
Route::get('/teachers',[TeacherController::class,'index']);
Route::get('/teachers/{id}',[TeacherController::class,'show']);
Route::post('/teachers',[TeacherController::class,'store']);
Route::put('/teachers/{id}',[TeacherController::class,'update']);
Route::patch('/teachers/{id}',[TeacherController::class,'updatePartial']);
Route::delete('/teachers/{id}',[TeacherController::class,'destroy']);