@extends('layouts.app')

@section('title', 'Riwayat Quiz')

@push('styles')
<style>
    .history-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .history-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-accent) 0%, var(--bnn-gold) 50%, var(--bnn-primary) 100%);
    }

    .history-header h2 {
        color: var(--bnn-dark);
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .history-header h2 i {
        color: var(--bnn-accent);
        padding: 0.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.1);
    }

    .history-header p {
        color: #64748b;
        font-size: 1.1rem;
        margin: 0;
    }

    .btn-new-quiz {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
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

    .btn-new-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
        color: white;
        text-decoration: none;
    }

    .history-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        overflow: hidden;
        position: relative;
    }

    .history-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
    }

    .history-table {
        margin: 0;
    }

    .history-table thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        color: var(--bnn-dark);
        font-weight: 600;
        font-size: 0.9rem;
        padding: 1.2rem 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    .history-table tbody tr {
        transition: all 0.3s ease;
        border: none;
    }

    .history-table tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        transform: translateX(4px);
    }

    .history-table tbody td {
        padding: 1.2rem 1rem;
        border: none;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .quiz-title-cell {
        font-weight: 600;
        color: var(--bnn-dark);
        font-size: 1rem;
    }

    .quiz-meta {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quiz-meta i {
        color: var(--bnn-primary);
        width: 12px;
    }

    .date-cell {
        font-weight: 500;
        color: var(--bnn-dark);
    }

    .date-time {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .score-badge {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 0.5rem 1rem;
        border-radius: 15px;
        display: inline-block;
        min-width: 60px;
        text-align: center;
    }

    .progress-container {
        margin-top: 0.5rem;
    }

    .progress-custom {
        height: 8px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-custom {
        height: 100%;
        background: linear-gradient(90deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
        border-radius: 10px;
        transition: width 0.6s ease;
        position: relative;
    }

    .progress-bar-custom::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .answers-stats {
        font-weight: 600;
        color: var(--bnn-dark);
        font-size: 0.95rem;
    }

    .grade-badge {
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .grade-success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }

    .grade-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1d4ed8;
        border: 1px solid #93c5fd;
    }

    .grade-warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #d97706;
        border: 1px solid #fcd34d;
    }

    .grade-danger {
        background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        color: #dc2626;
        border: 1px solid #f87171;
    }

    .btn-detail {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
        border: none;
        color: white;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-detail:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.3);
        color: white;
        text-decoration: none;
    }

    .empty-state-history {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.08);
        border: 2px dashed #e2e8f0;
        margin: 2rem 0;
    }

    .empty-state-icon-history {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        position: relative;
    }

    .empty-state-icon-history::before {
        content: '';
        position: absolute;
        inset: -10px;
        border: 2px dashed #cbd5e1;
        border-radius: 50%;
        animation: rotate 10s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .empty-state-icon-history i {
        font-size: 2.5rem;
        color: #64748b;
    }

    .empty-state-history h5 {
        color: var(--bnn-dark);
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .empty-state-history p {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .stats-summary {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid #bae6fd;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.05);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--bnn-primary);
        display: block;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .page-link {
        border: 2px solid #e2e8f0;
        color: var(--bnn-primary);
        font-weight: 500;
        border-radius: 10px;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: var(--bnn-primary);
        border-color: var(--bnn-primary);
        transform: translateY(-1px);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        border-color: var(--bnn-primary);
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

    .history-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .history-table tbody tr {
        animation: fadeInUp 0.4s ease-out;
    }

    .history-table tbody tr:nth-child(2) { animation-delay: 0.1s; }
    .history-table tbody tr:nth-child(3) { animation-delay: 0.2s; }
    .history-table tbody tr:nth-child(4) { animation-delay: 0.3s; }
    .history-table tbody tr:nth-child(5) { animation-delay: 0.4s; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .history-header {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .history-header h2 {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 0.5rem;
            text-align: center;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-new-quiz {
            align-self: stretch;
            justify-content: center;
        }

        .table-responsive {
            border-radius: 15px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .empty-state-history {
            padding: 3rem 1rem;
        }

        .empty-state-icon-history {
            width: 80px;
            height: 80px;
        }

        .empty-state-icon-history i {
            font-size: 2rem;
        }

        /* Mobile table styling */
        .history-table {
            font-size: 0.85rem;
        }

        .history-table thead th {
            padding: 1rem 0.5rem;
            font-size: 0.8rem;
        }

        .history-table tbody td {
            padding: 1rem 0.5rem;
        }

        .quiz-title-cell {
            font-size: 0.9rem;
        }

        .quiz-meta {
            font-size: 0.75rem;
        }

        .btn-detail {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .history-table {
            font-size: 0.8rem;
        }
        
        .score-badge {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
        }
    }
</style>
@endpush

@section('content')
<div class="history-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>
                <i class="fas fa-history"></i> 
                Riwayat Quiz Anti Narkoba
            </h2>
            <p>Lihat progres dan hasil quiz yang telah Anda ikuti</p>
        </div>
        <a href="{{ route('quiz.index') }}" class="btn btn-new-quiz">
            <i class="fas fa-plus"></i> 
            Quiz Baru
        </a>
    </div>
</div>

@if($attempts->count() > 0)
    <div class="stats-summary">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ $attempts->count() }}</span>
                <span class="stat-label">Total Quiz</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ number_format($attempts->avg('score'), 0) }}</span>
                <span class="stat-label">Rata-rata Skor</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $attempts->where('score', '>=', 70)->count() }}</span>
                <span class="stat-label">Quiz Lulus</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ number_format(($attempts->where('score', '>=', 70)->count() / $attempts->count()) * 100, 0) }}%</span>
                <span class="stat-label">Tingkat Kelulusan</span>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card history-card">
            <div class="card-body" style="padding: 0;">
                @if($attempts->count() > 0)
                    <div class="table-responsive">
                        <table class="table history-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-clipboard-question me-2"></i>Quiz</th>
                                    <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                                    <th><i class="fas fa-star me-2"></i>Skor</th>
                                    <th><i class="fas fa-check me-2"></i>Benar/Total</th>
                                    <th><i class="fas fa-award me-2"></i>Status</th>
                                    <th><i class="fas fa-eye me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attempts as $attempt)
                                <tr>
                                    <td>
                                        <div class="quiz-title-cell">{{ $attempt->quiz->title }}</div>
                                        <div class="quiz-meta">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $attempt->quiz->time_limit }} menit</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-cell">{{ $attempt->created_at->format('d/m/Y') }}</div>
                                        <div class="date-time">{{ $attempt->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <span class="score-badge">{{ number_format($attempt->score, 0) }}</span>
                                    </td>
                                    <td>
                                        <div class="answers-stats">
                                            {{ $attempt->correct_answers }}/{{ $attempt->total_questions }}
                                        </div>
                                        <div class="progress-container">
                                            <div class="progress-custom">
                                                <div class="progress-bar-custom" 
                                                     style="width: {{ ($attempt->correct_answers / $attempt->total_questions) * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $grade = '';
                                            $gradeClass = '';
                                            if ($attempt->score >= 80) {
                                                $grade = 'Sangat Baik';
                                                $gradeClass = 'success';
                                            } elseif ($attempt->score >= 70) {
                                                $grade = 'Baik';
                                                $gradeClass = 'info';
                                            } elseif ($attempt->score >= 60) {
                                                $grade = 'Cukup';
                                                $gradeClass = 'warning';
                                            } else {
                                                $grade = 'Perlu Belajar Lagi';
                                                $gradeClass = 'danger';
                                            }
                                        @endphp
                                        <span class="grade-badge grade-{{ $gradeClass }}">
                                            {{ $grade }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('quiz.result', [$attempt->quiz, $attempt]) }}" 
                                           class="btn btn-detail">
                                            <i class="fas fa-search me-1"></i> 
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="padding: 1rem 2rem;">
                        {{ $attempts->links() }}
                    </div>
                @else
                    <div class="empty-state-history">
                        <div class="empty-state-icon-history">
                            <i class="fas fa-clipboard-question"></i>
                        </div>
                        <h5>Belum Ada Riwayat Quiz</h5>
                        <p>Anda belum pernah mengikuti quiz anti narkoba.<br>
                        Mulai perjalanan edukasi Anda sekarang juga!</p>
                        
                        <a href="{{ route('quiz.index') }}" class="btn btn-new-quiz">
                            <i class="fas fa-play me-2"></i> 
                            Ikuti Quiz Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($attempts->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 15px; padding: 1.5rem; border: 1px solid #bbf7d0;">
            <div class="d-flex align-items-center gap-1rem">
                <div style="background: var(--bnn-accent); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div style="flex: 1;">
                    <h6 style="color: var(--bnn-dark); font-weight: 600; margin-bottom: 0.5rem;">Analisis Pembelajaran</h6>
                    <p style="color: #15803d; margin: 0; font-size: 0.9rem;">
                        Terus tingkatkan pengetahuan Anda tentang bahaya narkoba. Semakin banyak quiz yang Anda ikuti, semakin baik pemahaman Anda tentang pencegahan narkoba.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection