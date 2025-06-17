<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SMSController;


Route::post("/otp", [SMSController::class, "otp"]);

