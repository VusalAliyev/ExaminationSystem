<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Cevap Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
