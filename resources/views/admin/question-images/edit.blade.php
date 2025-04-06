@extends('layouts.admin')

@section('title', 'Soru Resimleri')

@section('content')
    <h1>Soru Resmi Düzenle</h1>
    <form action="{{ route('question-images.update', $image->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ImagePath" class="form-label">Resim Yolu</label>
            <input type="text" name="ImagePath" id="ImagePath" class="form-control" value="{{ $image->ImagePath }}" required>
            @error('ImagePath')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamQuestionID" class="form-label">Soru</label>
            <select name="ExamQuestionID" id="ExamQuestionID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($questions as $question)
                    <option value="{{ $question->id }}" {{ $image->ExamQuestionID == $question->id ? 'selected' : '' }}>{{ Str::limit($question->QuestionContent, 50) }}</option>
                @endforeach
            </select>
            @error('ExamQuestionID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('question-images.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
