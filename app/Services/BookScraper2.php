<?php

namespace App\Services;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpClient\HttpClient;

class BookScraper2
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(HttpClient::create([
            'timeout' => 10,
            'verify_peer' => false, // تعطيل التحقق من SSL إذا لزم الأمر
            'verify_host' => false
        ]));
    }

    public function scrapeBooks($query)
    {
        $url = "https://www.goodreads.com/book/show/" . $query;
       // dd($url);
        $crawler = $this->client->request('GET', $url);
       // dd($crawler);
        $books = [];
        // dd($crawler);
        $title = $crawler->filter('h1')->text('');
        $author = $crawler->filter('.AuthorPreview')->text('');
        $description = $crawler->filter('[data-testid="description"] .Formatted')->text('');

        $rating = $crawler->filter('.RatingStatistics__rating')->text('');
       // dd($author);
        return [
            'title'       => trim($title),
            'author'      => trim($author),
            'description' => trim($description),
       ];

    //    return $books;
    }
}
