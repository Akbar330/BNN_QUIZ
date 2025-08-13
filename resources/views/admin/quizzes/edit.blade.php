<!-- resources/views/admin/quizzes/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Quiz')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-edit"></i> Edit Quiz</h5>
            </div>
            <div class="card-body">
                <!-- Perhatikan: action harus mengirimkan ID quiz -->
                <form method="POST" action="{{ route('admin.quiz.update', $quiz->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul Quiz *</label>
                        <input type="text" 
                               name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $quiz->title) }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="3">{{ old('description', $quiz->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Target Role *</label>
                                <select name="target_role" 
                                        class="form-select @error('target_role') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Target Role</option>
                                    <option value="pelajar" {{ old('target_role', $quiz->target_role) === 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                                    <option value="masyarakat" {{ old('target_role', $quiz->target_role) === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                                </select>
                                @error('target_role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Batas Waktu (Menit) *</label>
                                <input type="number" 
                                       name="time_limit" 
                                       class="form-control @error('time_limit') is-invalid @enderror" 
                                       value="{{ old('time_limit', $quiz->time_limit) }}" 
                                       min="5" 
                                       max="180" 
                                       required>
                                @error('time_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.quizzes') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
