<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>
        <hr>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Quiz</h5>
                        <h3>{{ $quizzes->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-list fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Attempts</h5>
                        <h3>{{ $totalAttempts }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Questions</h5>
                        <h3>{{ $quizzes->sum('questions_count') }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-question fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5><i class="fas fa-list"></i> Quiz Terbaru</h5>
                <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Buat Quiz Baru
                </a>
            </div>
            <div class="card-body">
                @if($quizzes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Target</th>
                                    <th>Jumlah Soal</th>
                                    <th>Total Attempts</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes->take(10) as $quiz)
                                <tr>
                                    <td>{{ $quiz->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ $quiz->target_role === 'pelajar' ? 'primary' : 'success' }}">
                                            {{ ucfirst($quiz->target_role) }}
                                        </span>
                                    </td>
                                    <td>{{ $quiz->questions_count }}</td>
                                    <td>{{ $quiz->attempts_count }}</td>
                                    <td>
                                        <span class="badge bg-{{ $quiz->is_active ? 'success' : 'danger' }}">
                                            {{ $quiz->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.quiz.questions', $quiz) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada quiz. <a href="{{ route('admin.quiz.create') }}">Buat quiz pertama</a></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection