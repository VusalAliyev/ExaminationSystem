@extends('layouts.admin')

@section('content')
    <h1>Sınav Grubu Düzenle</h1>
    <form action="{{ route('exam-groups.update', $examGroup->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="GroupNumber" class="form-label">Grup Numarası</label>
            <input type="text" name="GroupNumber" id="GroupNumber" class="form-control" value="{{ $examGroup->GroupNumber }}" required>
            @error('GroupNumber')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
