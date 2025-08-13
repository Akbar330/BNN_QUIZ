<!-- resources/views/quiz/result.blade.php -->
@extends('layouts.app')

@section('title', 'Hasil Quiz: ' . $quiz->title)

@push('styles')
<style>
    .quiz-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .quiz-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-gold) 50%, var(--bnn-accent) 100%);
    }

    .quiz-header h2 {
        color: var(--bnn-dark);
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .quiz-header h2 i {
        color: var(--bnn-primary);
        padding: 0.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.1);
    }

    .quiz-header p {
        color: #64748b;
        font-size: 1.1rem;
        margin: 0;
    }

    .result-card {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .result-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-gold) 0%, white 50%, var(--bnn-accent) 100%);
    }

    .result-card .card-body {
        padding: 3rem 2rem;
    }

    .score-circle {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        border: 3px solid rgba(255,255,255,0.3);
        position: relative;
        backdrop-filter: blur(10px);
    }

    .score-circle::before {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 50%;
        background: linear-gradient(45deg, var(--bnn-gold), white, var(--bnn-accent));
        z-index: -1;
    }

    .score-stats {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 1.5rem;
        margin-top: 2rem;
        backdrop-filter: blur(10px);
    }

    .score-stats .col-4 {
        border-right: 1px solid rgba(255,255,255,0.2);
    }

    .score-stats .col-4:last-child {
        border-right: none;
    }

    .grade-badge {
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 1.5rem;
        display: inline-block;
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    }

    .explanation-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        overflow: hidden;
        position: relative;
        margin-bottom: 2rem;
        border-left: 4px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .explanation-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.15);
    }

    .explanation-card.correct {
        border-left-color: var(--bnn-accent);
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    }

    .explanation-card.incorrect {
        border-left-color: #ef4444;
        background: linear-gradient(135deg, #fef2f2 0%, #fefefe 100%);
    }

    .explanation-card .card-header {
        background: transparent;
        border: none;
        padding: 1.5rem 2rem 0;
    }

    .explanation-card .card-body {
        padding: 0 2rem 2rem;
    }

    .explanation-card h6 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
    }

    .option-review {
        padding: 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        background: white;
    }

    .option-review.correct-answer {
        border-color: var(--bnn-accent);
        background: linear-gradient(135deg, rgba(5, 150, 105, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    }

    .option-review.user-wrong {
        border-color: #ef4444;
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(248, 113, 113, 0.05) 100%);
    }

    .option-review i {
        font-size: 1.1rem;
    }

    .explanation-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        margin-top: 1rem;
    }

    .explanation-section h6 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .explanation-section h6 i {
        color: var(--bnn-primary);
    }

    .answer-summary {
        background: rgba(255,255,255,0.7);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .btn-modern {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.875rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-outline-modern {
        background: white;
        border: 2px solid #e2e8f0;
        color: #64748b;
        border-radius: 12px;
        padding: 0.875rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-outline-modern:hover {
        border-color: var(--bnn-primary);
        color: var(--bnn-primary);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.1);
        text-decoration: none;
    }

    .final-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        overflow: hidden;
        position: relative;
    }

    .final-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-accent) 100%);
    }

    .final-card .card-body {
        padding: 2rem;
        text-align: center;
    }

    .final-card h5 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .final-card p {
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .result-card {
        animation: bounceIn 0.8s ease-out;
    }

    .explanation-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .explanation-card:nth-child(odd) { animation-delay: 0.1s; }
    .explanation-card:nth-child(even) { animation-delay: 0.2s; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quiz-header {
            padding: 1.5rem;
        }

        .quiz-header h2 {
            font-size: 1.3rem;
            flex-direction: column;
            gap: 0.5rem;
            text-align: center;
        }

        .result-card .card-body {
            padding: 2rem 1.5rem;
        }

        .score-circle {
            width: 120px;
            height: 120px;
        }

        .score-stats {
            margin-top: 1.5rem;
        }

        .explanation-card .card-header,
        .explanation-card .card-body {
            padding: 1.5rem;
        }

        .explanation-card .card-body {
            padding-top: 0;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-modern, .btn-outline-modern {
            width: 100%;
            justify-content: center;
        }

        .explanation-section {
            padding: 1.25rem;
        }

        .option-review {
            padding: 0.875rem;
        }

        .final-card .card-body {
            padding: 1.5rem;
        }
    }

    @media print {
        .quiz-header, .btn-modern, .btn-outline-modern, button {
            display: none !important;
        }
        
        .explanation-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>
@endpush

@section('content')
<div class="quiz-header">
    <h2>
        <i class="fas fa-chart-line"></i>
        Hasil Quiz: {{ $quiz->title }}
    </h2>
    <p>Berikut adalah hasil quiz Anda beserta review jawaban dan penjelasan</p>
</div>

<div class="row mb-4">
    <div class="col-md-8 mx-auto">
        <div class="card result-card text-center">
            <div class="card-body">
                <h2 class="mb-4" style="font-weight: 700;">Skor Anda</h2>
                
                <div class="score-circle mb-4">
                    <div>
                        <h1 class="mb-0" style="font-size: 3rem; font-weight: 800;">{{ number_format($attempt->score, 0) }}</h1>
                        <small style="font-size: 1rem; opacity: 0.9;">dari 100</small>
                    </div>
                </div>
                
                <div class="score-stats">
                    <div class="row text-center">
                        <div class="col-4">
                            <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ $attempt->correct_answers }}</h3>
                            <small style="font-size: 0.9rem; opacity: 0.9;">Jawaban Benar</small>
                        </div>
                        <div class="col-4">
                            <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ $attempt->total_questions - $attempt->correct_answers }}</h3>
                            <small style="font-size: 0.9rem; opacity: 0.9;">Jawaban Salah</small>
                        </div>
                        <div class="col-4">
                            <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ $attempt->total_questions }}</h3>
                            <small style="font-size: 0.9rem; opacity: 0.9;">Total Soal</small>
                        </div>
                    </div>
                </div>
                
                @php
                    $grade = '';
                    $gradeIcon = '';
                    if ($attempt->score >= 80) {
                        $grade = 'Sangat Baik';
                        $gradeIcon = 'fas fa-trophy';
                    } elseif ($attempt->score >= 70) {
                        $grade = 'Baik';
                        $gradeIcon = 'fas fa-medal';
                    } elseif ($attempt->score >= 60) {
                        $grade = 'Cukup';
                        $gradeIcon = 'fas fa-thumbs-up';
                    } else {
                        $grade = 'Perlu Belajar Lagi';
                        $gradeIcon = 'fas fa-book';
                    }
                @endphp
                
                <div class="grade-badge">
                    <i class="{{ $gradeIcon }}"></i> {{ $grade }}
                </div>

                @if($quiz->passing_score && $attempt->score >= $quiz->passing_score)
                    <div class="answer-summary">
                        <i class="fas fa-check-circle" style="color: var(--bnn-accent); margin-right: 0.5rem;"></i>
                        <strong>Selamat! Anda telah lulus quiz ini</strong>
                    </div>
                @elseif($quiz->passing_score && $attempt->score < $quiz->passing_score)
                    <div class="answer-summary">
                        <i class="fas fa-info-circle" style="color: #fbbf24; margin-right: 0.5rem;"></i>
                        <strong>Skor minimum untuk lulus: {{ $quiz->passing_score }}%</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 style="color: var(--bnn-dark); font-weight: 700;">
                <i class="fas fa-clipboard-list" style="color: var(--bnn-primary);"></i> 
                Review Jawaban & Penjelasan
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ route('quiz.index') }}" class="btn btn-modern">
                    <i class="fas fa-play"></i> Quiz Lainnya
                </a>
                <a href="{{ route('quiz.history') }}" class="btn btn-outline-modern">
                    <i class="fas fa-history"></i> Riwayat
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @foreach($attempt->userAnswers as $index => $userAnswer)
            @php
                $question = $userAnswer->question;
                $isCorrect = $userAnswer->is_correct;
            @endphp
            
            <div class="card explanation-card {{ $isCorrect ? 'correct' : 'incorrect' }}">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-{{ $isCorrect ? 'check-circle' : 'times-circle' }}" 
                               style="color: {{ $isCorrect ? 'var(--bnn-accent)' : '#ef4444' }}; margin-right: 0.5rem;"></i>
                            Soal {{ $index + 1 }}
                        </h6>
                        <span class="badge" style="
                            background: {{ $isCorrect ? 'var(--bnn-accent)' : '#ef4444' }};
                            color: white;
                            padding: 0.5rem 1rem;
                            border-radius: 15px;
                            font-weight: 600;
                        ">
                            {{ $isCorrect ? 'Benar' : 'Salah' }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <h6 class="mb-3">{{ $question->question }}</h6>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 style="color: var(--bnn-dark); font-weight: 600; margin-bottom: 1rem;">
                                <i class="fas fa-list-ul" style="color: var(--bnn-primary);"></i> 
                                Pilihan Jawaban:
                            </h6>
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                                @php
                                    $isUserAnswer = $userAnswer->user_answer === $option;
                                    $isCorrectAnswer = $question->correct_answer === $option;
                                    $optionClass = '';
                                    if ($isCorrectAnswer) {
                                        $optionClass = 'correct-answer';
                                    } elseif ($isUserAnswer && !$isCorrectAnswer) {
                                        $optionClass = 'user-wrong';
                                    }
                                @endphp
                                
                                <div class="option-review {{ $optionClass }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ strtoupper($option) }}.</strong> {{ $question->{'option_' . $option} }}
                                        </div>
                                        <div>
                                            @if($isUserAnswer && !$isCorrectAnswer)
                                                <i class="fas fa-times" style="color: #ef4444;"></i>
                                            @elseif($isCorrectAnswer)
                                                <i class="fas fa-check" style="color: var(--bnn-accent);"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="col-md-6">
                            <div class="explanation-section">
                                <h6>
                                    <i class="fas fa-info-circle"></i>
                                    Penjelasan:
                                </h6>
                                <p style="color: #64748b; margin: 0; line-height: 1.6;">{{ $question->explanation }}</p>
                            </div>
                            
                            @if(!$isCorrect)
                                <div class="answer-summary">
                                    <div style="font-size: 0.9rem; color: #64748b;">
                                        <div style="margin-bottom: 0.5rem;">
                                            <strong style="color: #ef4444;">
                                                <i class="fas fa-times-circle"></i> Jawaban Anda:
                                            </strong> 
                                            {{ strtoupper($userAnswer->user_answer) }}. {{ $question->{'option_' . $userAnswer->user_answer} }}
                                        </div>
                                        <div>
                                            <strong style="color: var(--bnn-accent);">
                                                <i class="fas fa-check-circle"></i> Jawaban Benar:
                                            </strong> 
                                            {{ strtoupper($question->correct_answer) }}. {{ $question->{'option_' . $question->correct_answer} }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card final-card">
            <div class="card-body">
                <div style="background: var(--bnn-primary); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-graduation-cap" style="font-size: 1.5rem;"></i>
                </div>
                <h5>Terima kasih telah mengikuti quiz!</h5>
                <p>Quiz diselesaikan pada: <strong>{{ $attempt->finished_at->format('d/m/Y H:i') }}</strong></p>
                <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 2rem;">
                    Terus tingkatkan pengetahuan Anda tentang bahaya narkoba dengan mengikuti quiz lainnya.
                </p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('quiz.index') }}" class="btn btn-modern">
                        <i class="fas fa-play"></i> Quiz Lainnya
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-modern">
                        <i class="fas fa-print"></i> Cetak Hasil
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tips Section -->
<div class="row mt-4">
    <div class="col-12">
        <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius: 15px; padding: 1.5rem; border: 1px solid #bae6fd;">
            <div class="d-flex align-items-center gap-1rem">
                <div style="background: var(--bnn-primary); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div style="flex: 1; margin-left: 1rem;">
                    <h6 style="color: var(--bnn-dark); font-weight: 600; margin-bottom: 0.5rem;">Saran untuk Pembelajaran</h6>
                    <p style="color: #0369a1; margin: 0; font-size: 0.9rem;">
                        {{ $attempt->score >= 80 ? 'Hasil yang sangat baik! Pertahankan pengetahuan Anda dan bantu orang lain untuk memahami bahaya narkoba.' : 'Pelajari kembali materi yang belum dikuasai dan coba quiz lainnya untuk meningkatkan pemahaman Anda.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection