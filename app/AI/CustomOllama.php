<?php

namespace App\AI;

use NeuronAI\Providers\Ollama\Ollama as BaseOllama;

class CustomOllama extends BaseOllama
{
    protected string $chatEndpoint = '/api/chat';
    protected string $generateEndpoint = '/api/generate';

    public function __construct(
        string $url,
        string $model,
        array $parameters = []
    ) {
        parent::__construct($url, $model, $parameters);
    }
}
