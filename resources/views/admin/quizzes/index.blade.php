@extends('layouts.app')

@section('title', 'Kelola Quiz')

@push('styles')
<style>
    .quiz-header {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(30, 58, 138, 0.15);
    }

    .quiz-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 8s infinite ease-in-out;
    }

    .quiz-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
    }

    .quiz-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .create-quiz-btn {
        background: linear-gradient(135deg, var(--bnn-yellow), #f59e0b);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.3);
        font-size: 1rem;
        white-space: nowrap;
    }

    .create-quiz-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(251, 191, 36, 0.4);
        color: white;
        background: linear-gradient(135deg, #f59e0b, var(--bnn-yellow));
    }

    .quiz-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--bnn-white);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-blue-light), var(--bnn-yellow));
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
        border-color: var(--bnn-blue-light);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: white;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .stat-icon.total {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
    }

    .stat-icon.active {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
    }

    .stat-icon.inactive {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--bnn-blue-dark);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--bnn-gray-dark);
        font-weight: 500;
    }

    .quiz-table-container {
        background: var(--bnn-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    .table-header {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.05) 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.1);
    }

    .table-header h3 {
        margin: 0;
        color: var(--bnn-blue-dark);
        font-weight: 600;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quiz-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .quiz-table thead {
        background: linear-gradient(135deg, var(--bnn-blue-dark), var(--bnn-blue-light));
    }

    .quiz-table thead th {
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: white;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        vertical-align: middle;
    }

    .quiz-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(59, 130, 246, 0.05);
    }

    .quiz-table tbody tr:hover {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.03) 100%);
        transform: scale(1.01);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.1);
    }

    .quiz-table tbody td {
        border: none;
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        color: var(--bnn-gray-dark);
        font-weight: 500;
    }

    .quiz-title {
        font-weight: 700;
        color: var(--bnn-blue-dark);
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }

    .quiz-description {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.4;
    }

    .role-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .role-pelajar {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        color: white;
    }

    .role-masyarakat {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-active {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
    }

    .status-inactive {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
        color: white;
    }

    .time-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: var(--bnn-blue-dark);
    }

    .question-count {
        background: var(--bnn-blue-soft);
        color: var(--bnn-blue-dark);
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        text-align: center;
    }

    .date-info {
        font-size: 0.9rem;
        color: #6b7280;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-view {
        background: linear-gradient(135deg, var(--bnn-gray-dark), #4b5563);
        color: white;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(55, 65, 81, 0.3);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--bnn-yellow), #f59e0b);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.3);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.3);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--bnn-gray-dark);
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--bnn-blue-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        font-size: 2.5rem;
        color: var(--bnn-blue-light);
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--bnn-blue-dark);
    }

    .empty-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination .page-link {
        border: 2px solid transparent;
        border-radius: 12px;
        margin: 0 0.25rem;
        padding: 0.75rem 1rem;
        color: var(--bnn-blue-dark);
        font-weight: 500;
        transition: all 0.3s ease;
        background: var(--bnn-white);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2);
        border-color: var(--bnn-blue-light);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--bnn-blue-dark), var(--bnn-blue-light));
        border-color: var(--bnn-blue-light);
        color: white;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    }

    @media (max-width: 768px) {
        .quiz-header-content {
            flex-direction: column;
            text-align: center;
        }

        .quiz-header h1 {
            font-size: 1.8rem;
            justify-content: center;
        }

        .quiz-stats {
            grid-template-columns: 1fr;
        }

        .quiz-table-container {
            overflow-x: auto;
        }

        .quiz-table {
            min-width: 800px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
</style>
@endpush

@section('content')
<div class="quiz-header">
    <div class="quiz-header-content">
        <h1><i class="fas fa-cogs"></i>Kelola Quiz</h1>
        <a href="{{ route('admin.quiz.create') }}" class="create-quiz-btn">
            <i class="fas fa-plus"></i>
            <span>Buat Quiz Baru</span>
        </a>
    </div>
</div>

{{-- Statistics Cards --}}
@if($quizzes->count() > 0)
<div class="quiz-stats">
    <div class="stat-card">
        <div class="stat-icon total">
            <i class="fas fa-list"></i>
        </div>
        <div class="stat-number">{{ $quizzes->total() }}</div>
        <div class="stat-label">Total Quiz</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon active">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-number">{{ $quizzes->where('is_active', true)->count() }}</div>
        <div class="stat-label">Quiz Aktif</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon inactive">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-number">{{ $quizzes->where('is_active', false)->count() }}</div>
        <div class="stat-label">Quiz Tidak Aktif</div>
    </div>
</div>
@endif

{{-- Quiz Table --}}
<div class="quiz-table-container">
    <div class="table-header">
        <h3><i class="fas fa-table me-2"></i>Daftar Quiz</h3>
    </div>
    
    @if($quizzes->count() > 0)
        <div class="table-responsive">
            <table class="table quiz-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-book me-2"></i>Judul</th>
                        <th><i class="fas fa-users me-2"></i>Target</th>
                        <th><i class="fas fa-clock me-2"></i>Waktu</th>
                        <th><i class="fas fa-question-circle me-2"></i>Soal</th>
                        <th><i class="fas fa-toggle-on me-2"></i>Status</th>
                        <th><i class="fas fa-calendar me-2"></i>Dibuat</th>
                        <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                    <tr>
                        <td>
                            <div class="quiz-title">{{ $quiz->title }}</div>
                            @if($quiz->description)
                                <div class="quiz-description">{{ Str::limit($quiz->description, 50) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="role-badge {{ $quiz->target_role === 'pelajar' ? 'role-pelajar' : 'role-masyarakat' }}">
                                {{ ucfirst($quiz->target_role) }}
                            </span>
                        </td>
                        <td>
                            <div class="time-info">
                                <i class="fas fa-stopwatch"></i>
                                {{ $quiz->time_limit }} menit
                            </div>
                        </td>
                        <td>
                            <div class="question-count">
                                {{ $quiz->questions_count }} soal
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $quiz->is_active ? 'status-active' : 'status-inactive' }}">
                                <i class="fas fa-{{ $quiz->is_active ? 'check' : 'times' }}"></i>
                                {{ $quiz->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="date-info">{{ $quiz->created_at->format('d/m/Y') }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.quiz.questions', $quiz) }}" 
                                   class="btn-action btn-view" 
                                   title="Kelola Soal">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.quiz.edit', $quiz) }}" 
                                   class="btn-action btn-edit" 
                                   title="Edit Quiz">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.quiz.destroy', $quiz) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action btn-delete" 
                                            title="Hapus Quiz">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($quizzes->hasPages())
            <div class="pagination-container">
                {{ $quizzes->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <div class="empty-title">Belum Ada Quiz</div>
            <div class="empty-subtitle">Mulai dengan membuat quiz pertama Anda untuk peserta</div>
            <a href="{{ route('admin.quiz.create') }}" class="create-quiz-btn">
                <i class="fas fa-plus"></i>
                <span>Buat Quiz Baru</span>
            </a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading animation for action buttons
        const actionButtons = document.querySelectorAll('.btn-action');
        actionButtons.forEach(button => {
            if (button.tagName === 'A') {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const originalClass = icon.className;
                    icon.className = 'fas fa-spinner fa-spin';
                    setTimeout(() => {
                        icon.className = originalClass;
                    }, 2000);
                });
            }
        });

        // Add hover effects to table rows
        const tableRows = document.querySelectorAll('.quiz-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Enhanced delete confirmation
        const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const quizTitle = this.closest('tr').querySelector('.quiz-title').textContent;
                
                if (confirm(`Yakin ingin menghapus quiz "${quizTitle}"? Tindakan ini tidak dapat dibatalkan.`)) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush