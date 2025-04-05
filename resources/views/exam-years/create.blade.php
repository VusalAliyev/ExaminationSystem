@extends('layouts.admin')

@section('content')
    <h1>Yeni Sınav Yılı Ekle</h1>
    <form action="{{ route('exam-years.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Year" class="form-label">Sınav Yılı</label>
            <input type="number" name="Year" id="Year" class="form-control" value="{{ old('Year') }}" required>
            @error('Year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-years.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
