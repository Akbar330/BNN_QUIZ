@extends('layouts.app')

@section('title', 'Detail Hasil Quiz')

@section('content')
<div class="container mt-4">
    <h2>Detail Hasil Quiz</h2>
    @forelse($attempts as $result)
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Nama Peserta: {{ $result->user->name }}</h5>
                <p class="card-text">Quiz: {{ $result->quiz->title }}</p>
                <p class="card-text">Nilai: {{ $result->score }}</p>
                <p class="card-text">Tanggal: {{ $result->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <h4 class="mt-4">Jawaban Peserta</h4>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban Peserta</th>
                    <th>Jawaban Benar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result->answers ?? [] as $index => $answer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $answer->question->question }}</td>
                    <td>{{ $answer->answer_text }}</td>
                    <td>{{ $answer->question->correct_answer }}</td>
                    <td>
                        @if($answer->is_correct)
                            <span class="badge bg-success">Benar</span>
                        @else
                            <span class="badge bg-danger">Salah</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <div class="alert alert-warning mt-3">Tidak ada hasil quiz yang ditemukan.</div>
    @endforelse

    <a href="{{ route('admin.results.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection