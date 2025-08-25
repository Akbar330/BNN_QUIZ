<!-- resources/views/admin/questions/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Soal')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header" style="background: linear-gradient(135deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%); border: none; padding: 1.5rem;">
                <h5 class="text-white mb-1"><i class="fas fa-edit me-2"></i> Edit Soal</h5>
                <p class="text-white mb-0 opacity-75">Quiz: <strong>{{ $quiz->title }}</strong></p>
            </div>
            <div class="card-body" style="padding: 2rem;">
                <form method="POST" action="{{ route('admin.question.update', [$quiz, $question]) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Pertanyaan *</label>
                        <textarea name="question" class="form-control @error('question') is-invalid @enderror" 
                                  rows="3" required placeholder="Tulis pertanyaan di sini..."
                                  style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                  onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                  onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">{{ old('question', $question->question) }}</textarea>
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Pilihan A *</label>
                                <input type="text" name="option_a" class="form-control @error('option_a') is-invalid @enderror" 
                                       value="{{ old('option_a', $question->option_a) }}" required placeholder="Pilihan A"
                                       style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                       onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">
                                @error('option_a')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Pilihan B *</label>
                                <input type="text" name="option_b" class="form-control @error('option_b') is-invalid @enderror" 
                                       value="{{ old('option_b', $question->option_b) }}" required placeholder="Pilihan B"
                                       style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                       onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">
                                @error('option_b')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Pilihan C *</label>
                                <input type="text" name="option_c" class="form-control @error('option_c') is-invalid @enderror" 
                                       value="{{ old('option_c', $question->option_c) }}" required placeholder="Pilihan C"
                                       style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                       onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">
                                @error('option_c')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Pilihan D *</label>
                                <input type="text" name="option_d" class="form-control @error('option_d') is-invalid @enderror" 
                                       value="{{ old('option_d', $question->option_d) }}" required placeholder="Pilihan D"
                                       style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                       onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">
                                @error('option_d')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Jawaban Benar *</label>
                        <select name="correct_answer" class="form-select @error('correct_answer') is-invalid @enderror" required
                                style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">
                            <option value="">Pilih Jawaban Benar</option>
                            <option value="a" {{ old('correct_answer', $question->correct_answer) === 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ old('correct_answer', $question->correct_answer) === 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ old('correct_answer', $question->correct_answer) === 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ old('correct_answer', $question->correct_answer) === 'd' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('correct_answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Penjelasan *</label>
                        <textarea name="explanation" class="form-control @error('explanation') is-invalid @enderror" 
                                  rows="3" required placeholder="Berikan penjelasan mengapa jawaban tersebut benar..."
                                  style="border-radius: 12px; border: 2px solid var(--bnn-blue-soft); transition: all 0.3s ease;"
                                  onfocus="this.style.borderColor='var(--bnn-blue-light)'; this.style.boxShadow='0 0 0 0.2rem rgba(59, 130, 246, 0.1)'"
                                  onblur="this.style.borderColor='var(--bnn-blue-soft)'; this.style.boxShadow='none'">{{ old('explanation', $question->explanation) }}</textarea>
                        @error('explanation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text" style="color: var(--bnn-blue-light); font-weight: 500;">
                            <i class="fas fa-info-circle me-1"></i>
                            Penjelasan akan ditampilkan setelah peserta menyelesaikan quiz
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between pt-3" style="border-top: 1px solid var(--bnn-blue-soft);">
                        <a href="{{ route('admin.quiz.questions', $quiz) }}" class="btn btn-secondary px-4 py-2" 
                           style="border-radius: 12px; font-weight: 500; transition: all 0.3s ease; background: var(--bnn-gray-light); border: 2px solid var(--bnn-gray-light); color: var(--bnn-gray-dark);"
                           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2" 
                                style="border-radius: 12px; font-weight: 600; background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark)); border: none; transition: all 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.2)'">
                            <i class="fas fa-save me-2"></i> Update Soal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection