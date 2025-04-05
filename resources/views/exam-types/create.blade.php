@extends('layouts.admin')

@section('content')
    <h1>Yeni Sınav Türü Ekle</h1>
    <form action="{{ route('exam-types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Type" class="form-label">Sınav Türü</label>
            <input type="text" name="Type" id="Type" class="form-control" value="{{ old('Type') }}" required>
            @error('Type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-types.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
