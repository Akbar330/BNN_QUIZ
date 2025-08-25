<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ErrorController;

// Auth Routes
Route::get('/', function () {
    return auth()->check() ? 
        (auth()->user()->isAdmin() ? redirect()->route('admin.dashboard') : redirect()->route('quiz.index')) :
        redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/result', [AdminController::class, 'index'])->name('results.index');
        Route::get('/result/{id}', [AdminController::class, 'show'])->name('results.show');
        Route::delete('/result/{id}', [AdminController::class, 'destroy'])->name('results.destroy');
        
        // Quiz Management
        Route::get('/quizzes', [AdminController::class, 'quizzes'])->name('quizzes');
        Route::get('/quiz/create', [AdminController::class, 'createQuiz'])->name('quiz.create');
        Route::post('/quiz', [AdminController::class, 'storeQuiz'])->name('quiz.store');
        Route::get('/quiz/{quiz}', [AdminController::class, 'showQuiz'])->name('quiz.show');
        Route::get('/quiz/{quiz}/edit', [AdminController::class, 'editQuiz'])->name('quiz.edit');
        Route::put('/quiz/{quiz}', [AdminController::class, 'updateQuiz'])->name('quiz.update');
        Route::patch('/quiz/{quiz}/hide-quiz', [AdminController::class, 'toggleHideQuiz'])->name('quiz.hideQuiz');
        Route::delete('/quiz/{quiz}', [AdminController::class, 'destroyQuiz'])->name('quiz.destroy');
        
        // Question Management
        Route::get('/quiz/{quiz}/questions', [AdminController::class, 'quizQuestions'])->name('quiz.questions');
        Route::get('/quiz/{quiz}/question/create', [AdminController::class, 'createQuestion'])->name('question.create');
        Route::post('/quiz/{quiz}/question', [AdminController::class, 'storeQuestion'])->name('question.store');
        Route::get('/quiz/{quiz}/question/{question}/edit', [AdminController::class, 'editQuestion'])->name('question.edit');
        Route::put('/quiz/{quiz}/question/{question}', [AdminController::class, 'updateQuestion'])->name('question.update');
        Route::delete('/quiz/{quiz}/question/{question}', [AdminController::class, 'destroyQuestion'])->name('question.destroy');
        
        // Results
        Route::get('/quiz/{quiz}/results', [AdminController::class, 'quizResults'])->name('quiz.results');
    });
    
    // Quiz Routes for Masyarakat & Pelajar
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{quiz}/start', [QuizController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/{quiz}/take/{attempt}', [QuizController::class, 'take'])->name('quiz.take');
    Route::post('/quiz/{quiz}/submit/{attempt}', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/{quiz}/result/{attempt}', [QuizController::class, 'result'])->name('quiz.result');
    Route::get('/quiz-history', [QuizController::class, 'history'])->name('quiz.history');
});

Route::fallback(function () {
    // Log 404 untuk monitoring
    \Log::info('404 Page accessed', [
        'url' => request()->fullUrl(),
        'ip' => request()->ip(),
        'user_agent' => request()->userAgent()
    ]);

    // Return custom 404 view
    return response()->view('errors.404', [], 404);
});

// Atau bisa menggunakan controller
Route::fallback([ErrorController::class, 'notFound']);