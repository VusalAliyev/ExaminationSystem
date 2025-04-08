@extends('layouts.admin')

@section('title', 'Yeni Cavab Şəkli Əlavə Et')

@section('content')
    <h1>Yeni Cavab Şəkli Əlavə Et</h1>
    <form action="{{ route('answer-images.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="image_path" class="form-label">Şəkil Yolu</label>
            <input type="text" name="image_path" id="image_path" class="form-control" value="{{ old('image_path') }}" required>
            @error('image_path')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_answer_id" class="form-label">Cavab</label>
            <select name="exam_answer_id" id="exam_answer_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($answers as $answer)
                    <option value="{{ $answer->id }}" {{ old('exam_answer_id') == $answer->id ? 'selected' : '' }}>{{ Str::limit($answer->answer_content, 50) }}</option>
                @endforeach
            </select>
            @error('exam_answer_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yadda Saxla</button>
        <a href="{{ route('answer-images.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
