<!-- resources/views/admin/questions/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Soal Baru')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-plus"></i> Tambah Soal Baru</h5>
                <p class="text-muted mb-0">Quiz: <strong>{{ $quiz->title }}</strong></p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.question.store', $quiz) }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Pertanyaan *</label>
                        <textarea name="question" class="form-control @error('question') is-invalid @enderror" 
                                  rows="3" required placeholder="Tulis pertanyaan di sini...">{{ old('question') }}</textarea>
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pilihan A *</label>
                                <input type="text" name="option_a" class="form-control @error('option_a') is-invalid @enderror" 
                                       value="{{ old('option_a') }}" required placeholder="Pilihan A">
                                @error('option_a')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pilihan B *</label>
                                <input type="text" name="option_b" class="form-control @error('option_b') is-invalid @enderror" 
                                       value="{{ old('option_b') }}" required placeholder="Pilihan B">
                                @error('option_b')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pilihan C *</label>
                                <input type="text" name="option_c" class="form-control @error('option_c') is-invalid @enderror" 
                                       value="{{ old('option_c') }}" required placeholder="Pilihan C">
                                @error('option_c')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pilihan D *</label>
                                <input type="text" name="option_d" class="form-control @error('option_d') is-invalid @enderror" 
                                       value="{{ old('option_d') }}" required placeholder="Pilihan D">
                                @error('option_d')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Jawaban Benar *</label>
                        <select name="correct_answer" class="form-select @error('correct_answer') is-invalid @enderror" required>
                            <option value="">Pilih Jawaban Benar</option>
                            <option value="a" {{ old('correct_answer') === 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ old('correct_answer') === 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ old('correct_answer') === 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ old('correct_answer') === 'd' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('correct_answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Penjelasan *</label>
                        <textarea name="explanation" class="form-control @error('explanation') is-invalid @enderror" 
                                  rows="3" required placeholder="Berikan penjelasan mengapa jawaban tersebut benar...">{{ old('explanation') }}</textarea>
                        @error('explanation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Penjelasan akan ditampilkan setelah peserta menyelesaikan quiz</div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.quiz.questions', $quiz) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Soal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection