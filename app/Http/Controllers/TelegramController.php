<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    protected $telegramService;
    private $token;
    private $apiURL;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->apiURL = "https://api.telegram.org/bot{$this->token}/";
    }

    // Show the form
    public function showForm()
    {
        return view('telegram');
    }

    // Handle form submission
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $this->telegramService->sendMessage($request->message);

        return back()->with('success', 'Message sent successfully!');
    }

    public function handleWebhook(Request $request)
    {
        $update = $request->all();

        // التأكد أن هناك رسالة
        if (!isset($update['message'])) {
            return response()->json(['status' => 'no message'], 200);
        }

        $chatId = $update['message']['chat']['id'];
        $messageText = $update['message']['text'] ?? '';

        // الرد بناءً على محتوى الرسالة
        if (strtolower($messageText) == "مرحبا") {
            $this->sendMessage($chatId, "أهلاً وسهلاً! كيف يمكنني مساعدتك؟ 😊");
        } else {
            $this->sendMessage($chatId, "عذرًا، لم أفهم رسالتك! 🤖");
        }

        return response()->json(['status' => 'message received'], 200);
    }

    private function sendMessage1($chatId, $message)
    {
        $url = $this->apiURL . "sendMessage";
        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
}
