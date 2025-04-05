@extends('layouts.admin')

@section('content')
    <h1>Soru Düzenle</h1>
    <form action="{{ route('exam-questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="QuestionContent" class="form-label">Soru İçeriği</label>
            <textarea name="QuestionContent" id="QuestionContent" class="form-control" required>{{ $question->QuestionContent }}</textarea>
            @error('QuestionContent')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="Point" class="form-label">Puan</label>
            <input type="number" name="Point" id="Point" class="form-control" value="{{ $question->Point }}" required>
            @error('Point')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamSubjectID" class="form-label">Konu</label>
            <select name="ExamSubjectID" id="ExamSubjectID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $question->ExamSubjectID == $subject->id ? 'selected' : '' }}>{{ $subject->Name }}</option>
                @endforeach
            </select>
            @error('ExamSubjectID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamID" class="form-label">Sınav</label>
            <select name="ExamID" id="ExamID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($exams as $exam)
                    <option value="{{ $exam->id }}" {{ $question->ExamID == $exam->id ? 'selected' : '' }}>{{ $exam->Name }}</option>
                @endforeach
            </select>
            @error('ExamID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-questions.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
