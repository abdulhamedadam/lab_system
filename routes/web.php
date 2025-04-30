<?php


use App\Http\Controllers\BookController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/lawyer-assistant', [\App\Http\Controllers\LawyerAssistantController::class, 'index'])->name('lawyer.assistant');
Route::post('/ask', [\App\Http\Controllers\LawyerAssistantController::class, 'ask'])->name('ask');
Route::get('/history', [\App\Http\Controllers\LawyerAssistantController::class, 'chatHistory'])->name('chat_h');
Route::delete('/history', [\App\Http\Controllers\LawyerAssistantController::class, 'clearHistory'])->name('name_h');

Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::post('/books/search', [BookController::class, 'search'])->name('books.search');

Route::get('/', function () {
    return view('coming-soon');
})->name('home');
/*Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('blogs', [HomeController::class, 'blogs'])->name('blogs');
    Route::get('blogs/{id}', [HomeController::class, 'one_blog'])->name('one_blog');
    Route::post('blogsComment', [HomeController::class, 'blogsComment'])->name('blogsComment');
    Route::get('contact_us', [HomeController::class, 'contact_us'])->name('contact_us');
    Route::post('SaveContact_us', [HomeController::class, 'SaveContact_us'])->name('SaveContact_us');
    Route::get('StudentRegistration', [HomeController::class, 'StudentRegistration'])->name('StudentRegistration');
    Route::post('SaveStudentRegistration', [HomeController::class, 'SaveStudentRegistration'])->name('SaveStudentRegistration');
    Route::get('contact_us', [HomeController::class, 'contact_us'])->name('contact_us');
    Route::get('events', [HomeController::class, 'events'])->name('events');
    Route::get('events/{id}', [HomeController::class, 'one_events'])->name('one_events');
    Route::get('videos', [HomeController::class, 'video'])->name('videos');
    Route::get('photos', [HomeController::class, 'photos'])->name('photos');
    Route::get('photosDetails/{id}', [HomeController::class, 'photosDetails'])->name('photosDetails');
    Route::get('teachers', [HomeController::class, 'teacher'])->name('teachers');
    Route::get('about_us', [HomeController::class, 'about'])->name('about_us');

});*/
