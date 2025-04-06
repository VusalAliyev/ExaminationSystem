@extends('layouts.app')

@section('title', 'Soru Resmi Detay')

@section('content')
    <h1>Soru Resmi Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $questionImage->id }}</h5>
            <p class="card-text">Resim Yolu: {{ $questionImage->ImagePath }}</p>
            <p class="card-text">Soru: {{ $questionImage->question->QuestionContent }}</p>
            <a href="{{ route('question-images.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('question-images.edit', $questionImage->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
