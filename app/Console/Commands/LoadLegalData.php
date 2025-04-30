<?php

namespace App\Console\Commands;

use App\AI\LawyerAgent;
use Illuminate\Console\Command;
use NeuronAI\RAG\DataLoader\FileDataLoader;
use NeuronAI\RAG\DataLoader\PdfReader;

class LoadLegalData extends Command
{
    protected $signature = 'legal:load-data {path}';
    protected $description = 'Load legal documents into the vector store';

    public function handle()
    {
        $agent = new LawyerAgent();
        $path = $this->argument('path');

        $documents = FileDataLoader::for($path)
            ->addReader('pdf', PdfReader::class)
            ->getDocuments();

        $embeddedDocs = $agent->embeddings()->embedDocuments($documents);
        $agent->vectorStore()->addDocuments($embeddedDocs);

        $this->info('Successfully loaded '.count($embeddedDocs).' legal documents');
    }
}
