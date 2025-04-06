@extends('layouts.admin')

@section('content')
    <h1>Yeni Cevap Ekle</h1>
    <form action="{{ route('exam-answers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="AnswerContent" class="form-label">Cevap İçeriği</label>
            <textarea name="AnswerContent" id="AnswerContent" class="form-control" required>{{ old('AnswerContent') }}</textarea>
            @error('AnswerContent')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="State" class="form-label">Durum</label>
            <select name="State" id="State" class="form-control" required>
                <option value="">Seçiniz</option>
                <option value="Correct" {{ old('State') == 'Correct' ? 'selected' : '' }}>Doğru</option>
                <option value="Incorrect" {{ old('State') == 'Incorrect' ? 'selected' : '' }}>Yanlış</option>
            </select>
            @error('State')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamQuestionID" class="form-label">Soru</label>
            <select name="ExamQuestionID" id="ExamQuestionID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($questions as $question)
                    <option value="{{ $question->id }}" {{ old('ExamQuestionID') == $question->id ? 'selected' : '' }}>{{ Str::limit($question->QuestionContent, 50) }}</option>
                @endforeach
            </select>
            @error('ExamQuestionID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-answers.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
