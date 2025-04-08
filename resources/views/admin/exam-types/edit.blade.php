@extends('layouts.admin')

@section('content')
    <h1>Sınav Türü Düzenle</h1>
    <form action="{{ route('exam-types.update', $examType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="type" class="form-label">Sınav Türü</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $examType->type }}" required>
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-types.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
