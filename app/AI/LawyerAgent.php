<?php

namespace App\AI;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use NeuronAI\Agent;
use NeuronAI\Chat\History\InMemoryChatHistory;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Ollama\Ollama;
use NeuronAI\RAG\Embeddings\EmbeddingsProviderInterface;
use NeuronAI\RAG\Embeddings\OllamaEmbeddingsProvider;
use NeuronAI\RAG\RAG;
use NeuronAI\RAG\VectorStore\VectorStoreInterface;
use NeuronAI\RAG\VectorStore\PineconeVectorStore;
use NeuronAI\Chat\History\FileChatHistory;
use NeuronAI\MCP\McpConnector;
use NeuronAI\Tools\Tool;
use NeuronAI\Tools\ToolProperty;
use NeuronAI\SystemPrompt;

class LawyerAgent extends RAG
{
    public function provider(): AIProviderInterface
    {
        // Try different endpoint variations
        $endpoints = [
            '/api/chat',
            '/v1/chat/completions',
            '/chat'
        ];

        foreach ($endpoints as $endpoint) {
            try {
                $client = new Client([
                    'base_uri' => 'http://localhost:11434',
                    'timeout' => 30
                ]);

                $client->post($endpoint, [
                    'json' => ['model' => 'llama2', 'prompt' => 'test']
                ]);

                // If request succeeds, use this endpoint
                return new CustomOllama($endpoint);
            } catch (\Exception $e) {
                continue;
            }
        }

        throw new \RuntimeException("Could not connect to Ollama API");
    }

    public function embeddings(): EmbeddingsProviderInterface
    {
        return new CustomOllamaEmbeddings(
            model: 'mxbai-embed-large',
            url: 'http://localhost:11434'
        );
    }

    public function vectorStore(): VectorStoreInterface
    {
        return new PineconeVectorStore(
            key: env('PINECONE_API_KEY'),
            indexUrl: env('PINECONE_INDEX_URL')
        );
    }

    public function chatHistory(): \NeuronAI\Chat\History\AbstractChatHistory
    {
        return new InMemoryChatHistory(
            contextWindow: 4000
        );
    }
    public function instructions(): string
    {
        return new SystemPrompt(
            background: [
            "You are an AI legal assistant specialized in Saudi law.",
            "You provide accurate legal information based on Saudi regulations and Islamic law."
        ],
            steps: [
            "First, identify the legal area of the question (family law, business law, criminal law, etc.)",
            "Retrieve relevant laws and precedents from the knowledge base",
            "Provide clear, concise answers with references to specific articles when possible",
            "For complex cases, recommend consulting a human lawyer"
        ],
            output: [
                "Start with a summary of the relevant law",
                "Cite specific articles from Saudi legal system",
                "Provide practical advice",
                "End with a disclaimer that this is not official legal counsel"
            ]
        );
    }

    public function tools(): array
    {
        return [
            // Local legal database search
            Tool::make(
                'search_legal_docs',
                'Search local Saudi legal documents'
            )->addProperty(
                new ToolProperty(
                    name: 'query',
                    type: 'string',
                    description: 'Search terms or legal question',
                    required: true
                )
            )->setCallable(function(string $query) {
                // Example using database (adjust to your schema)
                return DB::table('legal_documents')
                    ->where('content', 'like', "%$query%")
                    ->select('title', 'article_number', 'content')
                    ->limit(3)
                    ->get()
                    ->toArray();
            }),

            // Case law reference tool
            Tool::make(
                'find_case_law',
                'Find relevant Saudi legal precedents'
            )->addProperty(
                new ToolProperty(
                    name: 'case_details',
                    type: 'string',
                    description: 'Description of the legal scenario',
                    required: true
                )
            )->setCallable(function(string $caseDetails) {
                // Implement your local case law search
                return [
                    [
                        'case_number' => '2023-0456',
                        'summary' => 'Commercial dispute regarding...',
                        'ruling' => 'Court found in favor of...'
                    ]
                ];
            })
        ];
    }
}
