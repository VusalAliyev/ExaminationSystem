<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Cevap Resmi Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Yeni Cevap Resmi Ekle</h1>
    <form action="{{ route('answer-images.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ImagePath" class="form-label">Resim Yolu</label>
            <input type="text" name="ImagePath" id="ImagePath" class="form-control" value="{{ old('ImagePath') }}" required>
            @error('ImagePath')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamAnswerID" class="form-label">Cevap</label>
            <select name="ExamAnswerID" id="ExamAnswerID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($answers as $answer)
                    <option value="{{ $answer->id }}" {{ old('ExamAnswerID') == $answer->id ? 'selected' : '' }}>{{ Str::limit($answer->AnswerContent, 50) }}</option>
                @endforeach
            </select>
            @error('ExamAnswerID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('answer-images.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
