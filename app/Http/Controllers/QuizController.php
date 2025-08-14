<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserAnswer;
use Carbon\Carbon;

class QuizController extends Controller
{
public function index()
{
    $user = auth()->user();

    $attempts = $user->quizAttempts()
        ->whereNull('finished_at')
        ->count();

    $completedAttempts = $user->quizAttempts()
        ->whereNotNull('finished_at')
        ->count();

    $quizzes = Quiz::where('target_role', $user->role)
        ->where('is_active', true)
        ->withCount('questions')
        ->get();

    return view('quiz.index', compact('quizzes', 'attempts', 'completedAttempts'));
}


    public function show(Quiz $quiz)
    {
        $user = auth()->user();
        $userAttempts = $user->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->whereNull('finished_at')
            ->count();

            
        
        if (!$quiz->canBeAccessedBy($user->role)) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini.');
        }

        $quiz->load('questions');

        return view('quiz.show', compact('quiz'));
    }

    public function start(Quiz $quiz)
    {
        $user = auth()->user();
        
        if (!$quiz->canBeAccessedBy($user->role)) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini.');
        }

        // Create quiz attempt
        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'total_questions' => $quiz->questions()->count(),
            'started_at' => now(),
        ]);

        return redirect()->route('quiz.take', ['quiz' => $quiz, 'attempt' => $attempt]);
    }

    public function take(Quiz $quiz, QuizAttempt $attempt)
    {
        $user = auth()->user();
        
        if ($attempt->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if ($attempt->finished_at) {
            return redirect()->route('quiz.result', ['quiz' => $quiz, 'attempt' => $attempt]);
        }

        $questions = $quiz->questions()->orderBy('order')->get();
        $userAnswers = $attempt->userAnswers()->pluck('user_answer', 'question_id')->toArray();

        return view('quiz.take', compact('quiz', 'attempt', 'questions', 'userAnswers'));
    }

    public function submit(Request $request, Quiz $quiz, QuizAttempt $attempt)
    {
        $user = auth()->user();
        
        if ($attempt->user_id !== $user->id || $attempt->finished_at) {
            abort(403, 'Unauthorized');
        }

        $questions = $quiz->questions()->get();
        $answers = $request->input('answers', []);
        $correctAnswers = 0;

        // Delete existing answers for this attempt
        $attempt->userAnswers()->delete();

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            $isCorrect = $userAnswer === $question->correct_answer;
            
            if ($userAnswer) {
                UserAnswer::create([
                    'quiz_attempt_id' => $attempt->id,
                    'question_id' => $question->id,
                    'user_answer' => $userAnswer,
                    'is_correct' => $isCorrect,
                ]);
            }

            if ($isCorrect) {
                $correctAnswers++;
            }
        }

        // Update attempt
        $attempt->update([
            'correct_answers' => $correctAnswers,
            'score' => ($correctAnswers / $questions->count()) * 100,
            'finished_at' => now(),
        ]);

        return redirect()->route('quiz.result', ['quiz' => $quiz, 'attempt' => $attempt]);
    }

    public function result(Quiz $quiz, QuizAttempt $attempt)
    {
        $user = auth()->user();
        
        if ($attempt->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $attempt->load([
            'userAnswers.question',
            'quiz'
        ]);

        return view('quiz.result', compact('quiz', 'attempt'));
    }

    public function history()
    {
        $user = auth()->user();
        $attempts = $user->quizAttempts()
            ->with('quiz')
            ->whereNotNull('finished_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('quiz.history', compact('attempts'));
    }
}