@extends('layouts.admin')

@section('content')
    <h1>Sual Redaktə Et</h1>
    <form action="{{ route('exam-questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="question_content" class="form-label">Sual Məzmunu</label>
            <textarea name="question_content" id="question_content" class="form-control" required>{{ $question->question_content }}</textarea>
            @error('question_content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="point" class="form-label">Xal</label>
            <input type="number" name="point" id="point" class="form-control" value="{{ $question->point }}" required>
            @error('point')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_subject_id" class="form-label">Mövzu</label>
            <select name="exam_subject_id" id="exam_subject_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $question->exam_subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('exam_subject_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_id" class="form-label">İmtahan</label>
            <select name="exam_id" id="exam_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($exams as $exam)
                    <option value="{{ $exam->id }}" {{ $question->exam_id == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                @endforeach
            </select>
            @error('exam_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('exam-questions.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
