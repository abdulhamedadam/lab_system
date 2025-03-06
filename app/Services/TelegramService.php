<?php

namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\SoilHasaCompactionTest;
use App\Models\Admin\SoilHasaCompactionTestDetails;
use App\Models\Admin\Test;
use App\Repositories\ClientTestsRepository;
use App\Traits\ImageProcessing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Api;
class TelegramService
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendMessage($text)
    {
        return $this->telegram->sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text'    => $text
        ]);
    }

}
