<?php

namespace App\Http\Controllers;

use App\AI\LawyerAgent;
use Illuminate\Http\Request;
use NeuronAI\Chat\Messages\UserMessage;

class LawyerAssistantController extends Controller
{
    public function index()
    {
        return view('lawyer-assistant');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'stream' => 'sometimes|boolean'
        ]);

        // Create agent without monitoring
        $agent = LawyerAgent::make();

        $message = new UserMessage($request->question);

        if ($request->stream ?? false) {
            return response()->stream(function() use ($agent, $message) {
                foreach ($agent->streamAnswer($message) as $chunk) {
                    echo $chunk;
                    ob_flush();
                    flush();
                    usleep(100000);
                }
            }, 200, [
                'Content-Type' => 'text/event-stream',
                'X-Accel-Buffering' => 'no',
                'Cache-Control' => 'no-cache',
            ]);
        }

        $response = $agent->answer($message);
        return response()->json([
            'answer' => $response->getContent()
        ]);
    }

    public function chatHistory()
    {
        $agent = LawyerAgent::make();
        return response()->json([
            'history' => $agent->chatHistory()->getMessages()
        ]);
    }

    public function clearHistory()
    {
        LawyerAgent::make()->chatHistory()->clear();
        return response()->json(['success' => true]);
    }
}
