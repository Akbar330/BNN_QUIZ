<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Soal: ' . $quiz->title)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="fas fa-question"></i> Kelola Soal</h2>
                <p class="text-muted">Quiz: <strong>{{ $quiz->title }}</strong></p>
            </div>
            <div>
                <a href="{{ route('admin.quizzes') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Quiz
                </a>
                <a href="{{ route('admin.question.create', $quiz) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Soal
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>Info Quiz:</strong> {{ $quiz->title }} - 
            Target: {{ ucfirst($quiz->target_role) }} - 
            Waktu: {{ $quiz->time_limit }} menit -
            Total Soal: {{ $questions->count() }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($questions->count() > 0)
                    @foreach($questions as $index => $question)
                        <div class="card mb-3 border-start border-primary border-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Soal {{ $question->order }}</h6>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.question.edit', [$quiz, $question]) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.question.destroy', [$quiz, $question]) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h6 class="mb-3">{{ $question->question }}</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Pilihan Jawaban:</strong>
                                        <div class="mt-2">
                                            @foreach(['a', 'b', 'c', 'd'] as $option)
                                                <div class="p-2 mb-1 rounded {{ $question->correct_answer === $option ? 'bg-success bg-opacity-10 border border-success' : 'bg-light' }}">
                                                    <strong>{{ strtoupper($option) }}.</strong> {{ $question->{'option_' . $option} }}
                                                    @if($question->correct_answer === $option)
                                                        <i class="fas fa-check text-success float-end"></i>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <strong>Penjelasan:</strong>
                                        <div class="p-3 bg-light rounded mt-2">
                                            {{ $question->explanation }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                        <h5>Belum ada soal</h5>
                        <p class="text-muted">Tambahkan soal pertama untuk quiz ini</p>
                        <a href="{{ route('admin.question.create', $quiz) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Soal Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection