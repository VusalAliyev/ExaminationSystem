@extends('layouts.admin')

@section('content')
    <h1>Yeni Sınav Grubu Ekle</h1>
    <form action="{{ route('exam-groups.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="GroupNumber" class="form-label">Grup Numarası</label>
            <input type="text" name="GroupNumber" id="GroupNumber" class="form-control" value="{{ old('GroupNumber') }}" required>
            @error('GroupNumber')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
