@extends('layouts.admin')

@section('content')
    <h1>Sınav Yılı Düzenle</h1>
    <form action="{{ route('exam-years.update', $examYear->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Year" class="form-label">Sınav Yılı</label>
            <input type="number" name="Year" id="Year" class="form-control" value="{{ $examYear->Year }}" required>
            @error('Year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-years.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
