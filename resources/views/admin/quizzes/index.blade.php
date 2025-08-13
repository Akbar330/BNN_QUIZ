<!-- resources/views/admin/quizzes/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Quiz')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-list"></i> Kelola Quiz</h2>
            <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Quiz Baru
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($quizzes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Target Role</th>
                                    <th>Waktu</th>
                                    <th>Soal</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                <tr>
                                    <td>
                                        <strong>{{ $quiz->title }}</strong>
                                        @if($quiz->description)
                                            <br><small class="text-muted">{{ Str::limit($quiz->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $quiz->target_role === 'pelajar' ? 'primary' : 'success' }}">
                                            {{ ucfirst($quiz->target_role) }}
                                        </span>
                                    </td>
                                    <td>{{ $quiz->time_limit }} menit</td>
                                    <td>{{ $quiz->questions_count }} soal</td>
                                    <td>
                                        <span class="badge bg-{{ $quiz->is_active ? 'success' : 'danger' }}">
                                            {{ $quiz->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>{{ $quiz->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.quiz.questions', $quiz) }}" class="btn btn-sm btn-outline-secondary" title="Kelola Soal">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.quiz.edit', $quiz) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.quiz.destroy', $quiz) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
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
                    
                    {{ $quizzes->links() }}
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5>Belum ada quiz</h5>
                        <p class="text-muted">Mulai dengan membuat quiz pertama Anda</p>
                        <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Buat Quiz Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection