@extends('layouts.admin')

@section('content')
    <h1>Yeni Cavab Əlavə Et</h1>
    <form action="{{ route('exam-answers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="answer_content" class="form-label">Cavab Məzmunu</label>
            <textarea name="answer_content" id="answer_content" class="form-control" required>{{ old('answer_content') }}</textarea>
            @error('answer_content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">Vəziyyət</label>
            <select name="state" id="state" class="form-control" required>
                <option value="">Seçin</option>
                <option value="Correct" {{ old('state') == 'Correct' ? 'selected' : '' }}>Doğru</option>
                <option value="Incorrect" {{ old('state') == 'Incorrect' ? 'selected' : '' }}>Yanlış</option>
            </select>
            @error('state')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_question_id" class="form-label">Sual</label>
            <select name="exam_question_id" id="exam_question_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($questions as $question)
                    <option value="{{ $question->id }}" {{ old('exam_question_id') == $question->id ? 'selected' : '' }}>{{ Str::limit($question->question_content, 50) }}</option>
                @endforeach
            </select>
            @error('exam_question_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yadda Saxla</button>
        <a href="{{ route('exam-answers.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
