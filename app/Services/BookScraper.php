<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class BookScraper
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(HttpClient::create([
            'timeout' => 10,
            'verify_peer' => false,
            'verify_host' => false
        ]));
    }

    public function scrapeBookDetails($bookId)
    {

        $ch = curl_init();
        $url = "goodreads.com/book/show/" . $bookId;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        dd($response);
        if ($httpCode == 403) {
            echo "Access Denied!";
        } else {
            echo $response;
        }


        $url = "goodreads.com/book/show/" . $bookId;
        $crawler = $this->client->request('GET', $url);
        $html = file_get_contents($url);
      //  dd($html);
        if (!$crawler) {
            return null;
        }

        $book = [];

        // استخراج العنوان
        $book['title'] = $crawler->filter('h1.book-title')->count() ? $crawler->filter('h1.book-title')->text() : 'غير متوفر';

        // استخراج السعر
        $book['price'] = $crawler->filter('.price')->count() ? $crawler->filter('.price')->text() : 'غير متوفر';

        // استخراج الوصف
        $book['description'] = $crawler->filter('.description')->count() ? $crawler->filter('.description')->text() : 'غير متوفر';

        // استخراج الصورة
        $book['image'] = $crawler->filter('.book-cover img')->count() ? "https://www.neelwafurat.com" . $crawler->filter('.book-cover img')->attr('src') : null;

        // رابط الكتاب
        $book['link'] = $url;

        return $book;
    }
}
