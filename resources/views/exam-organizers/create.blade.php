@extends('layouts.admin')

@section('content')
    <h1>Yeni Organizatör Ekle</h1>
    <form action="{{ route('exam-organizers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Name" class="form-label">Organizatör Adı</label>
            <input type="text" name="Name" id="Name" class="form-control" value="{{ old('Name') }}" required>
            @error('Name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
