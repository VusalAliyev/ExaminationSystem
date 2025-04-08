@extends('layouts.admin')

@section('content')
    <h1>Təşkilatçı Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examOrganizer->id }}</h5>
            <p class="card-text">Ad: {{ $examOrganizer->name }}</p>
            <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exam-organizers.edit', $examOrganizer->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
