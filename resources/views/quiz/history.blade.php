@extends('layouts.app')

@section('title', 'Riwayat Quiz')

@push('styles')
<style>
    :root {
        --bnn-primary: #1e3a8a;        /* Biru tua untuk primary */
        --bnn-secondary: #3b82f6;      /* Biru muda untuk secondary */
        --bnn-accent: #10b981;         /* Hijau untuk aksen */
        --bnn-warning: #f59e0b;        /* Kuning untuk warning */
        --bnn-danger: #ef4444;         /* Merah untuk danger */
        --bnn-dark: #374151;           /* Abu-abu gelap untuk teks */
        --bnn-white: #ffffff;
        --bnn-gray-light: #f8fafc;
    }

    .history-header {
        background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-blue-soft) 100%);
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        border: none;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.08);
    }

    .history-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(
            90deg,
            var(--bnn-blue-dark) 0%,
            var(--bnn-blue-light) 30%,
            var(--bnn-yellow) 50%,
            var(--bnn-blue-light) 70%,
            var(--bnn-blue-dark) 100%
        );
    }

    .history-header h2 {
        color: var(--bnn-primary);
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.8rem;
    }

    .history-header h2 i {
        color: var(--bnn-secondary);
        padding: 0.75rem;
        background: var(--bnn-white);
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.15);
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .history-header p {
        color: #64748b;
        margin: 0;
        font-size: 1rem;
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

    .stats-summary {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #bae6fd;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.06);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(30, 64, 175, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
    }

    .stat-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(30, 64, 175, 0.12);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--bnn-primary);
        display: block;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
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
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
    }

    .history-table {
        margin: 0;
        font-size: 0.95rem;
    }

    .history-table thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        color: var(--bnn-dark);
        font-weight: 600;
        font-size: 0.9rem;
        padding: 1.5rem 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        position: relative;
    }

    .history-table thead th i {
        color: var(--bnn-primary);
        margin-right: 0.5rem;
    }

    .history-table tbody tr {
        transition: all 0.3s ease;
        border: none;
    }

    .history-table tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        transform: translateX(6px);
        box-shadow: 0 4px 20px rgba(30, 64, 175, 0.08);
    }

    .history-table tbody td {
        padding: 1.5rem 1.25rem;
        border: none;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .quiz-title-cell {
        font-weight: 600;
        color: var(--bnn-dark);
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .quiz-meta {
        color: #64748b;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quiz-meta i {
        color: var(--bnn-primary);
        width: 14px;
    }

    .date-cell {
        font-weight: 600;
        color: var(--bnn-dark);
        font-size: 0.95rem;
    }

    .date-time {
        color: #64748b;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .score-badge {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        padding: 0.6rem 1.2rem;
        border-radius: 16px;
        display: inline-block;
        min-width: 70px;
        text-align: center;
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.2);
    }

    .answers-stats {
        font-weight: 600;
        color: var(--bnn-dark);
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .progress-container {
        margin-top: 0.5rem;
    }

    .progress-custom {
        height: 10px;
        background: #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .progress-bar-custom {
        height: 100%;
        background: linear-gradient(90deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
        border-radius: 12px;
        transition: width 0.8s ease;
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

    .grade-badge {
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .grade-success {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        color: #065f46;
        border: 1px solid #86efac;
    }

    .grade-info {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #1d4ed8;
        border: 1px solid #93c5fd;
    }

    .grade-warning {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        color: #d97706;
        border: 1px solid #fcd34d;
    }

    .grade-danger {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        color: #dc2626;
        border: 1px solid #f87171;
    }

    .btn-detail {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
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
        width: 120px;
        height: 120px;
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
        font-size: 3rem;
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

    .learning-analysis {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-top: 2rem;
        border: 1px solid #bbf7d0;
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.08);
    }

    .learning-analysis-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .learning-icon {
        background: var(--bnn-accent);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.2);
        flex-shrink: 0;
    }

    .learning-icon i {
        font-size: 1.5rem;
    }

    .learning-text h6 {
        color: var(--bnn-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .learning-text p {
        color: #15803d;
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Pagination Styling */
    .pagination {
        justify-content: center;
        margin-top: 2rem;
        gap: 0.5rem;
    }

    .page-item .page-link {
        border: 2px solid #e2e8f0;
        color: var(--bnn-primary);
        font-weight: 500;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .page-item .page-link:hover {
        background: var(--bnn-primary);
        border-color: var(--bnn-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.2);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        border-color: var(--bnn-primary);
        color: white;
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.3);
    }

    /* Animation Effects */
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

    .history-card {
        animation: fadeInUp 0.8s ease-out;
    }

    .stats-summary {
        animation: fadeInUp 0.6s ease-out;
    }

    .history-table tbody tr {
        animation: fadeInUp 0.5s ease-out;
    }

    .history-table tbody tr:nth-child(2) { animation-delay: 0.1s; }
    .history-table tbody tr:nth-child(3) { animation-delay: 0.2s; }
    .history-table tbody tr:nth-child(4) { animation-delay: 0.3s; }
    .history-table tbody tr:nth-child(5) { animation-delay: 0.4s; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .history-header {
            padding: 2rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .history-header h2 {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 0.75rem;
            text-align: center;
        }

        .header-content {
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }

        .btn-new-quiz {
            align-self: stretch;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-item {
            padding: 1rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .history-table {
            font-size: 0.85rem;
        }

        .history-table thead th {
            padding: 1rem 0.75rem;
            font-size: 0.8rem;
        }

        .history-table tbody td {
            padding: 1rem 0.75rem;
        }

        .quiz-title-cell {
            font-size: 0.9rem;
        }

        .quiz-meta {
            font-size: 0.75rem;
        }

        .btn-detail {
            padding: 0.5rem 0.8rem;
            font-size: 0.8rem;
        }

        .learning-analysis {
            padding: 1.5rem;
        }

        .learning-analysis-content {
            flex-direction: column;
            text-align: center;
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
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }

        .empty-state-history {
            padding: 3rem 1rem;
        }

        .empty-state-icon-history {
            width: 100px;
            height: 100px;
        }

        .empty-state-icon-history i {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="history-header">
    <div class="d-flex justify-content-between align-items-center header-content">
        <div>
            <h2>
                <i class="fas fa-history"></i> 
                Riwayat Quiz Anti Narkoba
            </h2>
            <p>Lihat progres dan hasil quiz yang telah Anda ikuti</p>
        </div>
        {{-- <a href="{{ route('quiz.index') }}" class="btn btn-new-quiz">
            <i class="fas fa-plus"></i> 
            Quiz Baru
        </a> --}}
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
                                    <th><i class="fas fa-clipboard-question"></i>Quiz</th>
                                    <th><i class="fas fa-calendar"></i>Tanggal</th>
                                    <th><i class="fas fa-star"></i>Skor</th>
                                    <th><i class="fas fa-check"></i>Benar/Total</th>
                                    <th><i class="fas fa-award"></i>Status</th>
                                    <th><i class="fas fa-eye"></i>Aksi</th>
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
                                            <i class="fas fa-search"></i> 
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="padding: 2rem;">
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
                            <i class="fas fa-play"></i> 
                            Ikuti Quiz Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($attempts->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="learning-analysis">
            <div class="learning-analysis-content">
                <div class="learning-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="learning-text">
                    <h6>Analisis Pembelajaran</h6>
                    <p>Terus tingkatkan pengetahuan Anda tentang bahaya narkoba. Semakin banyak quiz yang Anda ikuti, semakin baik pemahaman Anda tentang pencegahan narkoba.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection