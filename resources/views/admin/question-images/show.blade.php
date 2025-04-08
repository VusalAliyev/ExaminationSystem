@extends('layouts.admin')

@section('title', 'Sual Şəkli Haqqında Məlumat')

@section('content')
    <h1>Sual Şəkli Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $image->id }}</h5>
            <p class="card-text">Şəkil Yolu: {{ $image->image_path }}</p>
            <p class="card-text">Sual: {{ $image->question ? $image->question->question_content : 'Təyin edilməyib' }}</p>
            <a href="{{ route('question-images.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('question-images.edit', $image->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
