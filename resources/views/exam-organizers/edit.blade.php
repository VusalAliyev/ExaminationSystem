@extends('layouts.admin')

@section('content')
    <h1>İmtahan Təşkilatçıları Modifikasiyası</h1>
    <form action="{{ route('exam-organizers.update', $examOrganizer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Name" class="form-label">Organizatör Adı</label>
            <input type="text" name="Name" id="Name" class="form-control" value="{{ $examOrganizer->Name }}" required>
            @error('Name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
