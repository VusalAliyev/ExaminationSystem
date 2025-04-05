@extends('layouts.admin')

@section('content')
    <h1>Sınav Konusu Düzenle</h1>
    <form action="{{ route('exam-subjects.update', $examSubject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Name" class="form-label">Konu Adı</label>
            <input type="text" name="Name" id="Name" class="form-control" value="{{ $examSubject->Name }}" required>
            @error('Name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-subjects.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
