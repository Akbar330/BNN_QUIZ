@extends('layouts.app')

@section('title', 'Quiz Results')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Quiz Results</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Quiz Title</th>
                <th>Score</th>
                <th>Date Taken</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attempts as $attempt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attempt->user->name }}</td>
                    <td>{{ $attempt->quiz->title }}</td>
                    <td>{{ $attempt->score }}</td>
                    <td>{{ $attempt->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.results.show', $attempt->id) }}" class="btn btn-info btn-sm">View</a>
                        <form action="{{ route('admin.results.destroy', $attempt->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No results found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $attempts->links() }}
</div>
@endsection