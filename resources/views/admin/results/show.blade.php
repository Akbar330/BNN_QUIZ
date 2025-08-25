@extends('layouts.app')

@section('title', 'Detail Hasil Quiz')

@push('styles')
<style>
    .detail-header {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(30, 58, 138, 0.15);
    }

    .detail-header::before {
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

    .detail-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .detail-header .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
    }

    .detail-header .breadcrumb-item {
        color: rgba(255, 255, 255, 0.8);
    }

    .detail-header .breadcrumb-item.active {
        color: var(--bnn-yellow-light);
        font-weight: 500;
    }

    .detail-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }

    .participant-info {
        background: var(--bnn-white);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
        border: 2px solid var(--bnn-blue-soft);
        position: relative;
    }

    .participant-info::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--bnn-blue-light), var(--bnn-yellow), var(--bnn-blue-dark));
        border-radius: 20px 20px 0 0;
    }

    .participant-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .participant-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        font-weight: 700;
        box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
        position: relative;
    }

    .participant-avatar::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 3px solid var(--bnn-yellow);
        animation: pulse 2s infinite;
    }

    .participant-details h2 {
        color: var(--bnn-blue-dark);
        font-weight: 700;
        font-size: 1.8rem;
        margin: 0 0 0.5rem 0;
    }

    .participant-details .subtitle {
        color: #6b7280;
        font-size: 1rem;
        margin: 0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        background: var(--bnn-gray-light);
        padding: 1.5rem;
        border-radius: 16px;
        border-left: 4px solid var(--bnn-blue-light);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-item::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        background: rgba(59, 130, 246, 0.05);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.1);
        border-left-color: var(--bnn-yellow);
    }

    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--bnn-blue-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--bnn-gray-dark);
    }

    .score-display {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 25px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
    }

    .score-display.good {
        background: linear-gradient(135deg, var(--bnn-yellow), #f59e0b);
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.3);
    }

    .score-display.poor {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.3);
    }

    .score-display::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shine 3s infinite;
    }

    .answers-section {
        background: var(--bnn-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.1);
        margin-bottom: 2rem;
    }

    .section-header {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.05) 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.1);
    }

    .section-header h3 {
        margin: 0;
        color: var(--bnn-blue-dark);
        font-weight: 600;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .answers-summary {
        padding: 1.5rem 2rem;
        background: var(--bnn-gray-light);
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .summary-item {
        text-align: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        min-width: 120px;
    }

    .summary-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .summary-number.correct {
        color: var(--bnn-success);
    }

    .summary-number.incorrect {
        color: var(--bnn-danger);
    }

    .summary-number.total {
        color: var(--bnn-blue-dark);
    }

    .summary-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .answers-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .answers-table thead {
        background: linear-gradient(135deg, var(--bnn-blue-dark), var(--bnn-blue-light));
    }

    .answers-table thead th {
        border: none;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        color: white;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        vertical-align: middle;
    }

    .answers-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(59, 130, 246, 0.05);
    }

    .answers-table tbody tr:hover {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.03) 100%);
        transform: scale(1.005);
    }

    .answers-table tbody td {
        border: none;
        padding: 1.5rem;
        vertical-align: middle;
        color: var(--bnn-gray-dark);
        font-weight: 500;
    }

    .question-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--bnn-blue-soft);
        color: var(--bnn-blue-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin: 0 auto;
    }

    .question-text {
        font-weight: 600;
        color: var(--bnn-blue-dark);
        line-height: 1.5;
        max-width: 300px;
    }

    .answer-text {
        background: var(--bnn-gray-light);
        padding: 0.75rem 1rem;
        border-radius: 12px;
        border-left: 4px solid #e5e7eb;
        font-weight: 500;
        max-width: 200px;
        word-wrap: break-word;
    }

    .answer-text.user-answer {
        border-left-color: var(--bnn-blue-light);
        background: rgba(59, 130, 246, 0.05);
    }

    .answer-text.correct-answer {
        border-left-color: var(--bnn-success);
        background: rgba(16, 185, 129, 0.05);
    }

    .status-badge {
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-correct {
        background: linear-gradient(135deg, var(--bnn-success), #059669);
        color: white;
    }

    .status-incorrect {
        background: linear-gradient(135deg, var(--bnn-danger), #dc2626);
        color: white;
    }

    .back-button {
        background: linear-gradient(135deg, var(--bnn-gray-dark), #4b5563);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(55, 65, 81, 0.2);
        font-size: 1rem;
    }

    .back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(55, 65, 81, 0.3);
        color: white;
        background: linear-gradient(135deg, #4b5563, var(--bnn-gray-dark));
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

    @media (max-width: 768px) {
        .detail-header {
            padding: 1.5rem;
            text-align: center;
        }

        .detail-header h1 {
            font-size: 1.8rem;
            justify-content: center;
        }

        .participant-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .participant-avatar {
            width: 70px;
            height: 70px;
            font-size: 1.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .answers-summary {
            flex-direction: column;
            gap: 1rem;
        }

        .summary-item {
            margin: 0 auto;
        }

        .answers-table-container {
            overflow-x: auto;
        }

        .answers-table {
            min-width: 800px;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    @keyframes pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.05); }
        100% { opacity: 1; transform: scale(1); }
    }

    @keyframes shine {
        0% { left: -100%; }
        50% { left: 100%; }
        100% { left: 100%; }
    }
</style>
@endpush

@section('content')
<div class="detail-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.results.index') }}" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                    Hasil Quiz
                </a>
            </li>
            <li class="breadcrumb-item active">Detail Hasil</li>
        </ol>
    </nav>
    <h1><i class="fas fa-file-alt"></i>Detail Hasil Quiz</h1>
</div>

@forelse($attempts as $result)
    {{-- Participant Information --}}
    <div class="participant-info">
        <div class="participant-header">
            <div class="participant-avatar">
                {{ strtoupper(substr($result->user->name, 0, 2)) }}
            </div>
            <div class="participant-details">
                <h2>{{ $result->user->name }}</h2>
                <p class="subtitle">{{ $result->user->email }}</p>
            </div>
        </div>
        
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-book"></i>
                    Judul Quiz
                </div>
                <div class="info-value">{{ $result->quiz->title }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-trophy"></i>
                    Skor
                </div>
                <div class="info-value">
                    @php
                        $scoreClass = 'poor';
                        if($result->score >= 80) $scoreClass = 'excellent';
                        elseif($result->score >= 60) $scoreClass = 'good';
                    @endphp
                    <div class="score-display {{ $scoreClass }}">
                        {{ $result->score }}%
                    </div>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-calendar-alt"></i>
                    Tanggal
                </div>
                <div class="info-value">{{ $result->created_at->format('d M Y') }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-clock"></i>
                    Waktu
                </div>
                <div class="info-value">{{ $result->created_at->format('H:i') }} WIB</div>
            </div>
        </div>
    </div>

    {{-- Answers Section --}}
    <div class="answers-section">
        {{-- <div class="section-header">
            <h3><i class="fas fa-list-alt"></i>Jawaban Peserta</h3>
        </div> --}}
        
        @if($result->attempts && count($result->attempts) > 0)
            {{-- Summary --}}
            <div class="answers-summary">
                @php
                    $totalQuestions = count($result->attempts);
                    $correctAnswers = collect($result->attempts)->where('is_correct', true)->count();
                    $incorrectAnswers = $totalQuestions - $correctAnswers;
                @endphp
                
                <div class="summary-item">
                    <div class="summary-number total">{{ $totalQuestions }}</div>
                    <div class="summary-label">Total Soal</div>
                </div>
                
                <div class="summary-item">
                    <div class="summary-number correct">{{ $correctAnswers }}</div>
                    <div class="summary-label">Benar</div>
                </div>
                
                <div class="summary-item">
                    <div class="summary-number incorrect">{{ $incorrectAnswers }}</div>
                    <div class="summary-label">Salah</div>
                </div>
            </div>

            {{-- Answers Table --}}
            <div class="answers-table-container">
                <table class="table answers-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>No</th>
                            <th><i class="fas fa-question-circle me-2"></i>Pertanyaan</th>
                            {{-- <th><i class="fas fa-user-edit me-2"></i>Jawaban Peserta</th> --}}
                            <th><i class="fas fa-check-circle me-2"></i>Jawaban Benar</th>
                            <th><i class="fas fa-clipboard-check me-2"></i>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result->answers as $index => $answer)
                        <tr>
                            <td>
                                <div class="question-number">{{ $index + 1 }}</div>
                            </td>
                            <td>
                                <div class="question-text">{{ $answer->question->question }}</div>
                            </td>
                            {{-- <td>
                                <div class="answer-text user-answer">{{ $answer->answer_text }}</div>
                            </td> --}}
                            <td>
                                <div class="answer-text correct-answer">{{ $answer->question->correct_answer }}</div>
                            </td>
                            <td>
                                @if($answer->is_correct)
                                    <span class="status-badge status-correct">
                                        <i class="fas fa-check"></i>
                                        Benar
                                    </span>
                                @else
                                    <span class="status-badge status-incorrect">
                                        <i class="fas fa-times"></i>
                                        Salah
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-clipboard-question"></i>
                </div>
                <div class="empty-title">Tidak Ada Jawaban</div>
                <div class="empty-subtitle">Jawaban untuk quiz ini tidak tersedia atau belum disubmit.</div>
            </div> --}}
        @endif
    </div>

@empty
    <div class="answers-section">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="empty-title">Hasil Quiz Tidak Ditemukan</div>
            <div class="empty-subtitle">Hasil quiz yang Anda cari tidak dapat ditemukan dalam sistem.</div>
        </div>
    </div>
@endforelse

<div class="mt-4">
    <a href="{{ route('admin.results.index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Hasil
    </a>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations for table rows
        const tableRows = document.querySelectorAll('.answers-table tbody tr');
        tableRows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                row.style.transition = 'all 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add click animation to back button
        const backButton = document.querySelector('.back-button');
        if (backButton) {
            backButton.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px)';
                }, 150);
            });
        }

        // Add tooltip for score display
        const scoreDisplay = document.querySelector('.score-display');
        if (scoreDisplay) {
            const score = parseInt(scoreDisplay.textContent);
            let message = '';
            
            if (score >= 80) {
                message = 'Sangat Baik! 🏆';
            } else if (score >= 60) {
                message = 'Baik! 👍';
            } else {
                message = 'Perlu Perbaikan 📚';
            }
            
            scoreDisplay.setAttribute('title', message);
        }

        // Add progress bar animation
        const correctAnswers = document.querySelectorAll('.status-correct').length;
        const totalAnswers = document.querySelectorAll('.status-badge').length;
        
        if (totalAnswers > 0) {
            const progressPercentage = (correctAnswers / totalAnswers) * 100;
            console.log(`Progress: ${correctAnswers}/${totalAnswers} (${progressPercentage.toFixed(1)}%)`);
        }
    });
</script>
@endpush