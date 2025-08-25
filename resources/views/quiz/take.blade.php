@extends('layouts.app')

@section('title', 'Mengerjakan Quiz: ' . $quiz->title)

@push('styles')
<style>
    .quiz-header {
        background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-blue-soft) 100%);
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        border: none;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.08);
    }

    .quiz-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 30%, var(--bnn-yellow) 50%, var(--bnn-blue-light) 70%, var(--bnn-blue-dark) 100%);
    }

    .quiz-header h2 {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.8rem;
    }

    .quiz-header h2 i {
        color: var(--bnn-blue-light);
        padding: 0.75rem;
        background: var(--bnn-white);
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.15);
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .quiz-header h2 i:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.2);
    }

    .quiz-header p {
        color: var(--bnn-gray-dark);
        font-size: 1.1rem;
        margin: 0;
        opacity: 0.8;
    }

    .timer {
        position: sticky;
        top: 80px;
        z-index: 100;
    }
    
    .timer-card, .nav-card {
        background: var(--bnn-white);
        border-radius: 20px;
        border: none;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.08);
        overflow: hidden;
        position: relative;
    }

    .timer-card::before, .nav-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%);
    }

    .timer-card .card-body {
        padding: 2rem;
        text-align: center;
    }

    .timer-card h6 {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .timer-card h6 i {
        color: var(--bnn-blue-light);
    }

    .timer-display {
        position: relative;
        display: inline-block;
    }

    .progress-ring {
        transform: rotate(-90deg);
    }

    #timer-text {
        color: var(--bnn-blue-light);
        font-weight: 700;
        margin-top: 0.5rem;
    }

    .nav-card .card-header {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, #bfdbfe 100%);
        border: none;
        padding: 1.5rem;
    }

    .nav-card .card-header h6 {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .nav-card .card-header i {
        color: var(--bnn-blue-light);
    }

    .nav-card .card-body {
        padding: 1.5rem;
    }

    .question-nav {
        max-height: 300px;
        overflow-y: auto;
    }

    .question-nav-btn {
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid var(--bnn-blue-soft);
    }

    .question-nav-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.15);
    }

    .question-nav-btn.btn-success {
        background: linear-gradient(135deg, var(--bnn-success) 0%, #059669 100%);
        border-color: transparent;
        color: var(--bnn-white);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .question-nav-btn.btn-outline-secondary {
        background: var(--bnn-white);
        color: var(--bnn-gray-dark);
        border-color: var(--bnn-blue-soft);
    }

    .question-nav-btn.active {
        background: linear-gradient(135deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%);
        border-color: transparent;
        color: var(--bnn-white);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
    }

    .question-card {
        background: var(--bnn-white);
        border-radius: 20px;
        border: none;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.08);
        overflow: hidden;
        position: relative;
        border-left: 5px solid var(--bnn-blue-soft);
        transition: all 0.3s ease;
    }

    .question-card.answered {
        border-left-color: var(--bnn-success);
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.1);
    }

    .question-card .card-header {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, #bfdbfe 100%);
        border: none;
        padding: 1.5rem 2rem;
    }

    .question-card .card-header h6 {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        margin: 0;
    }

    .question-card .card-body {
        padding: 2rem;
    }

    .question-card h5 {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 2rem;
        font-size: 1.3rem;
    }

    .form-check {
        margin-bottom: 1rem;
    }

    .form-check-input {
        display: none;
    }

    .form-check-label {
        cursor: pointer;
        width: 100%;
        margin: 0;
    }

    .option-container {
        padding: 1.25rem;
        border: 2px solid var(--bnn-blue-soft);
        border-radius: 16px;
        transition: all 0.3s ease;
        background: var(--bnn-white);
        position: relative;
        overflow: hidden;
    }

    .option-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.05), transparent);
        transition: left 0.5s;
    }

    .option-container:hover {
        border-color: var(--bnn-blue-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.15);
    }

    .option-container:hover::before {
        left: 100%;
    }

    .form-check-input:checked + .form-check-label .option-container {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%);
        border-color: var(--bnn-blue-light);
        color: var(--bnn-blue-dark);
        box-shadow: 0 6px 24px rgba(59, 130, 246, 0.2);
    }

    .question-card .card-footer {
        background: transparent;
        border: none;
        padding: 0 2rem 2rem;
    }

    .btn-secondary, .btn-primary, .btn-success {
        border-radius: 12px;
        padding: 0.875rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--bnn-gray-dark) 0%, #475569 100%);
        color: var(--bnn-white);
        box-shadow: 0 4px 16px rgba(71, 85, 105, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(71, 85, 105, 0.4);
        color: var(--bnn-white);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%);
        color: var(--bnn-white);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(59, 130, 246, 0.4);
        color: var(--bnn-white);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--bnn-success) 0%, #059669 100%);
        color: var(--bnn-white);
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(16, 185, 129, 0.4);
        color: var(--bnn-white);
    }

    .progress {
        background: var(--bnn-blue-soft);
        border-radius: 12px;
        height: 8px;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(90deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%);
        border-radius: 12px;
        transition: width 0.3s ease;
    }

    .tips-section {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, #bfdbfe 100%);
        border-radius: 20px;
        padding: 1.75rem;
        border: 1px solid rgba(59, 130, 246, 0.1);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.05);
    }

    .tips-icon {
        background: var(--bnn-blue-light);
        color: var(--bnn-white);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
        flex-shrink: 0;
    }

    .tips-section h6 {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .tips-section p {
        color: var(--bnn-blue-dark);
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .question-card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quiz-header {
            padding: 2rem;
        }

        .quiz-header h2 {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 0.75rem;
            text-align: center;
        }

        .quiz-header h2 i {
            font-size: 1.2rem;
            padding: 0.6rem;
        }

        .timer {
            position: static;
            margin-bottom: 1.5rem;
        }

        .timer-card .card-body, 
        .nav-card .card-body,
        .question-card .card-body {
            padding: 1.5rem;
        }

        .timer-card .card-header,
        .nav-card .card-header,
        .question-card .card-header {
            padding: 1.5rem;
        }

        .question-card .card-footer {
            padding: 0 1.5rem 1.5rem;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-secondary, .btn-primary, .btn-success {
            width: 100%;
        }

        .option-container {
            padding: 1rem;
        }

        .question-card h5 {
            font-size: 1.2rem;
        }

        .tips-section {
            padding: 1.5rem;
        }

        .tips-section .d-flex {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .tips-icon {
            margin: 0 auto;
        }
    }

    /* Timer warning states */
    .timer-warning .progress-ring circle:last-child {
        stroke: var(--bnn-yellow) !important;
    }

    .timer-warning #timer-text {
        color: var(--bnn-yellow) !important;
    }

    .timer-danger .progress-ring circle:last-child {
        stroke: var(--bnn-danger) !important;
    }

    .timer-danger #timer-text {
        color: var(--bnn-danger) !important;
    }
</style>
@endpush

@section('content')
<div class="quiz-header">
    <h2>
        <i class="fas fa-clipboard-question"></i>
        {{ $quiz->title }}
    </h2>
    <p>Kerjakan setiap soal dengan teliti dan kelola waktu Anda dengan baik</p>
</div>

<div class="row">
    <!-- Timer & Navigation -->
    <div class="col-md-3">
        <div class="timer">
            <div class="card timer-card mb-3">
                <div class="card-body">
                    <h6><i class="fas fa-clock"></i> Sisa Waktu</h6>
                    <div class="timer-display">
                        <svg width="80" height="80" class="progress-ring">
                            <circle cx="40" cy="40" r="30" stroke="var(--bnn-blue-soft)" stroke-width="4" fill="transparent"/>
                            <circle id="timer-circle" cx="40" cy="40" r="30" stroke="var(--bnn-blue-light)" 
                                    stroke-width="4" fill="transparent" stroke-dasharray="188.4" 
                                    stroke-dashoffset="0"/>
                        </svg>
                        <div class="mt-2">
                            <h4 id="timer-text">{{ $quiz->time_limit }}:00</h4>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card nav-card">
                <div class="card-header">
                    <h6><i class="fas fa-list"></i> Navigasi Soal</h6>
                </div>
                <div class="card-body question-nav">
                    <div class="row">
                        @foreach($questions as $index => $question)
                            <div class="col-4 mb-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100 question-nav-btn" 
                                        data-question="{{ $index + 1 }}"
                                        id="nav-btn-{{ $index + 1 }}">
                                    {{ $index + 1 }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quiz Content -->
    <div class="col-md-9">
        <form id="quiz-form" method="POST" action="{{ route('quiz.submit', [$quiz, $attempt]) }}">
            @csrf
            
            @foreach($questions as $index => $question)
                <div class="card mb-4 question-card" 
                     id="question-{{ $index + 1 }}" 
                     style="{{ $index === 0 ? '' : 'display: none;' }}">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Soal {{ $index + 1 }} dari {{ $questions->count() }}</h6>
                            <div class="progress" style="width: 120px; height: 8px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ (($index + 1) / $questions->count()) * 100 }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="mb-4">{{ $question->question }}</h5>
                        
                        <div class="options">
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" 
                                           name="answers[{{ $question->id }}]" 
                                           id="q{{ $question->id }}_{{ $option }}" 
                                           value="{{ $option }}"
                                           {{ (isset($userAnswers[$question->id]) && $userAnswers[$question->id] === $option) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q{{ $question->id }}_{{ $option }}">
                                        <div class="option-container">
                                            <strong>{{ strtoupper($option) }}.</strong> {{ $question->{'option_' . $option} }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-btn" 
                                    {{ $index === 0 ? 'style=visibility:hidden;' : '' }}>
                                <i class="fas fa-arrow-left"></i> Sebelumnya
                            </button>
                            
                            @if($index === $questions->count() - 1)
                                <button type="submit" class="btn btn-success" 
                                        onclick="return confirm('Yakin ingin submit quiz?')">
                                    <i class="fas fa-check"></i> Submit Quiz
                                </button>
                            @else
                                <button type="button" class="btn btn-primary next-btn">
                                    Selanjutnya <i class="fas fa-arrow-right"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
</div>

<!-- Tips Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="tips-section">
            <div class="d-flex align-items-center gap-3">
                <div class="tips-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div style="flex: 1;">
                    <h6>Tips Mengerjakan Quiz</h6>
                    <p>
                        Perhatikan sisa waktu di panel kiri, gunakan navigasi soal untuk melompat ke soal tertentu, dan pastikan semua soal terjawab sebelum submit.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentQuestion = 1;
    const totalQuestions = {{ $questions->count() }};
    const timeLimit = {{ $quiz->time_limit }} * 60; // Convert to seconds
    let timeRemaining = timeLimit;
    
    // Timer functionality
    const timerText = document.getElementById('timer-text');
    const timerCircle = document.getElementById('timer-circle');
    const timerCard = document.querySelector('.timer-card');
    const circumference = 2 * Math.PI * 30;
    timerCircle.style.strokeDasharray = circumference;
    
    function updateTimer() {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerText.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        const progress = (timeLimit - timeRemaining) / timeLimit;
        const offset = circumference * progress;
        timerCircle.style.strokeDashoffset = offset;
        
        // Remove previous warning classes
        timerCard.classList.remove('timer-warning', 'timer-danger');
        
        if (timeRemaining <= 300) { // 5 minutes warning
            timerCard.classList.add('timer-warning');
        }
        if (timeRemaining <= 60) { // 1 minute warning
            timerCard.classList.remove('timer-warning');
            timerCard.classList.add('timer-danger');
        }
        
        if (timeRemaining <= 0) {
            alert('Waktu habis! Quiz akan otomatis disubmit.');
            document.getElementById('quiz-form').submit();
            return;
        }
        
        timeRemaining--;
        setTimeout(updateTimer, 1000);
    }
    
    updateTimer();
    
    // Question navigation
    function showQuestion(questionNumber) {
        // Hide all questions
        for (let i = 1; i <= totalQuestions; i++) {
            document.getElementById(`question-${i}`).style.display = 'none';
        }
        
        // Show current question
        document.getElementById(`question-${questionNumber}`).style.display = 'block';
        currentQuestion = questionNumber;
        
        // Update navigation buttons
        updateNavButtons();
    }
    
    function updateNavButtons() {
        // Update question navigation status
        for (let i = 1; i <= totalQuestions; i++) {
            const navBtn = document.getElementById(`nav-btn-${i}`);
            const questionCard = document.getElementById(`question-${i}`);
            
            // Check if question is answered
            const radios = questionCard.querySelectorAll('input[type="radio"]');
            let isAnswered = false;
            radios.forEach(radio => {
                if (radio.checked) isAnswered = true;
            });
            
            // Reset classes
            navBtn.className = 'btn btn-sm w-100 question-nav-btn';
            
            if (isAnswered) {
                navBtn.classList.add('btn-success');
                questionCard.classList.add('answered');
            } else {
                navBtn.classList.add('btn-outline-secondary');
                questionCard.classList.remove('answered');
            }
            
            if (i === currentQuestion) {
                navBtn.classList.add('active');
            }
        }
    }
    
    // Navigation button clicks
    document.querySelectorAll('.question-nav-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const questionNumber = parseInt(this.dataset.question);
            showQuestion(questionNumber);
        });
    });
    
    // Previous/Next buttons
    document.querySelectorAll('.prev-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentQuestion > 1) {
                showQuestion(currentQuestion - 1);
            }
        });
    });
    
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentQuestion < totalQuestions) {
                showQuestion(currentQuestion + 1);
            }
        });
    });
    
    // Update nav when radio buttons are clicked
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateNavButtons);
    });
    
    // Initial nav button update
    updateNavButtons();
    
    // Warn before leaving page
    window.addEventListener('beforeunload', function(e) {
        e.preventDefault();
        e.returnValue = '';
        return 'Quiz sedang berlangsung. Yakin ingin meninggalkan halaman?';
    });
    
    // Remove warning when form is submitted
    document.getElementById('quiz-form').addEventListener('submit', function() {
        window.removeEventListener('beforeunload', function() {});
    });
});
</script>
@endpush