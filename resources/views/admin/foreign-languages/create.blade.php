@extends('layouts.admin')

@section('content')
    <h1>Yeni Xarici Dil Əlavə Et</h1>
    <form action="{{ route('foreign-languages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Xarici Dil Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yadda Saxla</button>
        <a href="{{ route('foreign-languages.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
