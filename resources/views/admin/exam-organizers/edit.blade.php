@extends('layouts.admin')

@section('content')
    <h1>Təşkilatçı Redaktə Et</h1>
    <form action="{{ route('exam-organizers.update', $examOrganizer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Təşkilatçı Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $examOrganizer->name }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
