@extends('layouts.app')

@section('title', 'Daftar Quiz')

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

    .role-badge {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        margin-left: 0.5rem;
    }

    .btn-history {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-history:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
        color: white;
        text-decoration: none;
    }

    .quiz-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .quiz-card::before {
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

    .quiz-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.15);
    }

    .quiz-card:hover::before {
        transform: scaleX(1);
    }

    .quiz-card-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        height: calc(100% - 80px);
    }

    .quiz-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--bnn-dark);
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .quiz-description {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .quiz-info-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .quiz-info {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .quiz-info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--bnn-dark);
    }

    .quiz-info-item i {
        color: var(--bnn-primary);
        width: 16px;
        text-align: center;
    }

    .quiz-difficulty {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .difficulty-easy {
        background: #dcfce7;
        color: #15803d;
    }

    .difficulty-medium {
        background: #fef3c7;
        color: #d97706;
    }

    .difficulty-hard {
        background: #fecaca;
        color: #dc2626;
    }

    .quiz-card-footer {
        background: transparent;
        border: none;
        padding: 0 2rem 2rem;
    }

    .btn-start-quiz {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.875rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn-start-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
        color: white;
    }

    .btn-start-quiz::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-start-quiz:hover::before {
        left: 100%;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        border: 2px dashed #e2e8f0;
        margin: 2rem 0;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .empty-state-icon i {
        font-size: 2rem;
        color: #64748b;
    }

    .empty-state h5 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1rem;
        margin: 0;
    }

    .quiz-stats {
        display: flex;
        gap: 2rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
    }

    .quiz-stat {
        text-align: center;
    }

    .quiz-stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bnn-primary);
        display: block;
    }

    .quiz-stat-label {
        font-size: 0.8rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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

    .quiz-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .quiz-card:nth-child(2) { animation-delay: 0.1s; }
    .quiz-card:nth-child(3) { animation-delay: 0.2s; }
    .quiz-card:nth-child(4) { animation-delay: 0.3s; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quiz-header {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .quiz-header h2 {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 0.5rem;
            text-align: center;
        }

        .quiz-info {
            flex-direction: column;
            gap: 0.5rem;
        }

        .quiz-card-body {
            padding: 1.5rem;
        }

        .quiz-card-footer {
            padding: 0 1.5rem 1.5rem;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-history {
            align-self: stretch;
            justify-content: center;
        }

        .quiz-stats {
            gap: 1rem;
        }

        .empty-state {
            padding: 3rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="quiz-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>
                <i class="fas fa-graduation-cap"></i> 
                Quiz Anti Narkoba
                <span class="role-badge">{{ ucfirst(auth()->user()->role) }}</span>
            </h2>
            <p>Pilih quiz yang ingin Anda ikuti untuk meningkatkan pengetahuan tentang bahaya narkoba</p>
            <div class="quiz-stats">
                <div class="quiz-stat">
                    <span class="quiz-stat-number">{{ $quizzes->count() }}</span>
                    <span class="quiz-stat-label">Quiz Tersedia</span>
                </div>
                <div class="quiz-stat">
                    <span class="quiz-stat-number">{{ $completedAttempts }}</span>
                    <span class="quiz-stat-label">Quiz Selesai</span>
                </div>
            </div>
        </div>
        <a href="{{ route('quiz.history') }}" class="btn btn-history">
            <i class="fas fa-history"></i> 
            Riwayat Quiz
        </a>
    </div>
</div>

<div class="row">
    @forelse($quizzes as $quiz)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card quiz-card">
                <div class="quiz-difficulty difficulty-{{ $quiz->difficulty ?? 'medium' }}">
                    {{ ucfirst($quiz->difficulty ?? 'Medium') }}
                </div>
                
                <div class="card-body quiz-card-body">
                    <h5 class="quiz-title">{{ $quiz->title }}</h5>
                    @if($quiz->description)
                        <p class="quiz-description">{{ Str::limit($quiz->description, 120) }}</p>
                    @endif
                    
                    <div class="quiz-info-container">
                        <div class="quiz-info">
                            <div class="quiz-info-item">
                                <i class="fas fa-question-circle"></i>
                                <span>{{ $quiz->questions_count }} Soal</span>
                            </div>
                            <div class="quiz-info-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $quiz->time_limit }} Menit</span>
                            </div>
                        </div>
                        @if($quiz->passing_score)
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: #64748b;">
                            <i class="fas fa-target" style="color: var(--bnn-gold);"></i>
                            Minimal skor: {{ $quiz->passing_score }}%
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="card-footer quiz-card-footer">
                    <a href="{{ route('quiz.show', $quiz) }}" class="btn btn-start-quiz">
                        <i class="fas fa-play me-2"></i> 
                        Mulai Quiz
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-clipboard-question"></i>
                </div>
                <h5>Belum Ada Quiz Tersedia</h5>
                <p>Saat ini belum ada quiz yang tersedia untuk <strong>{{ auth()->user()->role }}</strong>.<br>
                Silakan hubungi administrator atau coba lagi nanti.</p>
                
                <div style="margin-top: 2rem;">
                    <a href="{{ route('quiz.history') }}" class="btn btn-history" style="margin-right: 1rem;">
                        <i class="fas fa-history"></i> 
                        Lihat Riwayat
                    </a>
                    <button onclick="window.location.reload()" class="btn" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1.5rem;">
                        <i class="fas fa-refresh"></i> 
                        Refresh Halaman
                    </button>
                </div>
            </div>
        </div>
    @endforelse
</div>

@if($quizzes->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius: 15px; padding: 1.5rem; border: 1px solid #bae6fd;">
            <div class="d-flex align-items-center gap-1rem">
                <div style="background: var(--bnn-primary); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div style="flex: 1;">
                    <h6 style="color: var(--bnn-dark); font-weight: 600; margin-bottom: 0.5rem;">Tips Mengerjakan Quiz</h6>
                    <p style="color: #0369a1; margin: 0; font-size: 0.9rem;">
                        Baca setiap soal dengan teliti, kelola waktu dengan baik, dan ingat bahwa quiz ini bertujuan untuk meningkatkan kesadaran Anda tentang bahaya narkoba.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection