<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 16px 48px rgba(30, 58, 138, 0.15);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(251, 191, 36, 0.1);
        border-radius: 50%;
        animation: float 20s infinite ease-in-out;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 15s infinite ease-in-out reverse;
    }

    .dashboard-title {
        color: var(--bnn-white);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .dashboard-subtitle {
        color: var(--bnn-yellow-light);
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .stats-card {
        background: var(--bnn-white);
        border-radius: 20px;
        padding: 2rem;
        border: none;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-blue-light), var(--bnn-yellow));
        border-radius: 20px 20px 0 0;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .stats-card.primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        color: white;
    }

    .stats-card.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .stats-card.info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
    }

    .stats-content {
        display: flex;
        justify-content: between;
        align-items: center;
    }

    .stats-text h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }

    .stats-text h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }

    .stats-icon {
        font-size: 3rem;
        opacity: 0.8;
        margin-left: auto;
    }

    .quiz-section {
        background: var(--bnn-white);
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .quiz-section .card-header {
        background: linear-gradient(135deg, var(--bnn-gray-light) 0%, #f1f5f9 100%);
        border-bottom: 2px solid var(--bnn-blue-soft);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: between;
        align-items: center;
    }

    .quiz-section .card-header h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--bnn-blue-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-primary-bnn {
        background: linear-gradient(135deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary-bnn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, #1e40af 100%);
    }

    .table-modern {
        margin: 0;
    }

    .table-modern thead th {
        background: var(--bnn-blue-soft);
        color: var(--bnn-blue-dark);
        font-weight: 600;
        font-size: 0.9rem;
        padding: 1.25rem 1.5rem;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-modern tbody td {
        padding: 1.25rem 1.5rem;
        border: none;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-weight: 500;
    }

    .table-modern tbody tr {
        transition: all 0.3s ease;
    }

    .table-modern tbody tr:hover {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.05) 100%);
        transform: translateX(4px);
    }

    .badge-modern {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pelajar {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        color: white;
    }

    .badge-guru {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
    }

    .badge-aktif {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
    }

    .badge-tidak-aktif {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
        color: white;
    }

    .btn-action {
        padding: 0.5rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-outline-secondary:hover {
        background: var(--bnn-gray-dark);
        border-color: var(--bnn-gray-dark);
    }

    .btn-outline-dark:hover {
        background: var(--bnn-blue-dark);
        border-color: var(--bnn-blue-dark);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--bnn-gray-dark);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--bnn-blue-light);
        margin-bottom: 2rem;
        opacity: 0.6;
    }

    .empty-state p {
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .empty-state a {
        color: var(--bnn-blue-light);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .empty-state a:hover {
        color: var(--bnn-blue-dark);
        text-decoration: underline;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-20px) rotate(90deg); }
        50% { transform: translateY(0) rotate(180deg); }
        75% { transform: translateY(-15px) rotate(270deg); }
    }

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }
        
        .dashboard-header {
            padding: 1.5rem;
        }
        
        .stats-card {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .quiz-section .card-header {
            padding: 1rem;
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
        
        .table-responsive {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="dashboard-title">
                <i class="fas fa-tachometer-alt me-3"></i>
                Admin Dashboard
            </h1>
            <p class="dashboard-subtitle mb-0">
                Kelola dan pantau sistem quiz anti narkoba BNN
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="text-white-50">
                <i class="fas fa-calendar-alt me-2"></i>
                {{ now()->format('d F Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stats-card primary">
            <div class="stats-content">
                <div class="stats-text">
                    <h5>Total Quiz</h5>
                    <h3>{{ $quizzes->count() }}</h3>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-list-alt"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stats-card success">
            <div class="stats-content">
                <div class="stats-text">
                    <h5>Total Attempts</h5>
                    <h3>{{ $totalAttempts }}</h3>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stats-card info">
            <div class="stats-content">
                <div class="stats-text">
                    <h5>Total Questions</h5>
                    <h3>{{ $quizzes->sum('questions_count') }}</h3>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quiz Management Section -->
<div class="row">
    <div class="col-12">
        <div class="card quiz-section">
            <div class="card-header">
                <h5>
                    <i class="fas fa-clipboard-list text-primary"></i>
                    Quiz Terbaru
                </h5>
                <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary-bnn">
                    <i class="fas fa-plus"></i>
                    Buat Quiz Baru
                </a>
            </div>
            <div class="card-body p-0">
                @if($quizzes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th>Judul Quiz</th>
                                    <th>Target</th>
                                    <th>Jumlah Soal</th>
                                    <th>Total Attempts</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes->take(10) as $quiz)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $quiz->title }}</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern {{ $quiz->target_role === 'pelajar' ? 'badge-pelajar' : 'badge-guru' }}">
                                            {{ ucfirst($quiz->target_role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-list-ol text-primary me-2"></i>
                                            {{ $quiz->questions_count }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-chart-line text-success me-2"></i>
                                            {{ $quiz->attempts_count }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern {{ $quiz->is_active ? 'badge-aktif' : 'badge-tidak-aktif' }}">
                                            {{ $quiz->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('admin.quiz.hideQuiz', $quiz) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-action btn-outline-{{ $quiz->is_hidden ? 'secondary' : 'dark' }}" 
                                                        title="{{ $quiz->is_hidden ? 'Tampilkan Quiz' : 'Sembunyikan Quiz' }}">
                                                    <i class="fas fa-eye{{ $quiz->is_hidden ? '' : '-slash' }}"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.quiz.questions', $quiz) }}" 
                                               class="btn btn-action btn-outline-secondary"
                                               title="Edit Questions">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <p class="mb-3">Belum ada quiz yang dibuat</p>
                        <p class="text-muted">
                            Mulai dengan <a href="{{ route('admin.quiz.create') }}">membuat quiz pertama</a> 
                            untuk sistem pembelajaran anti narkoba
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection