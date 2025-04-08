@extends('layouts.admin')

@section('content')
    <h1>Sektor Redaktə Et</h1>
    <form action="{{ route('sectors.update', $sector->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="sector_name" class="form-label">Sektor Adı</label>
            <input type="text" name="sector_name" id="sector_name" class="form-control" value="{{ $sector->sector_name }}" required>
            @error('sector_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
