@extends('layouts.admin')

@section('content')
    <h1>Yeni Sınav Türü Ekle</h1>
    <form action="{{ route('exam-types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Sınav Türü</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required>
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-types.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
