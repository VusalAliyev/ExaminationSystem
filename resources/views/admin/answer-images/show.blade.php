@extends('layouts.admin')

@section('title', 'Cavab Şəkli Haqqında Məlumat')

@section('content')
    <h1>Cavab Şəkli Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $image->id }}</h5>
            <p class="card-text">Şəkil Yolu: {{ $image->image_path }}</p>
            <p class="card-text">Cavab: {{ $image->answer ? Str::limit($image->answer->answer_content, 50) : 'Təyin edilməyib' }}</p>
            <a href="{{ route('answer-images.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('answer-images.edit', $image->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
