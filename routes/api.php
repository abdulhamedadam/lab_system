<?php


use App\Http\Controllers\Api\AppDataController;
use App\Http\Controllers\Api\Member\OprationController;
use App\Http\Controllers\Api\Member\UsersApiController;
use App\Http\Controllers\Api\Settings;
use App\Http\Controllers\Api\Trainers\ScheduleController;
use App\Http\Controllers\Api\Trainers\TrainersController;
use App\Http\Controllers\Api\ApiComplaints;

use http\Client\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('/webhook', function (Request $request) {
    Log::info('Telegram Webhook:', $request->all());
    return response()->json(['status' => 'success']);
});


