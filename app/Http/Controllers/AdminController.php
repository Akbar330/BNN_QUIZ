<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAttempt;

class AdminController extends Controller
{
    public function index ()
    {
        $attempts = QuizAttempt::with(['quiz', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.results.index', compact('attempts'));
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }
    

    public function dashboard()
    {
        $quizzes = Quiz::withCount(['questions', 'attempts'])->get();
        $totalAttempts = QuizAttempt::count();
        
        return view('admin.dashboard', compact('quizzes', 'totalAttempts'));
    }

    public function result()
    {
        $attempts = QuizAttempt::with(['quiz', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.results.index', compact('attempts'));
    }

    public function show()
    {
        $attempts = QuizAttempt::with(['quiz', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.results.show', compact('attempts'));
    }

    public function quizzes()
    {
        $quizzes = Quiz::withCount('questions')->paginate(10);
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function createQuiz()
    {
        return view('admin.quizzes.create');
    }

    public function storeQuiz(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_role' => 'required|in:masyarakat,pelajar',
            'time_limit' => 'required|integer|min:5|max:180',
        ]);

        $quiz = Quiz::create($validated);

        return redirect()->route('admin.quiz.questions', $quiz)->with('success', 'Quiz berhasil dibuat!');
    }

    public function showQuiz(Quiz $quiz)
    {
        $quiz->load(['questions', 'attempts.user']);
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function editQuiz(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function updateQuiz(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_role' => 'required|in:masyarakat,pelajar',
            'time_limit' => 'required|integer|min:5|max:180',
            'is_active' => 'boolean',
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.quizzes')->with('success', 'Quiz berhasil diupdate!');
    }

    public function destroyQuiz(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes')->with('success', 'Quiz berhasil dihapus!');
    }

    public function quizQuestions(Quiz $quiz)
    {
        $questions = $quiz->questions()->orderBy('order')->get();
        return view('admin.questions.index', compact('quiz', 'questions'));
    }

    public function createQuestion(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
            'explanation' => 'required|string',
        ]);

        $validated['quiz_id'] = $quiz->id;
        $validated['order'] = $quiz->questions()->max('order') + 1;

        Question::create($validated);

        return redirect()->route('admin.quiz.questions', $quiz)->with('success', 'Soal berhasil ditambahkan!');
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        return view('admin.questions.edit', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
            'explanation' => 'required|string',
        ]);

        $question->update($validated);

        return redirect()->route('admin.quiz.questions', $quiz)->with('success', 'Soal berhasil diupdate!');
    }

    public function destroyQuestion(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->route('admin.quiz.questions', $quiz)->with('success', 'Soal berhasil dihapus!');
    }

    public function quizResults(Quiz $quiz)
    {
        $attempts = QuizAttempt::with('user')
            ->where('quiz_id', $quiz->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.results', compact('quiz', 'attempts'));
    }
}