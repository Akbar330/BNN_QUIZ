<!-- resources/views/quiz/show.blade.php -->
@extends('layouts.app')

@section('title', $quiz->title)

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

    .quiz-hero {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        color: white;
        border-radius: 20px;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
    }

    .quiz-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-gold) 0%, white 50%, var(--bnn-accent) 100%);
    }

    .quiz-hero h1 {
        font-weight: 800;
        margin-bottom: 1rem;
        font-size: 2.5rem;
    }

    .quiz-hero .lead {
        font-size: 1.2rem;
        opacity: 0.95;
        font-weight: 400;
    }

    .quiz-difficulty {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    }
    
    .info-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-accent) 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.15);
    }

    .info-card:hover::before {
        transform: scaleX(1);
    }

    .info-card .card-body {
        padding: 2rem;
        text-align: center;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        position: relative;
    }

    .icon-wrapper.bg-primary {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
    }

    .icon-wrapper.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .icon-wrapper.bg-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .icon-wrapper.bg-success {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, #10b981 100%);
    }

    .info-card h3 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .info-card p {
        color: #64748b;
        font-weight: 500;
        font-size: 0.9rem;
        margin: 0;
    }

    .rules-card, .preview-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .rules-card::before, .preview-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-accent) 100%);
    }

    .rules-card .card-header, .preview-card .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        padding: 1.5rem 2rem;
    }

    .rules-card .card-header h5, .preview-card .card-header h5 {
        color: var(--bnn-dark);
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .rules-card .card-header i, .preview-card .card-header i {
        color: var(--bnn-primary);
    }

    .rules-card .card-body, .preview-card .card-body {
        padding: 2rem;
    }
    
    .quiz-rules {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-left: 4px solid var(--bnn-primary);
        padding: 1.5rem;
        border-radius: 0 15px 15px 0;
        margin-bottom: 1.5rem;
    }

    .quiz-rules h6 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quiz-rules h6 i {
        color: var(--bnn-primary);
    }

    .quiz-rules ul li {
        color: #64748b;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }

    .quiz-rules ul li i {
        color: var(--bnn-accent);
        flex-shrink: 0;
    }

    .alert-modern {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border: 1px solid #f59e0b;
        border-radius: 15px;
        padding: 1.25rem;
        margin-top: 1rem;
    }

    .alert-modern i {
        color: #d97706;
    }

    .alert-modern strong {
        color: #92400e;
    }

    .quiz-preview {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .sample-question {
        border-left: 4px solid var(--bnn-primary);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 1.5rem;
        border-radius: 0 15px 15px 0;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .sample-question:hover {
        transform: translateX(4px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.1);
    }

    .sample-question h6 {
        color: var(--bnn-primary);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sample-question p {
        color: var(--bnn-dark);
        font-weight: 500;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .sample-question small {
        color: #64748b;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }

    .history-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        overflow: hidden;
        position: relative;
        margin-bottom: 2rem;
    }

    .history-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-accent) 100%);
    }

    .history-card .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        padding: 1.5rem 2rem;
    }

    .history-card .card-header h5 {
        color: var(--bnn-dark);
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .history-card .card-header i {
        color: var(--bnn-primary);
    }

    .table {
        margin: 0;
    }

    .table th {
        background: #f8fafc;
        color: var(--bnn-dark);
        font-weight: 600;
        border: none;
        padding: 1rem;
    }

    .table td {
        padding: 1rem;
        border-color: #f1f5f9;
        vertical-align: middle;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 15px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .start-quiz-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        overflow: hidden;
        position: relative;
    }

    .start-quiz-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-accent) 100%);
    }

    .start-quiz-card .card-body {
        padding: 3rem 2rem;
        text-align: center;
    }

    .start-quiz-card h4 {
        color: var(--bnn-dark);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .start-quiz-card p {
        color: #64748b;
        font-size: 1rem;
        line-height: 1.6;
    }
    
    .start-button {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, #10b981 100%);
        border: none;
        border-radius: 15px;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .start-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .start-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(5, 150, 105, 0.4);
        color: white;
    }

    .start-button:hover::before {
        left: 100%;
    }

    .alert-info-modern {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border: 1px solid #60a5fa;
        border-radius: 15px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        color: #1e40af;
    }

    .alert-info-modern i {
        color: #2563eb;
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

    .btn-outline-modern.btn-outline-primary:hover {
        background: var(--bnn-primary);
        color: white;
    }

    .btn-outline-modern.btn-outline-info:hover {
        background: #06b6d4;
        color: white;
        border-color: #06b6d4;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        border: 2px dashed #e2e8f0;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .empty-state-icon i {
        font-size: 2rem;
        color: #d97706;
    }

    .empty-state h5 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .hero-icon-wrapper {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        border: 3px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    }

    .hero-icon-wrapper i {
        font-size: 2.5rem;
        color: white;
    }

    .target-role-badge {
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        border: 2px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
        display: inline-block;
        margin-top: 1rem;
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

    .info-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .info-card:nth-child(1) { animation-delay: 0.1s; }
    .info-card:nth-child(2) { animation-delay: 0.2s; }
    .info-card:nth-child(3) { animation-delay: 0.3s; }
    .info-card:nth-child(4) { animation-delay: 0.4s; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quiz-hero {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .quiz-hero h1 {
            font-size: 2rem;
        }

        .quiz-hero .lead {
            font-size: 1rem;
        }

        .info-card .card-body {
            padding: 1.5rem;
        }

        .rules-card .card-body,
        .preview-card .card-body {
            padding: 1.5rem;
        }

        .rules-card .card-header,
        .preview-card .card-header {
            padding: 1.5rem;
        }

        .start-quiz-card .card-body {
            padding: 2rem 1.5rem;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-modern, .btn-outline-modern {
            width: 100%;
            justify-content: center;
        }

        .hero-icon-wrapper {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
        }

        .hero-icon-wrapper i {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Quiz Hero Section -->
    <div class="quiz-hero position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1>{{ $quiz->title }}</h1>
                <p class="lead">{{ $quiz->description ?: 'Uji pengetahuan Anda tentang bahaya narkoba dengan quiz ini!' }}</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="hero-icon-wrapper">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="target-role-badge">
                    <i class="fas fa-users"></i> {{ ucfirst($quiz->target_role) }}
                </div>
            </div>
        </div>
        
        @if(isset($quiz->difficulty))
        <div class="quiz-difficulty">
            {{ ucfirst($quiz->difficulty) }}
        </div>
        @endif
    </div>

    <!-- Quiz Information Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card info-card">
                <div class="card-body">
                    <div class="icon-wrapper bg-primary text-white">
                        <i class="fas fa-question-circle fa-lg"></i>
                    </div>
                    <h3 style="color: var(--bnn-primary);">{{ $quiz->questions->count() }}</h3>
                    <p>Total Soal</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card info-card">
                <div class="card-body">
                    <div class="icon-wrapper bg-warning text-white">
                        <i class="fas fa-clock fa-lg"></i>
                    </div>
                    <h3 style="color: #d97706;">{{ $quiz->time_limit }}</h3>
                    <p>Menit</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card info-card">
                <div class="card-body">
                    <div class="icon-wrapper bg-info text-white">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <h3 style="color: #0891b2;">{{ $quiz->attempts->count() }}</h3>
                    <p>Peserta</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card info-card">
                <div class="card-body">
                    <div class="icon-wrapper bg-success text-white">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                    <h3 style="color: var(--bnn-accent);">
                        {{ $quiz->attempts->count() > 0 ? number_format($quiz->attempts->avg('score'), 0) : '0' }}%
                    </h3>
                    <p>Rata-rata Skor</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quiz Rules and Instructions -->
        <div class="col-md-6 mb-4">
            <div class="card rules-card">
                <div class="card-header">
                    <h5>
                        <i class="fas fa-info-circle"></i>Petunjuk Pengerjaan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="quiz-rules">
                        <h6>
                            <i class="fas fa-clipboard-list"></i>
                            Aturan Quiz:
                        </h6>
                        <ul class="list-unstyled">
                            <li>
                                <i class="fas fa-wifi"></i>
                                Pastikan koneksi internet Anda stabil
                            </li>
                            <li>
                                <i class="fas fa-stopwatch"></i>
                                Quiz harus diselesaikan dalam waktu <strong>{{ $quiz->time_limit }} menit</strong>
                            </li>
                            <li>
                                <i class="fas fa-list-ol"></i>
                                Setiap soal memiliki 4 pilihan jawaban (A, B, C, D)
                            </li>
                            <li>
                                <i class="fas fa-mouse-pointer"></i>
                                Anda dapat menavigasi antar soal sebelum submit
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                Quiz akan otomatis ter-submit jika waktu habis
                            </li>
                            <li>
                                <i class="fas fa-chart-bar"></i>
                                Hasil dan penjelasan akan ditampilkan setelah submit
                            </li>
                        </ul>
                    </div>
                    
                    <div class="alert-modern" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Perhatian:</strong> Setelah memulai quiz, jangan refresh atau tutup browser sampai selesai mengerjakan.
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Preview / Sample Questions -->
        <div class="col-md-6 mb-4">
            <div class="card preview-card">
                <div class="card-header">
                    <h5>
                        <i class="fas fa-eye"></i>Preview Soal
                    </h5>
                </div>
                <div class="card-body quiz-preview">
                    @if($quiz->questions->count() > 0)
                        @foreach($quiz->questions->take(3) as $index => $question)
                            <div class="sample-question">
                                <h6>
                                    <i class="fas fa-question-circle"></i>
                                    Contoh Soal {{ $index + 1 }}:
                                </h6>
                                <p>{{ Str::limit($question->question, 100) }}</p>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <small>
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            A. {{ Str::limit($question->option_a, 30) }}
                                        </small>
                                    </div>
                                    <div class="col-6">
                                        <small>
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            B. {{ Str::limit($question->option_b, 30) }}
                                        </small>
                                    </div>
                                    <div class="col-6">
                                        <small>
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            C. {{ Str::limit($question->option_c, 30) }}
                                        </small>
                                    </div>
                                    <div class="col-6">
                                        <small>
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            D. {{ Str::limit($question->option_d, 30) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($quiz->questions->count() > 3)
                            <div class="text-center mt-3">
                                <small style="color: #64748b;">
                                    <i class="fas fa-ellipsis-h me-1"></i>
                                    Dan {{ $quiz->questions->count() - 3 }} soal lainnya
                                </small>
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <p>Belum ada soal untuk quiz ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User's Quiz History for this Quiz -->
    @php
        $userAttempts = auth()->user()->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->whereNotNull('finished_at')
            ->latest()
            ->take(3)
            ->get();
    @endphp
    
    @if($userAttempts->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card history-card">
                <div class="card-header">
                    <h5>
                        <i class="fas fa-history"></i>Riwayat Quiz Anda
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Skor</th>
                                    <th>Benar/Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userAttempts as $attempt)
                                <tr>
                                    <td style="color: var(--bnn-dark); font-weight: 500;">{{ $attempt->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge" style="background: var(--bnn-primary); color: white;">{{ number_format($attempt->score, 0) }}%</span>
                                    </td>
                                    <td style="color: var(--bnn-dark); font-weight: 500;">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</td>
                                    <td>
                                        @php
                                            $gradeClass = $attempt->score >= 80 ? 'var(--bnn-accent)' : 
                                                         ($attempt->score >= 70 ? '#06b6d4' : 
                                                         ($attempt->score >= 60 ? '#f59e0b' : '#ef4444'));
                                            $gradeText = $attempt->score >= 80 ? 'Sangat Baik' : 
                                                        ($attempt->score >= 70 ? 'Baik' : 
                                                        ($attempt->score >= 60 ? 'Cukup' : 'Perlu Belajar Lagi'));
                                        @endphp
                                        <span class="badge" style="background: {{ $gradeClass }}; color: white;">
                                            {{ $gradeText }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('quiz.result', [$quiz, $attempt]) }}" 
                                           class="btn btn-sm btn-outline-modern">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(auth()->user()->quizAttempts()->where('quiz_id', $quiz->id)->count() > 3)
                        <div class="text-center mt-3">
                            <a href="{{ route('quiz.history') }}" class="btn btn-outline-modern">
                                <i class="fas fa-history"></i> Lihat Semua Riwayat
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Start Quiz Section -->
    <div class="row">
        <div class="col-12">
            <div class="card start-quiz-card">
                <div class="card-body">
                    @if($quiz->questions->count() > 0)
                        <div style="background: var(--bnn-primary); color: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                            <i class="fas fa-rocket" style="font-size: 2rem;"></i>
                        </div>
                        <h4>Siap untuk memulai quiz?</h4>
                        <p>
                            Pastikan Anda telah membaca semua petunjuk di atas. 
                            Klik tombol di bawah untuk memulai quiz.
                        </p>
                        
                        <!-- Warning for users who already took the quiz -->
                        @if($userAttempts->count() > 0)
                            <div class="alert-info-modern">
                                <i class="fas fa-info-circle me-2"></i>
                                Anda sudah pernah mengerjakan quiz ini <strong>{{ $userAttempts->count() }} kali</strong>. 
                                Skor tertinggi: <strong>{{ $userAttempts->max('score') }}%</strong>
                            </div>
                        @endif

                        @if($quiz->passing_score)
                            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid var(--bnn-accent); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                                <i class="fas fa-target" style="color: var(--bnn-accent); margin-right: 0.5rem;"></i>
                                <strong style="color: var(--bnn-dark);">Target:</strong> 
                                <span style="color: #15803d;">Skor minimal {{ $quiz->passing_score }}% untuk lulus</span>
                            </div>
                        @endif
                        
                        <form action="{{ route('quiz.start', $quiz) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="start-button" 
                                    onclick="return confirm('Yakin ingin memulai quiz? Pastikan Anda sudah siap!')">
                                <i class="fas fa-play me-2"></i>Mulai Quiz Sekarang
                            </button>
                        </form>
                        
                        <div style="margin-top: 1.5rem;">
                            <small style="color: #64748b; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                <i class="fas fa-clock"></i>
                                Waktu pengerjaan: {{ $quiz->time_limit }} menit
                            </small>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h5>Quiz Belum Tersedia</h5>
                            <p>Maaf, quiz ini belum memiliki soal. Silakan hubungi admin atau coba lagi nanti.</p>
                            
                            <a href="{{ route('quiz.index') }}" class="btn btn-modern">
                                <i class="fas fa-arrow-left"></i>Kembali ke Daftar Quiz
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('quiz.index') }}" class="btn btn-outline-modern">
                    <i class="fas fa-arrow-left"></i>Kembali ke Daftar Quiz
                </a>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('quiz.history') }}" class="btn btn-outline-modern btn-outline-primary">
                        <i class="fas fa-history"></i>Riwayat Quiz
                    </a>
                    
                    @if($userAttempts->count() > 0)
                        <a href="{{ route('quiz.result', [$quiz, $userAttempts->first()]) }}" 
                           class="btn btn-outline-modern btn-outline-info">
                            <i class="fas fa-chart-bar"></i>Hasil Terakhir
                        </a>
                    @endif
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
                        <h6 style="color: var(--bnn-dark); font-weight: 600; margin-bottom: 0.5rem;">Tips Sukses Quiz</h6>
                        <p style="color: #0369a1; margin: 0; font-size: 0.9rem;">
                            Baca setiap soal dengan cermat, jangan terburu-buru, dan gunakan pengetahuan Anda tentang bahaya narkoba untuk menjawab setiap pertanyaan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling for any anchor links
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add hover effects to info cards
    const infoCards = document.querySelectorAll('.info-card');
    infoCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Enhanced confirmation before starting quiz
    const startForm = document.querySelector('form[action*="start"]');
    if (startForm) {
        startForm.addEventListener('submit', function(e) {
            const confirmation = confirm(
                'Yakin ingin memulai quiz?\n\n' +
                '• Quiz harus diselesaikan dalam {{ $quiz->time_limit }} menit\n' +
                '• Jangan refresh atau tutup browser saat mengerjakan\n' +
                '• Pastikan koneksi internet stabil\n' +
                @if($quiz->passing_score)
                '• Target skor minimal: {{ $quiz->passing_score }}%\n' +
                @endif
                '\nKlik OK untuk melanjutkan.'
            );
            
            if (!confirmation) {
                e.preventDefault();
            }
        });
    }

    // Add loading state to start button
    const startButton = document.querySelector('.start-button');
    if (startButton) {
        startButton.addEventListener('click', function() {
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memulai Quiz...';
                this.disabled = true;
            }, 100);
        });
    }
});
</script>
@endpush