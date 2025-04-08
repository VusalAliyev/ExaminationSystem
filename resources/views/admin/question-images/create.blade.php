@extends('layouts.admin')

@section('title', 'Yeni Sual Şəkli Əlavə Et')

@section('content')
    <h1>Yeni Sual Şəkli Əlavə Et</h1>
    <form action="{{ route('question-images.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="image_path" class="form-label">Şəkil Yolu</label>
            <input type="text" name="image_path" id="image_path" class="form-control" value="{{ old('image_path') }}"
                   required>
            @error('image_path')
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
        <a href="{{ route('question-images.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
