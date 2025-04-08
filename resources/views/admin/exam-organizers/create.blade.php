@extends('layouts.admin')

@section('content')
    <h1>Yeni Təşkilatçı Əlavə Et</h1>
    <form action="{{ route('exam-organizers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Təşkilatçı Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yadda Saxla</button>
        <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
