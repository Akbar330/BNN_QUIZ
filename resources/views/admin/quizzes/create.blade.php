@extends('layouts.app')

@section('title', 'Buat Quiz Baru')

@push('styles')
<style>
    .create-header {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(30, 58, 138, 0.15);
    }

    .create-header::before {
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

    .create-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .form-container {
        background: var(--bnn-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-header {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.05) 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.1);
    }

    .form-header h2 {
        margin: 0;
        color: var(--bnn-blue-dark);
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
        border-color: var(--bnn-blue-light);
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.1);
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
        color: var(--bnn-blue-light);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid var(--bnn-blue-soft);
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

    .btn-submit {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2);
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3);
        background: linear-gradient(135deg, var(--bnn-blue-dark), var(--bnn-blue-light));
    }

    .btn-submit:disabled {
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
        color: var(--bnn-blue-light);
        z-index: 10;
    }

    .input-icon .form-control,
    .input-icon .form-select {
        padding-left: 3rem;
    }

    @media (max-width: 768px) {
        .create-header {
            padding: 1.5rem;
            text-align: center;
        }

        .create-header h1 {
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
        .btn-submit {
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
<div class="create-header">
    <h1><i class="fas fa-plus-circle"></i>Buat Quiz Baru</h1>
</div>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i>Form Pembuatan Quiz</h2>
    </div>
    
    <div class="form-content">
        <form method="POST" action="{{ route('admin.quiz.store') }}">
            @csrf
            
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
                           value="{{ old('title') }}" 
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
                          placeholder="Jelaskan tujuan dan materi quiz ini...">{{ old('description') }}</textarea>
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
                            <option value="pelajar" {{ old('target_role') === 'pelajar' ? 'selected' : '' }}>
                                👨‍🎓 Pelajar
                            </option>
                            <option value="masyarakat" {{ old('target_role') === 'masyarakat' ? 'selected' : '' }}>
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
                               value="{{ old('time_limit', 30) }}" 
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
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    Simpan Quiz
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
        const submitBtn = document.querySelector('.btn-submit');
        
        form.addEventListener('submit', function(e) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
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

        // Auto-focus first input
        titleInput.focus();

        // Character counter for title
        titleInput.addEventListener('input', function() {
            const maxLength = 100;
            const currentLength = this.value.length;
            
            let counter = this.parentNode.parentNode.querySelector('.char-counter');
            if (!counter) {
                counter = document.createElement('div');
                counter.className = 'char-counter';
                counter.style.cssText = 'font-size: 0.8rem; color: #6b7280; text-align: right; margin-top: 0.25rem;';
                this.parentNode.parentNode.appendChild(counter);
            }
            
            counter.textContent = `${currentLength}/${maxLength} karakter`;
            
            if (currentLength > maxLength) {
                counter.style.color = 'var(--bnn-danger)';
                this.style.borderColor = 'var(--bnn-danger)';
            } else {
                counter.style.color = '#6b7280';
                this.style.borderColor = '#e5e7eb';
            }
        });
    });
</script>
@endpush