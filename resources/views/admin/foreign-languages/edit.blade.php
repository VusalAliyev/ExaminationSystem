@extends('layouts.admin')

@section('content')
    <h1>Xarici Dil Redaktə Et</h1>
    <form action="{{ route('foreign-languages.update', $foreignLanguage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Xarici Dil Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $foreignLanguage->name }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('foreign-languages.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
