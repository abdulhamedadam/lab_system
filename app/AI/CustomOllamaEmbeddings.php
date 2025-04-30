<?php

namespace App\AI;


use GuzzleHttp\Client;
use NeuronAI\RAG\Embeddings\OllamaEmbeddingsProvider as BaseProvider;

class CustomOllamaEmbeddings extends BaseProvider
{
    protected Client $client;
    protected string $model;
    protected string $url;

    public function __construct(string $model, string $url)
    {
        $this->model = $model;
        $this->url = $url;
        $this->client = new Client([
            'base_uri' => $this->url,
            'timeout' => 30.0,
        ]);
    }

    public function embedText(string $text): array
    {
        $response = $this->client->post('/api/embeddings', [
            'json' => [
                'model' => $this->model,
                'prompt' => $text
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true)['embedding'];
    }

    public function embedDocuments(array $documents): array
    {
        return array_map([$this, 'embedText'], $documents);
    }
}
