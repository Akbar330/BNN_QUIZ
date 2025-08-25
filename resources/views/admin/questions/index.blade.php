<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Soal: ' . $quiz->title)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: var(--bnn-blue-dark);">
                    <i class="fas fa-question-circle me-2" style="color: var(--bnn-blue-light);"></i> 
                    Kelola Soal
                </h2>
                <p class="text-muted mb-0">Quiz: <strong style="color: var(--bnn-blue-dark);">{{ $quiz->title }}</strong></p>
            </div>
            <div>
                <a href="{{ route('admin.quizzes') }}" 
                   class="btn btn-secondary me-2 px-3 py-2" 
                   style="border-radius: 12px; font-weight: 500; transition: all 0.3s ease; background: var(--bnn-gray-light); border: 2px solid var(--bnn-gray-light); color: var(--bnn-gray-dark);"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Quiz
                </a>
                <a href="{{ route('admin.question.create', $quiz) }}" 
                   class="btn btn-primary px-3 py-2" 
                   style="border-radius: 12px; font-weight: 600; background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark)); border: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.2)'">
                    <i class="fas fa-plus me-1"></i> Tambah Soal
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="alert" style="background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.1) 100%); border: none; border-radius: 16px; border-left: 5px solid var(--bnn-blue-light); box-shadow: 0 8px 32px rgba(59, 130, 246, 0.1); padding: 1.5rem;">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-2" style="color: var(--bnn-blue-light); font-size: 1.2rem;"></i>
                <div>
                    <strong style="color: var(--bnn-blue-dark);">Info Quiz:</strong> 
                    <span style="color: var(--bnn-gray-dark);">
                        {{ $quiz->title }} - 
                        Target: {{ ucfirst($quiz->target_role) }} - 
                        Waktu: {{ $quiz->time_limit }} menit -
                        Total Soal: {{ $questions->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="card-body" style="padding: 2rem;">
                @if($questions->count() > 0)
                    @foreach($questions as $index => $question)
                        <div class="card mb-4 border-0 shadow-sm" style="border-radius: 16px; border-left: 5px solid var(--bnn-blue-light) !important; overflow: hidden; transition: all 0.3s ease;"
                             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 32px rgba(59, 130, 246, 0.15)'"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 16px rgba(0, 0, 0, 0.1)'">
                            <div class="card-header" style="background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-blue-soft) 100%); border-bottom: 2px solid var(--bnn-blue-soft); padding: 1.25rem;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-semibold" style="color: var(--bnn-blue-dark); font-size: 1.1rem;">
                                        <i class="fas fa-list-ol me-2" style="color: var(--bnn-blue-light);"></i>
                                        Soal {{ $question->order }}
                                    </h6>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.question.edit', [$quiz, $question]) }}" 
                                           class="btn btn-sm px-3 py-2" 
                                           style="border-radius: 8px; font-weight: 500; background: var(--bnn-yellow-light); color: var(--bnn-yellow); border: 2px solid var(--bnn-yellow); transition: all 0.3s ease;"
                                           onmouseover="this.style.background='var(--bnn-yellow)'; this.style.color='white'; this.style.transform='translateY(-1px)'"
                                           onmouseout="this.style.background='var(--bnn-yellow-light)'; this.style.color='var(--bnn-yellow)'; this.style.transform='translateY(0)'">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.question.destroy', [$quiz, $question]) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm px-3 py-2 ms-2" 
                                                    style="border-radius: 8px; font-weight: 500; background: rgba(239, 68, 68, 0.1); color: var(--bnn-danger); border: 2px solid var(--bnn-danger); transition: all 0.3s ease;"
                                                    onmouseover="this.style.background='var(--bnn-danger)'; this.style.color='white'; this.style.transform='translateY(-1px)'"
                                                    onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='var(--bnn-danger)'; this.style.transform='translateY(0)'">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body" style="padding: 2rem;">
                                <h6 class="mb-4 fw-semibold" style="color: var(--bnn-gray-dark); font-size: 1.1rem; line-height: 1.6;">
                                    {{ $question->question }}
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong class="d-block mb-3" style="color: var(--bnn-blue-dark); font-size: 1rem;">
                                                <i class="fas fa-list-ul me-2" style="color: var(--bnn-blue-light);"></i>
                                                Pilihan Jawaban:
                                            </strong>
                                            <div class="mt-2">
                                                @foreach(['a', 'b', 'c', 'd'] as $option)
                                                    <div class="p-3 mb-2 position-relative" 
                                                         style="border-radius: 12px; transition: all 0.3s ease; {{ $question->correct_answer === $option ? 'background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%); border: 2px solid var(--bnn-success);' : 'background: var(--bnn-gray-light); border: 2px solid transparent;' }}">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <strong style="color: var(--bnn-blue-dark); margin-right: 0.5rem; font-size: 1rem;">
                                                                    {{ strtoupper($option) }}.
                                                                </strong>
                                                                <span style="color: var(--bnn-gray-dark);">{{ $question->{'option_' . $option} }}</span>
                                                            </div>
                                                            @if($question->correct_answer === $option)
                                                                <div class="badge" style="background: var(--bnn-success); color: white; border-radius: 20px; padding: 4px 8px;">
                                                                    <i class="fas fa-check"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong class="d-block mb-3" style="color: var(--bnn-blue-dark); font-size: 1rem;">
                                                <i class="fas fa-lightbulb me-2" style="color: var(--bnn-yellow);"></i>
                                                Penjelasan:
                                            </strong>
                                            <div class="p-3 mt-2" style="background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.08) 100%); border-radius: 12px; border: 2px solid var(--bnn-blue-soft);">
                                                <p class="mb-0" style="color: var(--bnn-gray-dark); line-height: 1.6;">
                                                    {{ $question->explanation }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <div class="mb-4" style="opacity: 0.7;">
                            <i class="fas fa-question-circle fa-5x" style="color: var(--bnn-blue-light);"></i>
                        </div>
                        <h5 class="mb-3" style="color: var(--bnn-blue-dark); font-weight: 600;">Belum ada soal</h5>
                        <p class="text-muted mb-4" style="font-size: 1.1rem;">Tambahkan soal pertama untuk quiz ini</p>
                        <a href="{{ route('admin.question.create', $quiz) }}" 
                           class="btn btn-primary px-4 py-3" 
                           style="border-radius: 12px; font-weight: 600; font-size: 1.1rem; background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark)); border: none; transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);"
                           onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.4)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.3)'">
                            <i class="fas fa-plus me-2"></i> Tambah Soal Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection