@extends('layouts.app')

@section('title', 'Edit Quiz')

@push('styles')
<style>
    .edit-header {
        background: linear-gradient(135deg, var(--bnn-yellow) 0%, #f59e0b 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(251, 191, 36, 0.15);
    }

    .edit-header::before {
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

    .edit-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .edit-header .quiz-info {
        margin-top: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        font-size: 0.95rem;
    }

    .form-container {
        background: var(--bnn-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(251, 191, 36, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-header {
        background: linear-gradient(135deg, var(--bnn-yellow-light) 0%, rgba(251, 191, 36, 0.05) 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid rgba(251, 191, 36, 0.1);
    }

    .form-header h2 {
        margin: 0;
        color: #92400e;
        font-weight: 600;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-content {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--bnn-blue-dark);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .form-label .required {
        color: var(--bnn-danger);
    }

    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        font-weight: 500;
        color: var(--bnn-gray-dark);
        transition: all 0.3s ease;
        background: var(--bnn-white);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--bnn-yellow);
        box-shadow: 0 0 0 0.2rem rgba(251, 191, 36, 0.1);
        background: var(--bnn-white);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--bnn-danger);
        box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        color: var(--bnn-danger);
        font-weight: 500;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .invalid-feedback::before {
        content: '⚠';
        font-size: 1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .form-help {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-help i {
        color: var(--bnn-yellow);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid var(--bnn-yellow-light);
    }

    .btn-back {
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

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(55, 65, 81, 0.3);
        color: white;
        background: linear-gradient(135deg, #4b5563, var(--bnn-gray-dark));
    }

    .btn-update {
        background: linear-gradient(135deg, var(--bnn-yellow), #f59e0b);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.2);
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(251, 191, 36, 0.3);
        background: linear-gradient(135deg, #f59e0b, var(--bnn-yellow));
    }

    .btn-update:disabled {
        opacity: 0.6;
        transform: none;
        cursor: not-allowed;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bnn-yellow);
        z-index: 10;
    }

    .input-icon .form-control,
    .input-icon .form-select {
        padding-left: 3rem;
    }

    .edit-badge {
        background: linear-gradient(135deg, #f59e0b, var(--bnn-yellow));
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 1rem;
    }

    @media (max-width: 768px) {
        .edit-header {
            padding: 1.5rem;
            text-align: center;
        }

        .edit-header h1 {
            font-size: 1.8rem;
            justify-content: center;
        }

        .form-content {
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-back,
        .btn-update {
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
<div class="edit-header">
    <h1>
        <i class="fas fa-edit"></i>
        Edit Quiz
        <span class="edit-badge">EDIT MODE</span>
    </h1>
    <div class="quiz-info">
        <strong>Sedang mengedit:</strong> {{ $quiz->title }}
        <br>
        <small>Dibuat: {{ $quiz->created_at->format('d F Y') }} | Terakhir diubah: {{ $quiz->updated_at->format('d F Y') }}</small>
    </div>
</div>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-pen-fancy"></i>Form Edit Quiz</h2>
    </div>
    
    <div class="form-content">
        <form method="POST" action="{{ route('admin.quiz.update', $quiz->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-heading"></i>
                    Judul Quiz <span class="required">*</span>
                </label>
                <div class="input-icon">
                    <i class="fas fa-book"></i>
                    <input type="text" 
                           name="title" 
                           class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title', $quiz->title) }}" 
                           placeholder="Masukkan judul quiz yang menarik"
                           required>
                </div>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">
                    <i class="fas fa-info-circle"></i>
                    Gunakan judul yang jelas dan menarik untuk peserta
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-align-left"></i>
                    Deskripsi Quiz
                </label>
                <textarea name="description" 
                          class="form-control @error('description') is-invalid @enderror" 
                          rows="4"
                          placeholder="Jelaskan tujuan dan materi quiz ini...">{{ old('description', $quiz->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">
                    <i class="fas fa-info-circle"></i>
                    Deskripsi membantu peserta memahami konten quiz
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-users"></i>
                        Target Peserta <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-user-friends"></i>
                        <select name="target_role" 
                                class="form-select @error('target_role') is-invalid @enderror" 
                                required>
                            <option value="">Pilih Target Peserta</option>
                            <option value="pelajar" {{ old('target_role', $quiz->target_role) === 'pelajar' ? 'selected' : '' }}>
                                👨‍🎓 Pelajar
                            </option>
                            <option value="masyarakat" {{ old('target_role', $quiz->target_role) === 'masyarakat' ? 'selected' : '' }}>
                                👥 Masyarakat Umum
                            </option>
                        </select>
                    </div>
                    @error('target_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-help">
                        <i class="fas fa-info-circle"></i>
                        Tentukan siapa yang dapat mengikuti quiz ini
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-clock"></i>
                        Batas Waktu <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-stopwatch"></i>
                        <input type="number" 
                               name="time_limit" 
                               class="form-control @error('time_limit') is-invalid @enderror" 
                               value="{{ old('time_limit', $quiz->time_limit) }}" 
                               min="5" 
                               max="180" 
                               placeholder="30"
                               required>
                    </div>
                    @error('time_limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-help">
                        <i class="fas fa-info-circle"></i>
                        Waktu dalam menit (5-180 menit)
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <a href="{{ route('admin.quizzes') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation enhancement
        const form = document.querySelector('form');
        const updateBtn = document.querySelector('.btn-update');
        
        form.addEventListener('submit', function(e) {
            updateBtn.disabled = true;
            updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });

        // Real-time validation
        const titleInput = document.querySelector('input[name="title"]');
        const timeLimitInput = document.querySelector('input[name="time_limit"]');
        
        titleInput.addEventListener('input', function() {
            if (this.value.length > 0 && this.value.length < 3) {
                this.setCustomValidity('Judul minimal 3 karakter');
            } else {
                this.setCustomValidity('');
            }
        });

        timeLimitInput.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 5) {
                this.setCustomValidity('Waktu minimal 5 menit');
            } else if (value > 180) {
                this.setCustomValidity('Waktu maksimal 180 menit');
            } else {
                this.setCustomValidity('');
            }
        });

        // Highlight changes
        const originalValues = {
            title: '{{ $quiz->title }}',
            description: '{{ $quiz->description }}',
            target_role: '{{ $quiz->target_role }}',
            time_limit: {{ $quiz->time_limit }}
        };

        function checkChanges() {
            let hasChanges = false;
            
            if (titleInput.value !== originalValues.title) hasChanges = true;
            if (document.querySelector('textarea[name="description"]').value !== originalValues.description) hasChanges = true;
            if (document.querySelector('select[name="target_role"]').value !== originalValues.target_role) hasChanges = true;
            if (parseInt(timeLimitInput.value) !== originalValues.time_limit) hasChanges = true;
            
            updateBtn.style.opacity = hasChanges ? '1' : '0.7';
            updateBtn.innerHTML = hasChanges ? '<i class="fas fa-save"></i> Simpan Perubahan' : '<i class="fas fa-check"></i> Tidak Ada Perubahan';
        }

        // Check for changes
        [titleInput, document.querySelector('textarea[name="description"]'), document.querySelector('select[name="target_role"]'), timeLimitInput].forEach(input => {
            input.addEventListener('input', checkChanges);
            input.addEventListener('change', checkChanges);
        });

        // Initial check
        checkChanges();
    });
</script>
@endpush