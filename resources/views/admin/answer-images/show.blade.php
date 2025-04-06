@extends('layouts.admin')

@section('content')
    <h1>Cevap Resmi Düzenle</h1>
    <form action="{{ route('answer-images.update', $image->id) }}" method="POST">
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
            <label for="ExamAnswerID" class="form-label">Cevap</label>
            <select name="ExamAnswerID" id="ExamAnswerID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($answers as $answer)
                    <option value="{{ $answer->id }}" {{ $image->ExamAnswerID == $answer->id ? 'selected' : '' }}>{{ Str::limit($answer->AnswerContent, 50) }}</option>
                @endforeach
            </select>
            @error('ExamAnswerID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('answer-images.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
