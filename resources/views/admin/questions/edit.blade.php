@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Question</h2>
    <form action="{{ route('admin.question.update', ['quiz' => $quiz->id, 'question' => $question->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question" value="{{ old('question', $question->question) }}" required>
        </div>
        <div class="mb-3">
            <label for="option_a" class="form-label">Option A</label>
            <input type="text" class="form-control" id="option_a" name="option_a" value="{{ old('option_a', $question->option_a) }}" required>
        </div>
        <div class="mb-3">
            <label for="option_b" class="form-label">Option B</label>
            <input type="text" class="form-control" id="option_b" name="option_b" value="{{ old('option_b', $question->option_b) }}" required>
        </div>
        <div class="mb-3">
            <label for="option_c" class="form-label">Option C</label>
            <input type="text" class="form-control" id="option_c" name="option_c" value="{{ old('option_c', $question->option_c) }}" required>
        </div>
        <div class="mb-3">
            <label for="option_d" class="form-label">Option D</label>
            <input type="text" class="form-control" id="option_d" name="option_d" value="{{ old('option_d', $question->option_d) }}" required>
        </div>
        <div class="mb-3">
            <label for="correct_answer" class="form-label">Correct Answer</label>
            <select class="form-select" id="correct_answer" name="correct_answer" required>
                <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>
@endsection