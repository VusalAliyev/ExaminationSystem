@extends('layouts.admin')

@section('content')
    <h1>İmtahan İli Redaktə Et</h1>
    <form action="{{ route('exam-years.update', $examYear->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="year" class="form-label">İmtahan İli</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ $examYear->year }}" required>
            @error('year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('exam-years.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
