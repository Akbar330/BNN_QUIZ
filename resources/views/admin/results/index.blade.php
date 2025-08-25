@extends('layouts.app')

@section('title', 'Hasil Quiz')

@push('styles')
<style>
    .results-header {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(30, 58, 138, 0.15);
    }

    .results-header::before {
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

    .results-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .results-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 400;
    }

    .results-stats {
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

    .stat-icon.users {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
    }

    .stat-icon.average {
        background: linear-gradient(135deg, var(--bnn-yellow), #f59e0b);
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

    .results-table-container {
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

    .results-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .results-table thead {
        background: linear-gradient(135deg, var(--bnn-blue-dark), var(--bnn-blue-light));
    }

    .results-table thead th {
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: white;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        vertical-align: middle;
        position: relative;
    }

    .results-table thead th:first-child {
        border-radius: 0;
    }

    .results-table thead th:last-child {
        border-radius: 0;
    }

    .results-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(59, 130, 246, 0.05);
    }

    .results-table tbody tr:hover {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.03) 100%);
        transform: scale(1.01);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.1);
    }

    .results-table tbody td {
        border: none;
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        color: var(--bnn-gray-dark);
        font-weight: 500;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .quiz-title {
        font-weight: 600;
        color: var(--bnn-blue-dark);
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .score-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        min-width: 60px;
        text-align: center;
        display: inline-block;
    }

    .score-excellent {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
    }

    .score-good {
        background: linear-gradient(135deg, var(--bnn-yellow), #f59e0b);
        color: white;
    }

    .score-poor {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
        color: white;
    }

    .date-info {
        font-size: 0.85rem;
        color: #6b7280;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        border: none;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-view {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        color: white;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
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
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--bnn-blue-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: var(--bnn-blue-light);
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--bnn-blue-dark);
    }

    .empty-subtitle {
        color: #6b7280;
        font-size: 1rem;
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
        .results-header {
            padding: 1.5rem;
            text-align: center;
        }

        .results-header h1 {
            font-size: 2rem;
        }

        .results-stats {
            grid-template-columns: 1fr;
        }

        .results-table-container {
            overflow-x: auto;
        }

        .results-table {
            min-width: 800px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
</style>
@endpush

@section('content')
<div class="results-header">
    <h1><i class="fas fa-chart-line me-3"></i>Hasil Quiz</h1>
    <p>Kelola dan pantau semua hasil quiz peserta</p>
</div>

{{-- Statistics Cards --}}
<div class="results-stats">
    <div class="stat-card">
        <div class="stat-icon total">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <div class="stat-number">{{ $attempts->total() }}</div>
        <div class="stat-label">Total Hasil Quiz</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon users">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-number">{{ $attempts->unique('user_id')->count() }}</div>
        <div class="stat-label">Peserta</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon average">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="stat-number">{{ $attempts->avg('score') ? number_format($attempts->avg('score'), 1) : '0' }}</div>
        <div class="stat-label">Rata-rata Skor</div>
    </div>
</div>

{{-- Results Table --}}
<div class="results-table-container">
    <div class="table-header">
        <h3><i class="fas fa-table me-2"></i>Daftar Hasil Quiz</h3>
    </div>
    
    @if($attempts->count() > 0)
        <div class="table-responsive">
            <table class="table results-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>No</th>
                        <th><i class="fas fa-user me-2"></i>Peserta</th>
                        <th><i class="fas fa-book me-2"></i>Judul Quiz</th>
                        <th><i class="fas fa-star me-2"></i>Skor</th>
                        <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                        <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attempts as $attempt)
                        <tr>
                            <td>
                                <span class="badge" style="background: var(--bnn-blue-soft); color: var(--bnn-blue-dark); font-weight: 600; padding: 0.5rem 0.75rem; border-radius: 12px;">
                                    {{ ($attempts->currentPage() - 1) * $attempts->perPage() + $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($attempt->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: var(--bnn-blue-dark);">
                                            {{ $attempt->user->name }}
                                        </div>
                                        <small style="color: #6b7280;">{{ $attempt->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="quiz-title" title="{{ $attempt->quiz->title }}">
                                    {{ $attempt->quiz->title }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $scoreClass = 'score-poor';
                                    if($attempt->score >= 80) $scoreClass = 'score-excellent';
                                    elseif($attempt->score >= 60) $scoreClass = 'score-good';
                                @endphp
                                <span class="score-badge {{ $scoreClass }}">
                                    {{ $attempt->score }}%
                                </span>
                            </td>
                            <td>
                                <div class="date-info">
                                    <div><i class="fas fa-calendar-day me-1"></i>{{ $attempt->created_at->format('d M Y') }}</div>
                                    <div><i class="fas fa-clock me-1"></i>{{ $attempt->created_at->format('H:i') }} WIB</div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.results.show', $attempt->id) }}" 
                                       class="btn-action btn-view">
                                        <i class="fas fa-eye"></i>
                                        <span>Lihat</span>
                                    </a>
                                    <form action="{{ route('admin.results.destroy', $attempt->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil quiz ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <div class="empty-title">Belum Ada Hasil Quiz</div>
            <div class="empty-subtitle">Hasil quiz akan muncul di sini setelah peserta mengikuti quiz</div>
        </div>
    @endif
</div>

{{-- Pagination --}}
@if($attempts->hasPages())
    <div class="pagination-container">
        {{ $attempts->links() }}
    </div>
@endif

@endsection

@push('scripts')
<script>
    // Add smooth scrolling and enhanced interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading animation for action buttons
        const actionButtons = document.querySelectorAll('.btn-action');
        actionButtons.forEach(button => {
            if (button.tagName === 'A') {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    icon.className = 'fas fa-spinner fa-spin';
                    setTimeout(() => {
                        icon.className = this.classList.contains('btn-view') ? 'fas fa-eye' : 'fas fa-trash';
                    }, 2000);
                });
            }
        });

        // Add hover effects to table rows
        const tableRows = document.querySelectorAll('.results-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Auto-refresh stats every 30 seconds
        setInterval(() => {
            // You can add AJAX call here to refresh stats
        }, 30000);
    });
</script>
@endpush