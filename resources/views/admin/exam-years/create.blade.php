@extends('layouts.admin')

@section('content')
    <h1>Yeni İmtahan İli Əlavə Et</h1>
    <form action="{{ route('exam-years.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="year" class="form-label">İmtahan İli</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" required>
            @error('year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yadda Saxla</button>
        <a href="{{ route('exam-years.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
